<?php 
	session_start();
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/must_login.php");

	$attempt = isset($_GET['a']) ? $_GET['a'] : false;

	// Needs to be before head include, since it starts to write the response.
	if (!$attempt) {
		$_SESSION['error'] = "Select a valid attempt to visualize.";
		header('Location:/select_uc/');
		die();
	}

	$sq = $dbh->prepare("SELECT QuestionAttempts.student as student, Question.question as question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3, 
			Student.name as author, Student.id as author_id, selected, UC.name as uc, QuestionAttempts.id as id, UC.id as uc_id, Question.id as question_id,
			QuestionAttempts.date as date, QuestionRating.user_score as q_rating, rating
		FROM QuestionAttempts
		JOIN Question ON QuestionAttempts.question = Question.id
		JOIN UC ON Question.uc = UC.id
		JOIN Student ON Question.Author = Student.id
		LEFT JOIN QuestionRating ON QuestionAttempts.question = QuestionRating.question
		LEFT JOIN (SELECT SUM(user_score) as rating, question FROM QuestionRating GROUP BY question) t2 ON Question.id = t2.question
		WHERE QuestionAttempts.id = ? AND QuestionRating.student = ?");
	$sq->execute([$attempt, $user_id]);
	$attempt= $sq->fetch();
	if (!$attempt) {
		$_SESSION['error'] = "Select a valid attempt to visualize.";
		header('Location:/select_uc/');
		die();
	}

	if ($attempt['student'] != $user_id && !$user_is_admin) {
		$_SESSION['error'] = "You haven't permission to see this attempt.";
		header('Location:/select_uc/');
		die();
	}

	if (!$attempt['q_rating']) {
		$attempt['q_rating'] = 0;
	}

	if (!$attempt['rating']) {
		$attempt['rating'] = 0;
	}

	$q_rating_base_url = "/actions/set_rating/?q=" . $attempt['question_id'] . "&v=";
	
	if ($attempt["wrong_answer3"] != NULL) {
		$n_opts = 4;
	} elseif ($attempt["wrong_answer2"] != NULL) {
		$n_opts = 3;
	} else {
		$n_opts = 2;
	}


	$options = [1 => 'correct_answer', 'wrong_answer1', 'wrong_answer2', 'wrong_answer3'];

	$title = "Attempt #" . $attempt['id'];
	$css = ["solve_exercise", "header", "footer"];
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/head.php");
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/header.php");
?>

<main>
	<h1>Attempt #<?php echo $attempt['id']; ?> - <?php echo $attempt['uc']; ?></h1>
	<?php if ($success) { ?>
		<p class="success"><?php echo $success; ?></p>
	<?php } ?>
	<?php if ($error) { ?>
		<p class="error"><?php echo $error; ?></p>
	<?php } ?>
	<article>
		<div class="grid">
			<section class="controls">
				<a href="/solve_exercise/?uc_id=<?php echo $attempt['uc_id']; ?>"><button>Continue Practicing</button></a>
			</section>
			<section class="question-container">
				<section class="question">
					<header>
						<div>
							<img src="/assets/pfp/cat<?php echo $attempt['author_id'] % 10; ?>.jpg" alt="Profile Picture"/>
							<span><?php echo $attempt['author']; ?></span>
						</div>
						<div>
							<span>Question #<?php echo $attempt['question_id']; ?></span>
						</div>
					</header>
					<main>
						<h2><?php echo $attempt["question"]; ?></h2>
					</main>
					<footer>
						<div>
							<span>Did you like this question?</span>
							<?php 
								if ($attempt['q_rating'] != 1) {
									echo "<a href=\"" . $q_rating_base_url . 1 . "\">Yes.</a>";
								}
								if ($attempt['q_rating'] != 0) {
									echo "<a href=\"" . $q_rating_base_url . 0 . "\">Remove " . ($attempt['q_rating'] == 1 ? "like" : "dislike") . ".</a>";
								}
								if ($attempt['q_rating'] != -1) {
									echo "<a href=\"" . $q_rating_base_url . -1 . "\">No.</a>";
								}
							?>
						</div>
						<span>Rating: <?php echo $attempt["rating"]; ?></span>
					</footer>
				</section>
			</section>
		</div>
		<section class="answers">
			<header class="replier">
				<div>
					<?php 
						if ($user_id == $attempt['student']) {
							echo "You";
						} else {
								echo "<img src=\"/assets/pfp/cat" . $attempt['author_id'] % 10 . ".jpg\" alt=\"Profile Picture\"/>" . $attempt['author'];
						}
					?>
					replied:
				</div>
				<span><?php echo date('j/m/y G:i', intval($attempt['date']))?></span>
			</header>
			<?php for ($i = 1; $i <= $n_opts; $i++) { ?>
			<div class="
				<?php if ($i == 1) {
					echo "answer correct-answer";
				} else if ($i == $attempt['selected']) {
					echo "answer wrong-answer";
				} else {
					echo "answer";
				}
				?>
			">
				<?php echo $attempt[$options[$i]] ?>
			</div>
			<?php } ?>
		</section>
	</article>
</main>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/footer.php"); ?>

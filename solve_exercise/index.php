<?php 
	session_start();
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/must_login.php");

	$uc = isset($_GET['uc_id']) ? $_GET['uc_id'] : false;

	// Needs to be before head include, since it starts to write the response.
	if (!$uc) {
		$_SESSION['error'] = "Please select an UC before trying to solve exercises.";
		header('Location:/select_uc/');
		die();
	}



	$sq = $dbh->prepare("SELECT COUNT(id) as count FROM Question WHERE UC=?;");
	$sq->execute([$uc]);
	$n_questions = $sq->fetch();

	// TODO: Probably a algorithm better than selecting a random is preferable
	$sq = $dbh->prepare("SELECT Question.id as id, question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3,
			Student.name as author, UC.name as uc_name, UC.id as uc_id, Student.id as author_id
		FROM Question JOIN UC ON Question.uc = UC.id JOIN Student ON Student.id = Question.author
		WHERE uc=? AND uc in (SELECT uc FROM StudentUCs WHERE student=?) ORDER BY random() LIMIT 1;");
	$sq->execute([$uc, $user_id]);
	$selected_question = $sq->fetch();
	if (!$selected_question) {
		// This query could have been done before the previous query, which would 
		// simplify the code a bit, but doing it this way, we will avoid an extra 
		// query most of the times (which part of the times would be users exploiting 
		// the system, which shouldn't really be taking considerations)
		$sq = $dbh->prepare('SELECT name FROM StudentUCs JOIN UC on StudentUCs.uc = UC.id WHERE uc = ? AND student = ?;');
		$sq->execute([$uc, $user_id]);
		$response = $sq->fetch();
		if (!$response) {
			$_SESSION['error'] = "Please choose an UC you are enrolled in!";
			header('Location:/select_uc/');
			die();
		}

		$title = "Exercises";
		$css = ["solve_exercise", "header", "footer"];
		include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/head.php");
		include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/header.php");
		include_once('no_questions.php');	
		include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/footer.php");
		die();	
	}

	if ($selected_question["wrong_answer3"] != NULL) {
		$n_opts = 4;
	} elseif ($selected_question["wrong_answer2"] != NULL) {
		$n_opts = 3;
	} else {
		$n_opts = 2;
	}

	$opt_order = array_slice(["correct_answer", "wrong_answer1", "wrong_answer2", "wrong_answer3"], 0, $n_opts);

	shuffle($opt_order);

	// TODO: Find a way to hide a reply button until an option wasn't selected
	//	There is :has selector, but it is too shiny (firefox received it the prev month lol)
	$title = "Exercises";
	$css = ["solve_exercise", "header", "footer"];
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/head.php");
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/header.php");
?>

<main>
	<h1>Exercises - <?php echo $selected_question['uc_name']; ?></h1>
	<article>
		<div class="grid">
			<section class="controls">
				<a href="/exercise_builder/?uc_id=<?php echo $uc; ?>"><button>Add Exercise</button></a>
				<a href=""><button class="secondary">Leaderboard</button></a>
				<a href="/solve_exercise/?uc_id=<?php echo $uc; ?>"><button class="secondary">Skip</button></a>
			</section>
			<section class="question-container">
				<section class="question">
					<header>
						<div>
							<img src="/assets/pfp/cat<?php echo $selected_question['author_id'] % 10; ?>.jpg" alt="Profile Picture"/>
							<span><?php echo $selected_question['author']; ?></span>
						</div>
						<div>
							<span>Question #<?php echo $selected_question['id']; ?></span>
						</div>
					</header>
					<h2><?php echo $selected_question["question"]; ?></h2>
				</section>
			</section>
		</div>
		<form action="/actions/answer_question/" method="POST" class="inputs">
			<?php for ($i = 0; $i < $n_opts; $i++) { ?>
			<label for="<?php echo $opt_order[$i]?>">
				<input type="hidden" name="qid" value="<?php echo $selected_question['id'] ?>">
				<input type="hidden" name="uc" value="<?php echo $selected_question['uc_id'] ?>">
				<input type="radio" style="display:none" 
					name="answer"
					id="<?php echo $opt_order[$i]?>"
					value="<?php echo $opt_order[$i]?>"
					required="required"
				/>
				<div><?php echo $selected_question[$opt_order[$i]] ?></div>
			</label>
			<?php } ?>
			<button type="submit">Reply</button>
		</form>
	</article>
</main>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/footer.php"); ?>

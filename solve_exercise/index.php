<?php 
	session_start();
	include_once("../_partials/must_login.php");


	// TODO: You need to add something into the options which allows to verify which is right
	// TODO: Fix CSS
	// TODO: Handle empty GET
	$uc = $_GET['uc_id'];

	$title = "Exercises";
	$css = ["solve_exercise", "header", "footer"];
	include_once("../_partials/head.php");
	include_once("../_partials/header.php");

	// Acho que nao vale a pena este check quando o proximo existe
	// Alguem que esteja a abusar o nosso site nao merece informacao extra lol
	// $sq = $dbh->prepare('SELECT * FROM UC WHERE id=?;');
	// $sq->execute([$uc]);
	// if (!$sq->fetch()) {
	// 	$_SESSION['msg'] = "UC does not exist! Please choose a valid one.";
	// 	header('Location:/select_uc/');
	// 	die();
	// }

	$sq = $dbh->prepare('SELECT * FROM StudentUCs WHERE uc = ? AND student = ?;');
	$sq->execute([$uc, $_SESSION['user_id']]);
	if (!$sq->fetch()) {
		$_SESSION['msg'] = "Please choose an UC you are enrolled in!";
		header('Location:/select_uc/');
		die();
	}

	$sq = $dbh->prepare("SELECT COUNT(id) as count FROM Question WHERE UC=?;");
	$sq->execute([$uc]);
	$n_questions = $sq->fetch();

	// TODO: Properly place the count in adequate element
	$selected_question = rand(0, $n_questions['count']-1);
	if ($n_questions['count'] > 0) {
		echo $selected_question;
		echo("/");
		echo $n_questions['count'];
	} else {
		// TODO: Render that there are no quesitons in this UC if there are no questions
		echo "<p>Maybe include another file when its empty</p>";
		include_once("../_partials/footer.php");
		die();
	}

	// TODO: Probably a algorithm better than selecting a random is preferable
	$sq = $dbh->prepare("SELECT Question.id as id, question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3, Student.name as author, UC.name as uc_name
		FROM Question JOIN UC ON Question.uc = UC.id JOIN Student ON Student.id = Question.author
		WHERE uc=? LIMIT 1 OFFSET ?;");
	$sq->execute([$uc, $selected_question]);
	$selected_question = $sq->fetch();
	$opt_order = ["correct_answer", "wrong_answer1", "wrong_answer2", "wrong_answer3"];

	if ($selected_question["wrong_answer3"] != NULL) {
		$n_opts = 4;
	}
	elseif ($selected_question["wrong_answer2"] != NULL) {
		$n_opts = 3;
	}
	else {
		$n_opts = 2;
	}

	shuffle($opt_order);
?>

<h1>Exercises - <?php echo $selected_question['uc_name']; ?></h1>
<main>
	<section class="arrows">
		<img class="empty" src="/assets/arrows/upvote_empty.png" width=60px>
		<img class="filled" src="/assets/arrows/upvote_filled.png" width=60px>
		<img class="empty" src="/assets/arrows/downvote_empty.png" width=60px>
		<img class="filled" src="/assets/arrows/downvote_filled.png" width=60px>
	</section>
	<section class="question">
		<div>
			<div id=question>
				<p><?php echo($selected_question["question"]); ?> </p>
				<p id="signature"> made by <?php echo($selected_question['author']); ?> </p>
			</div>
			<?php
				for ($i = 0; $i < $n_opts; $i++) {
					echo("<p id=answer>");
					echo($selected_question[$opt_order[$i]]);
					echo("</p>");
				}
			?>
		</div>
	</section>

	<section class="controls">
		<div>
			<a href="/exercise-builder/">Add Exercise</a>
			<a href="#">Leaderboard</a>
		</div>
		<a href="#">Skip</a>
	</section>
</main>

<?php include_once("../_partials/footer.php"); ?>

<?php 
	session_start();
	include_once("../_partials/must_login.php");


	// TODO: You need to add something into the options which allows to verify which is right
	// TODO: Fix CSS
	// TODO: Add logic if there is no questions
	//   Suggestion: Maybe create a template to handle the case of not having any question, and rendering it.
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

	$sq = $dbh->prepare('SELECT * FROM StudentUCs WHERE uc = ? INTERSECT SELECT * FROM StudentUCs WHERE student = ?;');
	$sq->execute([$uc, $_SESSION['user_id']]);
	if(!$sq->fetch()){
		$_SESSION['msg'] = "Please choose an UC you are enrolled in!";
		header('Location:/select_uc/');
		die();
	}

	$sq = $dbh->prepare("SELECT COUNT(id) FROM Question WHERE UC=?;");
	$sq->execute([$uc]);
	$n_questions = $sq->fetch();

	// TODO: Properly place the count in adequate element
	$n_questions = intval($n_questions[0]);
	if ($n_questions > 0) {
		echo rand(1,$n_questions);
		echo("/");
		echo $n_questions;
	} else {
		$_SESSION['msg'] = "No questions for this UC";
		die();        
	}

	// TODO: Probably a algorithm better than selecting a random is preferable
	// TODO: Transform both selects into a single query with a JOIN
	$sq = $dbh->prepare("SELECT * FROM Question WHERE UC=? LIMIT 1 OFFSET ?;");
	$sq->execute([$uc, $n_questions-1]);
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

	$sq = $dbh->prepare("SELECT username FROM Student WHERE id=?;");
	$sq->execute([$selected_question["author"]]);
	$authorName = $sq->fetch();
?>

<h1>Exercises - UC420420</h1>
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
				<p> <?php echo($selected_question["question"]); ?> </p>
				<p id="signature"> made by <?php echo($authorName[0]); ?> </p>
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
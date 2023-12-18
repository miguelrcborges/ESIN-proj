<?php 
	session_start();
	include($_SERVER['DOCUMENT_ROOT'] . "/_partials/must_login.php");

	$uc = isset($_GET['uc_id']) ? $_GET['uc_id'] : false;
	if (!$uc) {
		$_SESSION['error'] = "Please select an UC before trying to create questions.";
		header('Location:/select_uc/');
		die();
	}

	$sq = $dbh->prepare('SELECT name FROM StudentUCs JOIN UC on StudentUCs.uc = UC.id WHERE uc = ? AND student = ?;');
	$sq->execute([$uc, $user_id]);
	$response = $sq->fetch();
	if (!$response) {
		$_SESSION['error'] = "Please choose an UC you are enrolled in!";
		header('Location:/select_uc/');
		die();
	}

	$title = "Exercise Builder";
	$css = ["exercise_builder", "header", "footer"];
	include($_SERVER['DOCUMENT_ROOT'] . '/_partials/head.php'); 
	include($_SERVER['DOCUMENT_ROOT'] . '/_partials/header.php'); 
?>
<main>
	<h1>Question Builder - <?php echo $response['name']; ?></h1>
	<form action="/actions/submit_question/" method="POST">
		<div>
			<input type="hidden" name="uc" value="<?php echo $_GET['uc_id'] ?>">
			<textarea type="text" id="question" name="question" placeholder="Type your question..." required="required"></textarea><br>
			<input type="text" id="option1" name="option1" placeholder="Correct Answer" required="required">
			<input type="text" id="option2" name="option2" placeholder="Wrong Answer" required="required">
			<p>Fill the previous wrong answer to get more options.</p>
			<input type="text" id="option3" name="option3" placeholder="Wrong Answer 2">
			<input type="text" id="option4" name="option4" placeholder="Wrong Answer 3">
		</div>
		<button type="submit">Submit</button>
	</form>
</main>

<?php include_once("../_partials/footer.php"); ?>

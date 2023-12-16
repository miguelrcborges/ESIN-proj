<?php 
	session_start();
	include($_SERVER['DOCUMENT_ROOT'] . "/_partials/redirect_logged.php");

	$title = "Exercise Builder";
	$css = ["exercise_builder", "header", "footer"];
	include($_SERVER['DOCUMENT_ROOT'] . '/_partials/head.php'); 
	include($_SERVER['DOCUMENT_ROOT'] . '/_partials/header.php'); 
?>
<main>
	<h1>Question Builder - UC420420</h1>
	<form action="/actions/submit_question/" method="POST">
		<div>
			<input type="hidden" name="uc" value="<?php echo $_GET['uc_id'] ?>">
			<input type="text" id="question" name="question" placeholder="Type your question..." required="required"><br>
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

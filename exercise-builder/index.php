<?php 
	session_start();
	include_once("../_partials/must_login.php");

	$title = "Exercise Builder";
	$css = ["exercise-builder", "header"];
	include_once("../_partials/head.php");
	include_once("../_partials/header.php");
?>
<main>
	<h1>Question Builder - UC420420</h1>
    <form action="/actions/submit-question/" method="POST">
        <div>
            <input type="text" id="question" name="question" placeholder="Type your question..." required = "required"><br>
            <input type="text" id="option1" name="option1" placeholder="Correct Answer" required = "required">
            <input type="text" id="option2" name="option2" placeholder="Wrong Answer" required = "required">
            <input type="text" id="option3" name="option3" placeholder="Wrong Answer 2">
            <input type="text" id="option4" name="option4" placeholder="Wrong Answer 3">
        </div>
        <input type="submit" value="Submit">
    </form>

</main>

<?php include_once("../_partials/footer.php") ?>

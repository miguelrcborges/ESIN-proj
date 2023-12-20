<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/must_admin.php");

	$n_opts = 4;
	$dbh = new PDO('sqlite:' . $_SERVER['DOCUMENT_ROOT'] . '/db');

	$sql = $dbh->prepare('
		SELECT 
		q.question,
		q.correct_answer, 
		q.wrong_answer1,
		q.wrong_answer2,
		q.wrong_answer3,
		s.name AS author_name,
		u.name AS uc_name
		FROM 
		Question q
		LEFT JOIN 
		Student s ON q.author = s.id
		JOIN 
		UC u ON q.uc = u.id 
		WHERE 
		q.id = ?
		');

	$sql->execute([$q_id]);
	$question = $sql->fetch();

	if (empty($question)) {
		echo('<p class="error">No question with ID ' . $q_id . '</p></main></section></body>');
        include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/footer.php"); 
		die();
	}
?>

<div>
<div id='question_info'>
	<p><strong>Question:</strong>                   <?php echo $question["question"]?> </p>
	<p><strong>Correct Answer:</strong>             <?php echo $question["correct_answer"]?> </p>
	<p><strong>Wrong Answers:</strong>                  
	<?php for ($i = 0; $i < $n_opts-1; $i++) {?> 
	<p class=><?php echo ($question[$i+2]); ?></p>
	<?php } ?>

	<p><strong>Submitted by:</strong>               <?php echo $question["author_name"]?> </p>
	<p><strong>UC:</strong>                         <?php echo $question["uc_name"]?> </p>


</div>
</div>

<form id="ban" action='/actions/delete_question/' method='GET'>
	<input type='hidden' name='q_id' value='<?php echo($q_id); ?>'>
	<button>Delete Question</button>
</form>
</div>
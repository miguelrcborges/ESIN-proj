<?php 
	session_start();
	include($_SERVER['DOCUMENT_ROOT'] . '/_partials/must_login.php'); 

	$title = "Leaderboard";
	$css = ["leaderboard", "header", "footer"];

    $uc_id = isset($_GET['uc_id']) ? $_GET['uc_id'] : false;
	if (!$uc_id) {
		$_SESSION['error'] = "Please select an UC before looking at the leaderboard.";
		header('Location:/select_uc/');
		die();
	}

	$sq = $dbh->prepare('SELECT name FROM UC WHERE id = ?;');
	$sq->execute([$uc_id]);
	$uc_name = $sq->fetch();

	if ($uc_name == FALSE) {
		$_SESSION['error'] = "Please select a valid UC before looking at the leaderboard.";
		header('Location:/select_uc/');
		die();
    }

    $stmt = $dbh->prepare("SELECT id, name, username FROM Student;");
    $stmt->execute();
    $students = $stmt->fetchAll();


    $stmt = $dbh->prepare("
    SELECT a.student, 
        student.name, 
        student.username, 
        a.total, 
        b.correct, 
        (CAST(b.correct AS FLOAT) * b.correct / a.total) AS points 
    FROM
        (Select qa.student, COUNT(qa.selected) AS total from QuestionAttempts qa JOIN Question q ON qa.question = q.id where q.uc = ? GROUP BY qa.student ORDER BY COUNT(*) DESC) a 
    LEFT JOIN
        (Select qa.student, COUNT(qa.selected) AS correct from QuestionAttempts qa JOIN Question q ON qa.question = q.id where q.uc = ? and qa.selected=1 GROUP BY qa.student ORDER BY COUNT(*) DESC) b
    ON a.student = b.student 
    JOIN Student ON
    Student.id = a.student
    ORDER BY points DESC;
    ");
    $stmt->execute([$uc_id, $uc_id]);
    $question_attempts = $stmt->fetchAll();
    
	include($_SERVER['DOCUMENT_ROOT'] . '/_partials/head.php'); 
	include($_SERVER['DOCUMENT_ROOT'] . '/_partials/header.php'); 

    if (empty($question_attempts)) {
        echo "<h1>Leaderboard - ". $uc_name['name'] ."</h1>";
        echo "<p class='error'>No attempts have been made for any question in this UC.</p>";
        include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/footer.php"); 
        die();
    }
?>


<h1>Leaderboard - <?php echo $uc_name['name']; ?></h1>

<main>

<?php if ($success) { ?>
    <p class="success"><?php echo $success; ?></p>
<?php }
if ($error) { ?>
    <p class="error"><?php echo $error; ?></p>
<?php } ?>

<div class="grid-container">
<?php
$position = 1;
foreach ($question_attempts as $attempt) {
    $name = $attempt['name'];
    $username = $attempt['username'];
    if ($attempt['points'] == NULL) {
        $roundedScore = 0;
    } elseif ($attempt['points'] < 1) {
        $roundedScore = round($attempt['points'], 3);
    } elseif ($attempt['points'] < 10) {
        $roundedScore = round($attempt['points'], 2);
    } elseif ($attempt['points'] < 100) {
        $roundedScore = round($attempt['points'], 1);
    } else {
        $roundedScore = round($attempt['points']);
    }
    echo "<div class='index'>$position </div><div class='name'> $name ($username)</div><div class='number'> " . $roundedScore . " points</div><div class='empty'></div>";

    $position++;
}
?>
</div>
</main>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/footer.php"); ?>
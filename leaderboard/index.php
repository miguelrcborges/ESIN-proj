<?php 
	session_start();
	include($_SERVER['DOCUMENT_ROOT'] . '/_partials/must_login.php'); 

	$title = "Leaderboard";
	$css = ["leaderboard", "header", "footer"];
	include($_SERVER['DOCUMENT_ROOT'] . '/_partials/head.php'); 
	include($_SERVER['DOCUMENT_ROOT'] . '/_partials/header.php'); 

    $uc_id = isset($_GET['uc_id']) ? $_GET['uc_id'] : false;
	if (!$uc_id) {
		$_SESSION['error'] = "Please select an UC before looking at the leaderboard to create questions.";
		header('Location:/select_uc/');
		die();
	}

	$sq = $dbh->prepare('SELECT name FROM UC WHERE id = ?;');
	$sq->execute([$uc_id]);
	$uc_name = $sq->fetch();


    $stmt = $dbh->prepare("SELECT id, name, username FROM Student;");
    $stmt->execute();
    $students = $stmt->fetchAll();


    $stmt = $dbh->prepare("SELECT qa.student, qa.selected FROM QuestionAttempts qa JOIN Question q ON qa.question = q.id WHERE q.uc = ?;");
    $stmt->execute([$uc_id]);
    $question_attempts = $stmt->fetchAll();

    if (empty($question_attempts)) {
        echo "<main><h1>Leaderboard - ". $uc_name['name'] ."</h1>";
        echo "<p id='error'>No attempts have been made for any question in this UC.</p>";
        echo "</main>";
        include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/footer.php"); 
        die();
    }



    $totalCounts = [];
    $correctCounts = [];

    foreach ($question_attempts as $attempt) {
        $studentId = $attempt["student"];

        if (isset($totalCounts[$studentId])) {
            $totalCounts[$studentId]++;
        } else {
            $totalCounts[$studentId] = 1;
        }

        if ($attempt["selected"] == 1) {
            if (isset($correctCounts[$studentId])) {
                $correctCounts[$studentId]++;
            } else {
                $correctCounts[$studentId] = 1;
            }
        }
    }


    $studentScore = [];

    foreach ($totalCounts as $studentId => $totalCount) {
        $correctCount = isset($correctCounts[$studentId]) ? $correctCounts[$studentId] : 0;
    
        $score = ($correctCount * $correctCount) / $totalCount;
    
        $studentDetails = array_filter($students, function ($student) use ($studentId) {
            return $student['id'] == $studentId;
        });
    
        if (!empty($studentDetails)) {
            $studentDetails = reset($studentDetails);
            $name = $studentDetails['name'];
            $username = $studentDetails['username'];
    
            $studentScores[] = ['score' => $score, 'studentId' => $studentId, 'name' => $name, 'username' => $username];
        }
    }

    array_multisort(array_column($studentScores, 'score'), SORT_DESC, $studentScores);
?>



<main>
	<h1>Leaderboard - <?php echo $uc_name['name']; ?></h1>

<div class="grid-container">
<?php
$position = 1;
foreach ($studentScores as $studentScore) {
    $name = $studentScore['name'];
    $username = $studentScore['username'];
    $score = $studentScore['score'];
    if ($score < 1) {
        $roundedScore = round($score, 3);
    } elseif ($score < 10) {
        $roundedScore = round($score, 2);
    } elseif ($score < 100) {
        $roundedScore = round($score, 1);
    } else {
        $roundedScore = round($score);
    }
    echo "<div class='index'>$position </div><div class='name'> $name ($username)</div><div class='number'> " . $roundedScore . " points</div><div class='empty'></div>";

    $position++;
}
?>
</div>
</main>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/footer.php"); ?>
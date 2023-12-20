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

	if (!$uc_name) {
		$_SESSION['error'] = "Please select a valid UC before looking at the leaderboard.";
		header('Location:/select_uc/');
		die();
	}

	$stmt = $dbh->prepare("
			SELECT 
				student.name AS name, student.id AS id, student.username as username,
				(CAST(b.correct AS FLOAT) * b.correct / a.total) AS points 
			FROM
					(SELECT qa.student, COUNT(qa.selected) AS total from QuestionAttempts qa JOIN Question q ON qa.question = q.id where q.uc = ? GROUP BY qa.student) a 
				LEFT JOIN
					(SELECT qa.student, COUNT(qa.selected) AS correct from QuestionAttempts qa JOIN Question q ON qa.question = q.id where q.uc = ? and qa.selected=1 GROUP BY qa.student) b
					ON a.student = b.student 
				JOIN Student ON Student.id = a.student
			ORDER BY points DESC;
		");
	$stmt->execute([$uc_id, $uc_id]);
	$results = $stmt->fetchAll();

	include($_SERVER['DOCUMENT_ROOT'] . '/_partials/head.php');
	include($_SERVER['DOCUMENT_ROOT'] . '/_partials/header.php');

	if (empty($results)) {
		echo "<h1>Leaderboard - " . $uc_name['name'] . "</h1>";
		echo "<p class='error'>No attempts have been made for any question in this UC.</p>";
		include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/footer.php");
		die();
	}
?>


<main>
	<h1>Leaderboard - <?php echo $uc_name['name']; ?></h1>
	<?php if ($success) { ?>
		<p class="success"><?php echo $success; ?></p>
	<?php }
	if ($error) { ?>
		<p class="error"><?php echo $error; ?></p>
	<?php } ?>

	<div class="results-container">
		<?php
			$position = 1;
			foreach ($results as $result) {
				$name = $result['name'];
				$img_num = $result['id'] % 10;
				$username = $result['username'];
				if ($result['points'] === null) {
					$rounddedScore = 0;
				} else {
					$roundedScore = round($result['points'], 1);
				}
				echo "<div class='result'>
								<div>$position</div>
								<div class='user'>
									<img src='/assets/pfp/cat$img_num.jpg' alt='Profile Picture'/>
									<span>$name (@$username)</span>
								</div>
								<div class='score'>$roundedScore</div>
							</div>";
				$position++;
		}
		?>
	</div>
</main>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/footer.php"); ?>

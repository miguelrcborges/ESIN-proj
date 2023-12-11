<?php
	session_start();
	$uc = $_POST['uc_id'];
	$dbh = new PDO('sqlite:../../db');
	$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
	#   pensei em pôr isto para ninguém poder tentar entrar aqui com uma UC que não existe,
    #   imagino que dê para fornecer cenas em post na mesma, isto protege contra isso
    $sq = $dbh->prepare('SELECT * FROM UC WHERE id=?;');
	$sq->execute([$uc]);
	$uc_exists = $sq->fetch();
	if (!$uc_exists) {
		$_SESSION['msg'] = "UC does not exist! Please choose a valid one.";
		header('Location:/choiceUC/');
	}

	$_SESSION['uc'] = $uc;
	header('Location:/exercise/');
	die();
?>

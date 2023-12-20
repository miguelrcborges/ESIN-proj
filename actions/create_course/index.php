<?php
	session_start();
	$c_name = $_GET['c_name'];

    $dbh = new PDO('sqlite:' . $_SERVER['DOCUMENT_ROOT'] . '/db');


    $checkSql = $dbh->prepare('SELECT COUNT(*) FROM Course WHERE name = ?');
    $checkSql->execute([$c_name]);
    $count = $checkSql->fetchColumn();
    
    if ($count > 0) {
        $_SESSION['error'] = "Course name ".$c_name." already exists. Please choose a different name.";
    } else {
        $insertSql = $dbh->prepare('INSERT INTO Course (name) VALUES (?)');
        $insertSql->execute([$c_name]);
        $_SESSION['success'] = "Course ".$c_name." created successfully";
    }

	header('Location:/admin_panel/create_course/');
?>
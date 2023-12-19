<?php 
	session_start();
	include($_SERVER['DOCUMENT_ROOT'] . '/_partials/must_login.php'); 

	$title = "User Settings";
	$css = ["user_settings", "header", "footer"];
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/head.php");
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/header.php");


	$user_id = $_SESSION["user_id"];
	
    $sql = $dbh->prepare("
    SELECT
        s.name,
        s.username,
        s.creation_date,
        s.course_id,
        r.name AS role_name,
        c.name AS course_name
    FROM
        Student s
        JOIN Role r ON s.role_id = r.id
        JOIN Course c ON s.course_id = c.id
        or s.course_id is null
    WHERE
        s.id = ?
");

$sql->execute([$user_id]);
$user_info = $sql->fetch();


?>

<h1>User Settings</h1>
<section>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/user_settings/_partials/sidebar.php"); ?>
    <main>
        <h2><?php echo $page_title;?></h2>

        <?php if ($success) { ?>
			<p class="success"><?php echo $success; ?></p>
		<?php }
		if ($error) { ?>
			<p class="error"><?php echo $error; ?></p>
		<?php } ?>
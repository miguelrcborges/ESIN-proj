<?php 
	session_start();
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/must_admin.php");

	$title = "Admin Panel";
	$css = ["admin_panel", "header", "footer"];
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/head.php");
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/header.php");
?>

<h1>Admin Panel </h1>

<main>
    <p>Select User</p>
    <form action="/admin_panel/user_lookup" type="GET">
        <input type="text" name="username" placeholder="username" required="required">
        <button>Search</button>
    </form>

    <div>
        <?php
        if (isset($_GET['username'])) {
            $username = $_GET["username"];
            include_once("display_user.php");
        } ?>
    </div>

</main>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/footer.php"); ?>

<?php 
	include_once("../_partials/must_login.php");

	$title = "Exercises";
	$css = ["header","choiceUC"];
	include_once("../_partials/head.php");
	include_once("../_partials/header.php");

    session_start();

    $dbh = new PDO('sqlite:../db');
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    
    $stmt = $dbh->prepare("SELECT id,name FROM StudentUCs JOIN UC ON id=uc WHERE student=?");
    $stmt->execute(array($_SESSION['user_id']));
    $ucs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<body>
    <main>
        <h1 class="message">Choose what you will study today!</h1>
        <?php if (isset($msg)) { ?>
		<span><?php echo $msg ?></span>
        <?php } ?>
        <form action="/actions/choiceUC/" method='post'>
            <select name="uc_id">
                <?php foreach($ucs as $uc){
                    echo '<option value=' . $uc['id'] . '>' . $uc['name'] . '</option>';
                } ?>
            </select>
            <button type="submit">Study</button>
        </form>
    </main>
</body>
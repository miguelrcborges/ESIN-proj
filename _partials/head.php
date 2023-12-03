<?php
	session_start();

	$msg = $_SESSION['msg'];
	unset($_SESSION['msg']);
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Web Jonas<?php if ($title) { echo " - $title"; } ?></title>
	<link rel="stylesheet" href="/css/global.css">
	<?php if ($css) { ?><link rel="stylesheet" href="/css/<?php echo "$css"; ?>.css"><?php } ?>
</head>

<?php
	session_start();

	$msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : null;
	unset($_SESSION['msg']);
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Web Jonas<?php if (isset($title)) { echo " - $title"; } ?></title>
	<link rel="stylesheet" href="/css/global.css">
	<?php if ($css) { ?><link rel="stylesheet" href="/css/<?php echo "$css"; ?>.css"><?php } ?>
	<meta name="viewport" content="initial-scale=1.0, width=device-width" />
</head>

<?php
	$test = session_start();

	$msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : null;
	unset($_SESSION['msg']);
?>

<!DOCTYPE HTML>
<html lang="en" class="
<?php if (isset($_SESSION['theme']) && $_SESSION['theme'] == 'light') {
	echo "light"; 
} else {
	echo "dark";
}?>">
<head>
	<title>Web Jonas<?php if (isset($title)) { echo " - $title"; } ?></title>
	<link rel="stylesheet" href="/css/global.css">
<?php
	foreach ($css as $file) {
		echo "<link rel='stylesheet' href='/css/$file.css'>";
	}
?>
	<link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
	<meta name="viewport" content="initial-scale=1.0, width=device-width" />
</head>

<?php
	$error = isset($_SESSION['error']) ? $_SESSION['error'] : null;
	unset($_SESSION['error']);
	$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;
	unset($_SESSION['success']);

	if (isset($_SESSION['theme']) && $_SESSION['theme'] == 'light') {
		$change_theme_label = "Dark Theme"; 
		$html_class = "light";
	} else {
		$change_theme_label = "Light Theme";
		$html_class = "dark";
	}
?>

<!DOCTYPE HTML>
<html lang="en" class="<?php echo $html_class ?>">
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

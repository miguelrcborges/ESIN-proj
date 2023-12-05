<body>
	<header>
		<img src="/assets/webjonas.png">
		<ul>
			<?php if ($user_is_admin) { echo "<a href='/admin/'><li>Admin Panel</li></a>"; } ?>
			<a href="/forum/"><li>Forum</li></a>
			<a href="/flashcards/"><li>Flashcards</li></a>
<?php if (isset($_SESSION['theme']) && $_SESSION['theme'] == 'light') {
	echo "<a href='/actions/dark_theme/'><li>Dark Theme</li></a>"; 
} else {
	echo "<a href='/actions/light_theme/'><li>Light Theme</li></a>";
}?>
		</ul>
	</header>

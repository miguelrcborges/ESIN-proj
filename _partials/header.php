<body>
	<header>
		<a href="/forum/"><img src="/assets/webjonas.png"></a>
		<ul>
			<?php if ($user_is_admin) { echo "<a href='/admin/'><li>Admin Panel</li></a>"; } ?>
			<a href="/forum/"><li>Forum</li></a>
			<a href="/exercises/"><li>Exercises</li></a>
			<a href="/actions/change_theme/"><li>
<?php if (isset($_SESSION['theme']) && $_SESSION['theme'] == 'light') {
	echo "Dark Theme"; 
} else {
	echo "Light Theme";
}?>
			</li></a>
		</ul>
		<a id="menu" href="/links/">
			<svg width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M4 6H20M4 12H20M4 18H20" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
		</a>
	</header>

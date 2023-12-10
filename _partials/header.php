<body>
	<header>
		<a href="/forum/"><img src="/assets/webjonas.png"></a>
		<ul>
			<?php if ($user_is_admin) { echo "<a href='/admin/'><li>Admin Panel</li></a>"; } ?>
			<a href="/forum/"><li>Forum</li></a>
			<a href="/exercises/"><li>Exercises</li></a>
			<a href="/actions/change_theme/"><li><?php echo $change_theme_label ?></li></a>
		</ul>
			<label id="menu" for="nav">
				<svg width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M4 6H20M4 12H20M4 18H20" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</label>
	</header>
	<input type="checkbox" id="nav" style="display: none">
	<nav>
		<label id="close-menu" for="nav">
			<svg viewBox="-2.5 -2.5 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
				<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
				<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
				<g id="SVGRepo_iconCarrier">
					<path d="M3 21.32L21 3.32001" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
					<path d="M3 3.32001L21 21.32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
				</g>
			</svg>
		</label>
		<ul>
			<?php if ($user_is_admin) { echo "<a href='/admin/'><li>Admin Panel</li></a>"; } ?>
			<a href="/forum/"><li>Forum</li></a>
			<a href="/exercises/"><li>Exercises</li></a>
			<a href="/actions/change_theme/"><li><?php echo $change_theme_label ?></li></a>
		</ul>
	</nav>

<?php 
	session_start();

	$css = ["about", "footer"];
	include_once("../_partials/head.php");
?>

<main>
	<h1>About JOnAS</h1>
	<div class="grid">
		<a href="/forum/"><img src="/assets/favicon.ico"></a>

		<div id="description">
			<p>JOnAS originated in October 2020 as a Discord bot crafted by Miguel Borges and Francisco Magalhães, with the purpose of keeping track of zoom class links and assisting students in exam preparation by providing a platform for true or false questions. In early 2021, JOnAS underwent significant growth. The bot expanded beyond its initial true or false question support, enabling students to submit questions via a collaborative Google Sheets page. This evolution led to the creation of a dynamic question pool curated by students for students. JOnAS became versatile, offering support for various exams, and was widely used by many students.</p>
			<p>When Discord discontinued support for bots, Miguel developed <i>Web-JOnAS</i>. The web platform replicated the functionalities of the Discord bot, and in the winter of 2021, introduced a flashcard feature initially tailored for Anatomy exams. However, as other projects gained priority, <i>Web-JOnAS</i> was left to the side.</p>
			<p>Now, when Miguel and Francisco, along with their long-time collaborator Tomás Cruz, were tasked to build a website for the curricular unit of Information Systems Engineering, it was a no-brainer to use this opportunity to bring <i>Web-JOnAS</i> to a new level, mixing legacy features such as the question leaderboard, with new ones like the question forums.</p>
		</div>
	</div>
</main>

<?php include_once("../_partials/footer.php"); ?>


<main>
	<h1>Exercises - <?php echo $response['name']; ?></h1>
	<article>
		<div class="grid">
			<section class="controls">
				<a href="/exercise_builder/?uc_id=<?php echo $uc; ?>"><button>Add Exercise</button></a>
				<button class="secondary" disabled>Leaderboard</button>
				<button class="secondary" disabled>Skip</button></a>
			</section>
			<section>
				<h1>No question submitted yet for this course</h1>
				<a href="/exercise_builder/?uc_id=<?php echo $uc; ?>"><p>Create the first exercise!</p></a>
			</section>
		</div>
	</article>
</main>

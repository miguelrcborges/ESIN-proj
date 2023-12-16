<?php 
	session_start();
	include_once("../_partials/must_login.php");

	$title = "Forum";
	$css = ["forum", "header", "footer"];
	include_once("../_partials/head.php");
	include_once("../_partials/header.php");

	$stmt = $dbh->prepare("SELECT id, name FROM StudentUCs JOIN UC ON id=uc WHERE student=?");
	$stmt->execute([$_SESSION['user_id']]);
	$ucs = $stmt->fetchAll(PDO::FETCH_ASSOC);

	// TODO: Probably a cap will be need to be added when more Threads are available.
	if (isset($_GET['uc']) && $_GET['uc'] != null) {
		// The 2nd condition restricts the view, not letting users see
		// users seeing posts from courses which they arent signed up
		$stmt = $dbh->prepare("SELECT Student.name as author_name, Thread.id as id, title, content, Thread.creation_date as creation_date, Student.id as author_id
			FROM Thread JOIN Student ON Thread.author = Student.id
				WHERE uc=? 
				AND uc in 
					(SELECT uc FROM StudentUCs WHERE student=?)");
		$stmt->execute([$_GET['uc'], $user_id]);
	} else {
		$stmt = $dbh->prepare("SELECT Student.name as author_name, Thread.id as id, title, content, Thread.creation_date as creation_date, Student.id as author_id
			FROM Thread JOIN Student ON Thread.author = Student.id
				WHERE uc is NULL OR
				uc in 
					(SELECT uc FROM StudentUCs WHERE student=?)");
		$stmt->execute([$user_id]);
	}
	$threads = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<main>
	<header>
		<button>Add a Post</button>
		<search>
			<form action="/forum/" type="POST">
				<strong>Filters</strong>
				<div class='filter-container'>
					<label for="uc">UC:</label>	
					<select id="uc" name="uc">
						<option value="">None</option>
						<?php foreach ($ucs as $uc) {
							echo '<option value="' . $uc['id'] . '" name="uc">' . $uc['name'] . '</option>';
						} ?>
					</select>
				</div>
				<button type="submit">Filter</button>
			</form>
		</search>
	</header>

<?php if (count($threads) > 0) { ?>
	<section class="thread-container">
		<?php foreach ($threads as $thread) { ?>
			<a href="/thread/?thread=<?php echo $thread['id'];?>">
				<article>
					<header>
						<span class="date"><?php echo date('j/m/y G:i', (int)$thread['creation_date'])?></span>
						<h2><?php echo $thread['title'];?></h2>
					</header>
					<main>
						<p><?php echo $thread['content'];?></p>
					</main>
					<footer>
						<img src="/assets/pfp/cat<?php echo $thread['author_id'] % 10; ?>.jpg" alt="Profile Picture"/>
						<span><?php echo $thread['author_name']; ?></span>
					</footer>
				</article>
			</a>
		<?php } ?>
	</section>
<?php } else { ?>
	<article class="no-posts">
		<h2>No posts found.</h2>
	</article>
<?php } ?>
</main>

<?php	
	include_once("../_partials/footer.php"); 
?>

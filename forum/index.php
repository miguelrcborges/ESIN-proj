<?php 
	session_start();
	include($_SERVER['DOCUMENT_ROOT'] . '/_partials/must_login.php'); 

	$title = "Forum";
	$css = ["forum", "header", "footer"];
	include($_SERVER['DOCUMENT_ROOT'] . '/_partials/head.php'); 
	include($_SERVER['DOCUMENT_ROOT'] . '/_partials/header.php'); 

	$stmt = $dbh->prepare("SELECT id, name FROM StudentUCs JOIN UC ON id=uc WHERE student=?");
	$stmt->execute([$_SESSION['user_id']]);
	$ucs = $stmt->fetchAll();
	
	$page = isset($_GET['page']) ? intval($_GET['page']) : false;
	$filter = isset($_GET['uc']) && $_GET['uc'] != null ? $_GET['uc'] : false;
	$THREADS_PER_PAGE = 10;
	
	if (!$page) {
		$page = 1;
	}

	if ($filter) {
		$stmt = $dbh->prepare("
			SELECT COUNT(*) as count
			FROM Thread JOIN Student ON Thread.author = Student.id 
				LEFT JOIN UC ON Thread.uc = UC.id
			WHERE uc=? AND uc in 
				(SELECT uc FROM StudentUCs WHERE student=?)
		");
		$stmt->execute([$_GET['uc'], $user_id]);
	} else {
		$stmt = $dbh->prepare("
			SELECT COUNT(*) as count
			FROM Thread JOIN Student ON Thread.author = Student.id LEFT JOIN UC ON Thread.uc = UC.id
				WHERE uc is NULL OR uc in 
					(SELECT uc FROM StudentUCs WHERE student=?)
		");
		$stmt->execute([$user_id]);
	}

	$count = $stmt->fetch()['count'];
	$last_page = ceil($count / $THREADS_PER_PAGE);
	if ($page > $last_page) {
		$page = $last_page;
	} else if ($page < 0) {
		$page = 1;
	}
	$has_next_page = $page < $last_page;
	$has_prev_page = $page > 1;

	if ($filter) {
		// The 2nd condition restricts the view, not letting users see
		// users seeing posts from courses which they arent signed up
		$stmt = $dbh->prepare("
			SELECT 
				Student.name as author_name, Student.id as author_id,
				Thread.id as id, title, content, Thread.creation_date as creation_date,
				UC.name as uc_name
			FROM Thread 
				JOIN Student ON Thread.author = Student.id
				LEFT JOIN UC ON Thread.uc = UC.id
			WHERE uc=? AND uc in 
				(SELECT uc FROM StudentUCs WHERE student=?)
			ORDER BY creation_date DESC
			LIMIT ? OFFSET ?
		");
		$stmt->execute([$_GET['uc'], $user_id, $THREADS_PER_PAGE, ($page-1) * $THREADS_PER_PAGE]);
	} else {
		$stmt = $dbh->prepare("
			SELECT 
				Student.name as author_name, Student.id as author_id,
				Thread.id as id, title, content, Thread.creation_date as creation_date, 
				UC.name as uc_name
			FROM Thread 
				JOIN Student ON Thread.author = Student.id 
				LEFT JOIN UC ON Thread.uc = UC.id
			WHERE uc is NULL OR uc in 
				(SELECT uc FROM StudentUCs WHERE student=?)
			ORDER BY creation_date DESC
			LIMIT ? OFFSET ? 
		");
		$stmt->execute([$user_id, $THREADS_PER_PAGE, ($page-1) * $THREADS_PER_PAGE]);
	}
	$threads = $stmt->fetchAll();
?>
<main>
	<header>
		<a href="/create_thread/"><button>Create Thread</button></a>
		<search>
			<form action="/forum/" type="POST">
				<strong>Filters</strong>
				<div class='filter-container'>
					<label for="uc">UC:</label>	
					<select id="uc" name="uc">
						<option value="">None</option>
						<?php foreach ($ucs as $uc) {
							if ($uc['id']==$_GET['uc']) {
								echo '<option value="' . $uc['id'] . '" name="uc" selected>' . $uc['name'] . '</option>';
							}
							else{
								echo '<option value="' . $uc['id'] . '" name="uc">' . $uc['name'] . '</option>';
							}
						} ?>
					</select>
				</div>
				<button type="submit">Filter</button>
			</form>
		</search>
	</header>

<?php if ($threads) { ?>
	<section class="thread-container">
		<?php 
			foreach ($threads as $thread) { 
				if ($thread['content'] && strlen($thread['content']) > 180) {
					$thread['content'] = substr($thread['content'], 0, 177) . "...";
				}
		?>
			<a href="/thread/?thread=<?php echo $thread['id'];?>">
				<article>
					<header>
						<div class="top-row">
							<span class="uc"><?php echo $thread['uc_name']; ?></span>
							<span class="date"><?php echo date('j/m/y G:i', intval($thread['creation_date']))?></span>
						</div>
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
	<footer>
		<div class="grid">
			<?php
				if ($threads) {
					$base_url = "/forum/?uc=" . ($filter ? $filter : "") . "&page=";
					echo "<span>";
					if ($has_prev_page) {
						echo "<a href=\"$base_url" . ($page - 1) . "\">Previous</a>";
					}
					echo "</span>";
					echo "<span>" . $page . "</span>";
					echo "<span>";
					if ($has_next_page) {
						echo "<a href=\"$base_url" . ($page + 1) . "\">Next</a>";
					}
					echo "</span>";
				}
			?>
		</div>
	</footer>
</main>

<?php	
	include($_SERVER['DOCUMENT_ROOT'] . '/_partials/footer.php'); 
?>

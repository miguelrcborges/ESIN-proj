<?php 
	session_start();
	include($_SERVER['DOCUMENT_ROOT'] . "/_partials/must_login.php");

	$title = "Thread";
	
	$thread_id = $_GET['thread'];

	$stm = $dbh->prepare("
		SELECT 
			Thread.title as thread_title, Thread.creation_date as thread_date, Thread.content as thread_content, Thread.uc,
			Student.id as op_id, Student.name as op_name, Student.username as op_username, Student.role_id as op_role
		FROM Thread 
			JOIN Student ON author = Student.id
		WHERE Thread.id = ?
	");
	$stm->execute([$thread_id]);
	$thread = $stm->fetch();

	if(!$thread) {
		$_SESSION['error'] = "This thread doesn't exist! Please choose a valid one";
		header('Location:/forum/');
		die();
	}

	$stm = $dbh->prepare("
		SELECT 
			Reply.id as reply_id, Reply.creation_date as reply_date, Reply.content as reply_content,
			Student.id as author_id, Student.name as author_name, Student.username as author_username, Student.role_id as author_role
		FROM Reply
			JOIN Student ON Reply.author = Student.id
		WHERE Reply.thread = ?
	");
	$stm->execute([$thread_id]);
	$replies = $stm->fetchAll();

	$css = ["header", "footer", "thread"];
	include($_SERVER['DOCUMENT_ROOT'] . "/_partials/head.php");
	include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/header.php"); 
?>

<main>
	<section class ="thread">
		<header>
			<h1 class="title"> <?php echo $thread['thread_title'];?> </h1>
			<span class="profile">
				<img src="/assets/pfp/cat<?php echo $thread['op_id'] % 10; ?>.jpg" alt="Profile Picture"/>
				<?php echo "<span class='author'> " . $thread['op_name'] . " (@" . $thread['op_username'] . ") </span>";?>
			</span>
		</header>
		<body>
			<?php if ($thread['thread_content'] != NULL) { ?>
				<p id='thread_content'> <?php echo $thread['thread_content'] ?> </p>
			<?php }
			else { ?>
				<p id='thread_content'> <i> This thread has no content.</i></p>
			<?php } ?> 
		</body>	
		<footer>
			<span class="date"> <?php echo date('j/m/y G:i', (int)$thread['thread_date']);?> </span>
		</footer>
	</section>

	<?php if (count($replies)>0) {?>
		<section class="reply_container">
			<?php foreach($replies as $reply){ 
				if ($reply['author_id']!=$_SESSION['user_id']) { ?>
					<article class="other_replies">
						<header>
							<div class="profile">
								<img src="/assets/pfp/cat<?php echo $reply['author_id'] % 10; ?>.jpg" alt="Profile Picture"/>
								<?php echo "<span class='author'> " . $reply['author_name'] . " (@" . $reply['author_username'] . ") </span>";?>
							</div>
						</header>
						<body>
							<p id='reply_content'> <?php echo $reply['reply_content']; ?> </p>	
						</body>
						<footer>
							<span class="date"><?php echo date('j/m/y G:i', (int)$reply['reply_date']);?></span>
						</footer>					
					</article>
			<?php }
				else { ?>
					<article class="my_replies">
						<header>
							<div class="profile">
								<img src="/assets/pfp/cat<?php echo $reply['author_id'] % 10; ?>.jpg" alt="Profile Picture"/>
								<?php echo "<span class='author'> " . $reply['author_name'] . " (@" . $reply['author_username'] . ") </span>";?>
							</div>
						</header>
						<body>
							<p id='reply_content'> <?php echo $reply['reply_content']; ?> </p>	
						</body>
						<footer>
							<span class="date"><?php echo date('j/m/y G:i', (int)$reply['reply_date']);?></span>
						</footer>					
					</article>
				<?php }
			} ?>
		</section>
	<?php } 
	
	else { ?>
		<article class="no_replies">
			<p>No replies were found...</p>
		</article>
	<?php } ?>

	<form action="/actions/submit_reply/" method='POST'>
		<textarea name="reply" placeholder="Write here your reply."></textarea>
		<input type="hidden" name ="thread_id" value=<?php echo $thread_id?>>
		<button type="submit">Reply</button>
	</form>

</main>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/_partials/footer.php");  ?> 

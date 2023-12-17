<?php 
	session_start();
	include($_SERVER['DOCUMENT_ROOT'] . '/_partials/must_login.php'); 

	$title = "Add post";
	$css = ["create_thread", "header", "footer"];
	include($_SERVER['DOCUMENT_ROOT'] . '/_partials/head.php'); 
	include($_SERVER['DOCUMENT_ROOT'] . '/_partials/header.php'); 

	$stmt = $dbh->prepare("SELECT id, name FROM StudentUCs JOIN UC ON id=uc WHERE student=?");
	$stmt->execute([$_SESSION['user_id']]);
	$ucs = $stmt->fetchAll();
?>
<main>
	<h1>Thread creation</h1>
	<form action="/actions/create_thread/" method="POST">
		<?php if (isset($error)) { ?>
			<span><?php echo $error; ?></span>
		<?php } ?>
		<div class="parameter">
			<p><label for="title">Title</label></p>
			<p><input type="text" id="title" name="title" placeholder="What is ...?" required="required"></p>
		</div>
		<div class="parameter">
			<p><label for="content">Content</label></p>
			<p><textarea name="content" id="content" placeholder="I was looking into this but I'm not..."></textarea></p>
		</div>
		<div class="parameter">
			<p><label for="filter">Filter</label></p>
			<p>
				<select id="filter" name="filter">
					<option value="">None</option>
					<?php foreach ($ucs as $uc) {
						echo '<option value="' . $uc['id'] . '" name="uc">' . $uc['name'] . '</option>';
					} ?>
				</select>
			</p>
		</div>
		<button type="submit">Create</button>
	</form>
</main>

<?php	
	include($_SERVER['DOCUMENT_ROOT'] . '/_partials/footer.php'); 
?>

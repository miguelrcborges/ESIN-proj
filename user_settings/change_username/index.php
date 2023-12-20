<?php 
$page_title = "Change Username";
include_once($_SERVER['DOCUMENT_ROOT'] . "/user_settings/_partials/head.php"); ?>

<form action='/actions/user_settings/change_username/' method='POST'>
    <p><strong>Current Username: </strong><?php echo $user_info["username"]?></p>
    <label for new_name><strong>New Username:</strong></label>
    <input type="text" name="new_name" placeholder="BabyGronk" required="required">
    <label for="password"><strong>Password:</strong></label>
    <input type="password" name="password" placeholder="snakegoodfriend420" required="required">
    <button type="submit">Confirm</button>
</form>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/user_settings/_partials/footer.php"); ?>


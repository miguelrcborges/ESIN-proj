<?php 
$page_title = "Change Name";
include_once($_SERVER['DOCUMENT_ROOT'] . "/user_settings/_partials/head.php"); ?>
        
<form action='/actions/user_settings/change_name/' method='POST'>
    <p><strong>Current Name: </strong><?php echo $user_info["name"]?></p>
    <label for new_name><strong>New Name:</strong></label>
    <input type="text" name="new_name" placeholder="BabyGronk" required="required">
    <label for="password"><strong>Password:</strong></label>
    <input type="password" name="password" placeholder="snakegoodfriend420" required="required">
    <button type="submit">Confirm</button>
</form>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/user_settings/_partials/footer.php"); ?>


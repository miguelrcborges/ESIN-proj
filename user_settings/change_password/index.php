<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/user_settings/_partials/head.php"); ?>

        <h2>Change Password</h2>
        <form action='\actions\user_settings\change_password' method='POST'>
            <label for new_password><strong>New Password:</strong></label>
            <input type="password" name="new_password" placeholder="tengo3suerte" required="required">
            <label for confirm><strong>Confirm New Password:</strong></label>
            <input type="password" name="confirm" placeholder="tengo3suerte" required="required">
            <label for="password"><strong>Current Password:</strong></label>
            <input type="password" name="password" placeholder="snakegoodfriend420" required="required">
            <button type="submit">Confirm</button>
        </form>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/user_settings/_partials/footer.php"); ?>


<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/user_settings/_partials/head.php"); ?>


<?php
    $stmt = $dbh->prepare("SELECT id, name FROM Course");
    $stmt->execute();
    $courses = $stmt->fetchAll();
?>


<h2>Change Name</h2>
<form action='\actions\user_settings\change_course' method='POST'>
    <p><strong>Current Course: </strong><?php if ($user_info["course_id"]==NULL) {
                                                                echo("None");
                                                            } else {
                                                                echo $user_info["course_name"];
                                                            }?></p>
    <label for new_name><strong>New Course:</strong></label>
    <select name="c_id">
        <?php foreach ($courses as $course) {
            if ($course['id'] != $user_info["course_id"]) {
            echo '<option value="' . $course['id'] . '">' . $course['name'] . '</option>';
            }
        } ?>
    </select>

    <label for="password"><strong>Password:</strong></label>
    <input type="password" name="password" placeholder="snakegoodfriend420" required="required">
    <button type="submit">Confirm</button>
</form>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/user_settings/_partials/footer.php"); ?>
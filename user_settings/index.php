<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/user_settings/_partials/head.php"); 
$pfp_loc = '/assets/pfp/cat'.($user_id%10) . '.jpg';
?>
<h2>Info</h2>
<div id="info">
    <img src=<?php echo($pfp_loc);?> alt='Profile Picture' style='width:300px;height:300px;'>

    <div>
        <p><strong>Name:</strong>                       <?php echo $user_info["name"]?> </p>
        <p><strong>Username:</strong>                   <?php echo $user_info["username"]?> </p>
        <p><strong>Course:</strong>                     <?php if ($user_info["course_id"]==NULL) {
                                                                echo("None");
                                                            } else {
                                                                echo $user_info["course_name"];
                                                            }?> </p>
        <p><strong>Account Role:</strong>               <?php echo $user_info["role_name"]?> </p>
        <p><strong>Account Created on:</strong>         <?php echo date('d-m-Y', strtotime($user_info["creation_date"])) ?> </p>
    </div>
</div>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/user_settings/_partials/footer.php"); ?>
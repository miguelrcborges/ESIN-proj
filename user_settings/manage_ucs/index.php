<?php 
$page_title = "Manage UCs";
include_once($_SERVER['DOCUMENT_ROOT'] . "/user_settings/_partials/head.php"); ?>


<?php
    $stmt = $dbh->prepare("SELECT id, name, code, semester, year, course FROM UC");
    $stmt->execute();
    $ucs = $stmt->fetchAll();

    $stmt = $dbh->prepare("SELECT uc FROM StudentUCs WHERE student = ?");
    $stmt->execute([$user_id]);
    $enrolled_ucs = $stmt->fetchAll(PDO::FETCH_COLUMN);
    $enrolled_ucs = array_map('intval', $enrolled_ucs);

    $stmt = $dbh->prepare("SELECT id FROM UC WHERE course = ?");
    $stmt->execute([$user_info["course_id"]]);
    $course_ucs = $stmt->fetchAll(PDO::FETCH_COLUMN);
    $course_ucs = array_map('intval', $course_ucs);

    
if ($user_info["course_id"]==NULL) {
    echo('
    <div id= "error_no_course" class="error">
        <p>Looks like you are not enroled in a course! Please do so by enrolling <a href="/user_settings/change_course/"> here</a>!</p>
    </div>');
    include_once($_SERVER['DOCUMENT_ROOT'] . "/user_settings/_partials/footer.php");
    die;
}?>
        
<form action='/actions/user_settings/manage_ucs' method='GET'>
    <?php foreach ($ucs as $uc) {
        if (in_array($uc["id"], $course_ucs)) {
        ?>
    <div>
        <label for=<?php echo($uc["id"]);?>>
        <?php echo($uc["name"]);?></label>

        <input type="checkbox" value=1 id=<?php echo($uc["id"]);?> name=<?php echo($uc["id"]);
            if (in_array($uc["id"], $enrolled_ucs)) {
                echo(" checked");
            }
        ?>
        >
    </div>    
    <?php }}?>


    <button type="submit">Confirm</button>
</form>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/user_settings/_partials/footer.php"); ?>


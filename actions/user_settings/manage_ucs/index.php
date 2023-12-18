<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT']."/_partials/must_login.php");

$user = $_SESSION["user_id"];
$selected = $_GET;

//delete all UCs
$stmt = $dbh->prepare("DELETE FROM StudentUCs WHERE student = ?;");
$stmt->execute([$user]);

//enroll in selected UCs
foreach ($_GET as $uc => $value) {
    if ($uc !== null) {
        $stmt = $dbh->prepare("INSERT INTO StudentUCs (student, uc) VALUES (?,?);");
        $stmt->execute([$user, $uc]);
    }
}

$_SESSION['success'] = "UCs updated successfully!";
header("Location:/user_settings/manage_ucs");
die()
?>
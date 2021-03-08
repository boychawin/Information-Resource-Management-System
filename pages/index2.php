<?php session_start();
include_once 'functions.php';

if (session_id() !== '') {
    if (isset($_SESSION['staff-user']) && $_SESSION['staff-user'] !== '') {
        redirect_user('dashboard.php');
    } elseif (
        isset($_SESSION['supervisor-user']) &&
        $_SESSION['supervisor-user'] !== ''
    ) {
        redirect_user('dashboard.php?type=supervisor');
    } elseif (
        isset($_SESSION['admin-user']) &&
        $_SESSION['admin-user'] !== ''
    ) {
        redirect_user('admin.php');
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title></title>
    <link rel="icon" type="image/png" href="../images/Snru_3.png" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Group One">
    <?php require_once 'styles.php'; ?>
</head>

<body background="../images/bg-arit-big1.png">
    <?php
    include_once 'login.php';
    include_once 'scripts.php';
    ?>
</body>

</html>
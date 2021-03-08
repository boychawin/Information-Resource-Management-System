<?php
session_start();
if (!isset($_SESSION['apisitp'])) {
     header("Location: ../index.php");
     exit;
}
?>
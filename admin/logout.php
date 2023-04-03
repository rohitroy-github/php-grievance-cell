<!-- Logout Functionality -->
<?php
include './partials/constants.php';

// destroyingSessions
session_destroy();

$_SESSION['logout'] =
    '<p class="text-center">You have successfully logged out !</p>';

// redirectingToLogin
header('location:' . HOMEURL . 'admin/login.php');
?>
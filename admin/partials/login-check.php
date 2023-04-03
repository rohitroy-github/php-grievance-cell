<!-- Login Check Functionality -->
<?php
if (!isset($_SESSION['user'])) {

    $_SESSION['no-login-message'] =
        '<p class="text-center">Please login as an admin to access CMS !</p>';

    // redirecting
    header('location:' . HOMEURL . 'admin/login.php');
}
?>
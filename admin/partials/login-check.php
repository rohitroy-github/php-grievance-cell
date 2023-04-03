<!-- Login Check Functionality -->

<?php if (!isset($_SESSION['user'])) {
    // User not logged in !
    $_SESSION['no-login-message'] =
        '<p class="text-center">Please login as an admin to access admin CMS !</p>';

    header('location:' . HOMEURL . 'admin/login.php');
}
?>

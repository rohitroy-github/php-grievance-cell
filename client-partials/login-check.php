<!-- Login Check Functionality -->
<?php
if (!isset($_SESSION['user'])) {

  $_SESSION['no-login-message'] =
    '<p class="text-center">Please login to continue !</p>';

  // redirecting
  header('location:' . HOMEURL . 'login.php');
}
?>
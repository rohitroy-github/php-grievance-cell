<?php
include './partials/constants.php';

// extractingIDFromURL
$userId = $_GET['userId'];

$sql = "DELETE FROM tbl_user WHERE id=$userId";

$res = mysqli_query($conn, $sql);

if ($res == true) {

    $_SESSION['delete-user'] =
        '<p class="text-center">User has been deleted successfully !</p>';

    //Redirect
    header('location:' . HOMEURL . 'admin/manage-user.php');
} else {
    $_SESSION['delete-user'] =
        '<p class="text-center">Failed to delete user. Please try again later !</p>';

    header('location:' . HOMEURL . 'admin/manage-user.php');
}
?>
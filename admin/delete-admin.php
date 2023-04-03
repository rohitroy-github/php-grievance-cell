<?php
include './partials/constants.php';

// extractingIDFromURL
$adminId = $_GET['adminId'];

$sql = "DELETE FROM tbl_admin WHERE id=$adminId";

$res = mysqli_query($conn, $sql);

if ($res == true) {

    $_SESSION['delete-admin'] =
        '<p class="text-center">Admin has been deleted successfully !</p>';

    //Redirect
    header('location:' . HOMEURL . 'admin/manage-admin.php');
} else {

    $_SESSION['delete-admin'] =
        '<p class="text-center">Failed to delete admin. Please try again later !</p>';

    header('location:' . HOMEURL . 'admin/manage-admin.php');
}
?>
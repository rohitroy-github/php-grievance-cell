<?php
include './partials/constants.php';

// extractingIDFromURL
$complainId = $_GET['complainId'];

$sql_complain_check = "SELECT * FROM tbl_complain WHERE id='$complainId'";
$res_complain_check = mysqli_query($conn, $sql_complain_check);
$rows_complain_check = mysqli_fetch_assoc($res_complain_check);
$status = $rows_complain_check['status'];

if ($status == 'resolved') {
    $sql = "DELETE FROM tbl_complain WHERE id=$complainId";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {

        $_SESSION['delete-complain'] =
            '<p class="text-center">Complain has been deleted successfully !</p>';

        //Redirect
        header('location:' . HOMEURL . 'admin/manage-complain.php');
    } else {

        $_SESSION['delete-complain'] =
            '<p class="text-center">Failed to delete admin. Please try again later !</p>';

        header('location:' . HOMEURL . 'admin/manage-complain.php');
    }
} elseif ($status == 'unresolved') {
    $_SESSION['delete-complain-check-failed'] =
        '<p class="text-center">Complain is still unresolved. Please respond to the complain first !</p>';

    header('location:' . HOMEURL . 'admin/manage-complain.php');
}

?>
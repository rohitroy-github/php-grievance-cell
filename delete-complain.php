<?php
include './client-partials/constants.php';

// extractingIDFromURL
$complainId = $_GET['complainId'];

$sql = "DELETE FROM tbl_complain WHERE id=$complainId";

$res = mysqli_query($conn, $sql);

if ($res == true) {

    $_SESSION['delete-complain'] =
        '<p class="text-center">Complain has been deleted successfully !</p>';

    //Redirect
    header('location:' . HOMEURL . '');
} else {

    $_SESSION['delete-complain'] =
        '<p class="text-center">Failed to delete complain. Please try again later !</p>';

    header('location:' . HOMEURL . '');
}
?>
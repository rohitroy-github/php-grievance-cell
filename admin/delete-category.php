<?php
include './partials/constants.php';

// extractingIDFromURL
$categoryId = $_GET['categoryId'];

$sql = "DELETE FROM tbl_complain_category WHERE id=$categoryId";

$res = mysqli_query($conn, $sql);

if ($res == true) {

    $_SESSION['delete-category'] =
        '<p class="text-center">Category has been deleted successfully !</p>';

    //Redirect
    header('location:' . HOMEURL . 'admin/manage-category.php');
} else {

    $_SESSION['delete-category'] =
        '<p class="text-center">Failed to delete category. Please try again later !</p>';

    header('location:' . HOMEURL . 'admin/manage-category.php');
}
?>
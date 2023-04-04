<?php
include './partials/constants.php';

// extractingIDFromURL
$categoryId = $_GET['categoryId'];

// fetchingAdminDetails
$sql_category = "SELECT * FROM tbl_complain_category WHERE id='$categoryId'";
$res_category = mysqli_query(
    $conn,
    $sql_category
);
$rows_catgory = mysqli_fetch_assoc($res_category);
$title = $rows_catgory['title'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./styles/admin.css" />
    <title>Update Category</title>
</head>

<body>
    <div class="container">
        <div class="col-md-6 col-lg-6">
            <form class="login-form" action="" method="POST">
                <h2 class="text-center">Update Category</h2>
                <br />
                <!-- sessionalMessages -->
                <?php if (isset($_SESSION['category-update-failure'])) {
                    echo $_SESSION['category-update-failure'];
                    unset($_SESSION['category-update-failure']);
                } ?>
                <div class="form-group">
                    <label for="username">Category Title</label>
                    <input name="title" type="text" class="form-control" id="title"
                        placeholder="Enter a category title ?" required value="<?php echo $title; ?>" />
                </div>
                <button name=" submit" type="submit" class="btn btn-primaryColor" value="login">
                    Update Category
                </button>
            </form>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>

</html>

<?php if (isset($_POST['submit'])) {
    // Store in variables
    $title = $_POST['title'];
    $sql = "UPDATE tbl_complain_category SET
  title = '$title' WHERE id='$categoryId'";
    // Execute query into database
    $res = mysqli_query($conn, $sql);

    // Check whether data is inserted ?

    if ($res == true) {
        // Data Insertion Successfull !

        $_SESSION['category-update-success'] =
            '<p class="text-center">Category updated successfully !</p>';

        // Redirect to ManageAdmin Page
        header('location:' . HOMEURL . 'admin/manage-category.php');
    } else {
        // Data Insertion Failed !

        $_SESSION['category-update-failure'] =
            '<p class="text-center">Failed to update category !</p>';

        // Redirect to addAdmin Page again
        header('location:' . HOMEURL . 'admin/update-category.php');
    }
}
?>
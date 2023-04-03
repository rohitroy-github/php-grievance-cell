<?php
include './partials/constants.php';
include './partials/login-check.php';
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
    <title>Add New Complain Category</title>
</head>

<body>
    <div class="container">
        <div class="col-md-6 col-lg-6">
            <form class="login-form" action="" method="POST">
                <h2 class="text-center">Add New Complain Category</h2>
                <br />
                <!-- Printing SUCCESSS message -->
                <?php if (isset($_SESSION['category-add-failure'])) {
                    echo $_SESSION['category-add-failure'];
                    // Ending session
                    unset($_SESSION['category-add-failure']);
                } ?>
                <div class="form-group">
                    <label for="username">Category Title</label>
                    <input name="title" type="text" class="form-control" id="title" placeholder="Enter a category title ?"
                        required />
                </div>
                <button name="submit" type="submit" class="btn btn-primaryColor" value="login">
                    Add New Category
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
    $sql = "INSERT INTO tbl_complain_category SET
  title = '$title'
  ";
    // Execute query into database
    // $res = mysqli_query($conn, $sql) or die(mysqli_error());
    $res = mysqli_query($conn, $sql);

    // Check whether data is inserted ?

    if ($res == true) {
        // Data Insertion Successfull !

        $_SESSION['category-add-success'] =
            '<p class="text-center">Category added successfully !</p>';

        // Redirect to ManageAdmin Page
        header('location:' . HOMEURL . 'admin/manage-category.php');
    } else {
        // Data Insertion Failed !

        $_SESSION['category-add-failure'] =
            '<p class="text-center">Failed to add category !</p>';

        // Redirect to addAdmin Page again
        header('location:' . HOMEURL . 'admin/add-category.php');
    }
}
?>

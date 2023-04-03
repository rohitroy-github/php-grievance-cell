<?php
include './partials/constants.php';

// extractingIDFromURL
$adminId = $_GET['adminId'];

// fetchingAdminDetails
$sql_tbl_admin = "SELECT * FROM tbl_admin WHERE id='$adminId'";
$res_tbl_admin = mysqli_query(
    $conn,
    $sql_tbl_admin
);
$rows_admin = mysqli_fetch_assoc($res_tbl_admin);
$full_name = $rows_admin['full_name'];
$username = $rows_admin['username'];
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
    <title>Update Admin Details</title>
</head>

<body>
    <div class="container">
        <div class="col-md-6 col-lg-6">
            <form class="login-form" action="" method="POST">
                <h2 class="text-center">Update Admin Details</h2>
                <br />
                <!-- sessionalMessages -->
                <div>
                    <?php if (isset($_SESSION['update-admin-failure'])) {
                        echo $_SESSION['update-admin-failure'];
                        unset($_SESSION['update-admin-failure']);
                    } ?>
                </div>
                <div class="form-group">
                    <label for="username">Full Name</label>
                    <input name="full_name" type="text" class="form-control" id="full_name"
                        placeholder="Enter your full name ?" value="<?php echo $full_name ?>" />
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input name="username" type="text" class="form-control" id="username"
                        placeholder="Enter a username ?" value="<?php echo $username ?>" />
                </div>
                <button name="submit" type="submit" class="btn btn-primaryColor" value="login">
                    Update Admin Details
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
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    // Set SQL query
    $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username'
        WHERE id='$adminId'
    ";
    // Execute query into database
    ($res = mysqli_query($conn, $sql)) or die(mysqli_error());
    // Check whether data is inserted ?
    if ($res == true) {
        // Data inserted
        $_SESSION['update-admin-success'] =
            '<p class="text-center">Admin details updated successfully !</p>';

        // Redirect to ManageAdmin Page
        header('location:' . HOMEURL . 'admin/manage-admin.php');
    } else {
        // Failed
        $_SESSION['update-admin-failure'] =
            '<p class="text-center">Failed to update admin details. Please try again later !</p>';

        // Redirect to addAdmin Page again
        header('location:' . HOMEURL . 'admin/update-admin.php');
    }
    // echo $sql;
}
?>
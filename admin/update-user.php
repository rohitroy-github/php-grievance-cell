<?php
include './partials/constants.php';

// extractingIDFromURL
$userId = $_GET['userId'];

// fetchingAdminDetails
$sql_tbl_user = "SELECT * FROM tbl_user WHERE id='$userId'";
$res_tbl_user = mysqli_query(
    $conn,
    $sql_tbl_user
);
$rows_user = mysqli_fetch_assoc($res_tbl_user);
$full_name = $rows_user['full_name'];
$username = $rows_user['username'];
$contact = $rows_user['contact'];
$email = $rows_user['email'];
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
    <title>Update User Details</title>
</head>

<body>
    <div class="container">
        <div class="col-md-6 col-lg-6">
            <form class="login-form" action="" method="POST">
                <h2 class="text-center">User User Details</h2>
                <br />
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input name="full_name" type="text" class="form-control" id="full_name"
                        placeholder="Enter your full name ?" value="<?php echo $full_name; ?>" />
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input name="username" type="text" class="form-control" id="username"
                        placeholder="Enter a username ?" value="<?php echo $username; ?>" />
                </div>
                <div class="form-group">
                    <label for="contact">Contact Number</label>
                    <input name="contact" type="text" class="form-control" id="contact"
                        placeholder="Enter your contact number ?" value="<?php echo $contact; ?>" />
                </div>
                <div class="form-group">
                    <label for="email">Contact Email</label>
                    <input name="email" type="email" class="form-control" id="email"
                        placeholder="Enter your contact email ?" value="<?php echo $email; ?>" />
                </div>
                <button name="submit" type="submit" class="btn btn-primaryColor" value="login">
                    Update User Details
                </button>
            </form>
            <br />
            <!-- sessionalMessages -->
            <div>
                <?php
                if (isset($_SESSION['update-user-failure'])) {
                    echo $_SESSION['update-user-failure'];
                    unset($_SESSION['update-user-failure']);
                }
                ?>
            </div>
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
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    // Set SQL query
    $sql = "UPDATE tbl_user SET
    full_name = '$full_name',
    username = '$username',
    contact = '$contact',
    email = '$email'
    WHERE id='$userId'
";
    // Execute query into database
    ($res = mysqli_query($conn, $sql)) or die(mysqli_error());
    // Check whether data is inserted ?
    if ($res == true) {
        // Data inserted
        $_SESSION['update-user-success'] =
            '<p class="text-center">User details updated successfully !</p>';

        // Redirect to ManageAdmin Page
        header('location:' . HOMEURL . 'admin/manage-user.php');
    } else {
        // Failed
        $_SESSION['update-user-failure'] =
            '<p class="text-center">Failed to update user details. Please try again later !</p>';

        // Redirect to addAdmin Page again
        header('location:' . HOMEURL . 'admin/update-user.php');
    }
    // echo $sql;
}
?>
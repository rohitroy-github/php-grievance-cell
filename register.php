<?php
include './client-partials/constants.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./client-styles/admin.css" />
    <title>Grievance Cell | Register</title>
</head>

<body>
    <div class="container">
        <div class="col-md-6 col-lg-6">
            <form class="login-form" action="" method="POST">
                <h2 class="text-center">Register New User</h2>
                <br />
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input name="full_name" type="text" class="form-control" id="full_name"
                        placeholder="Enter your full name ?" />
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input name="username" type="text" class="form-control" id="username"
                        placeholder="Enter a username ?" />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" type="password" class="form-control" id="password"
                        placeholder="Enter a password ?" />
                </div>
                <div class="form-group">
                    <label for="contact">Contact Number</label>
                    <input name="contact" type="text" class="form-control" id="contact"
                        placeholder="Enter your contact number ?" />
                </div>
                <div class="form-group">
                    <label for="email">Contact Email</label>
                    <input name="email" type="email" class="form-control" id="email"
                        placeholder="Enter your contact email ?" />
                </div>
                <button name="submit" type="submit" class="btn btn-primaryColor" value="login">
                    Register
                </button>
            </form>
            <br />
            <!-- sessionalMessages -->
            <div>
                <p class="text-center">Already an user ? <a href="login.php">Back to login</a> !</p>
                <?php
                if (isset($_SESSION['registration-failure'])) {
                    echo $_SESSION['registration-failure'];
                    unset($_SESSION['registration-failure']);
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

    // Password encryption using md5
    $password = md5($_POST['password']);

    $contact = $_POST['contact'];
    $email = $_POST['email'];


    // Set SQL query
    $sql = "INSERT INTO tbl_user SET
  full_name = '$full_name',
  username = '$username',
  password = '$password',
  contact = '$contact',
  email = '$email'
  ";

    // Execute query into database
    $res = mysqli_query($conn, $sql);
    // Check whether data is inserted ?
    if ($res == true) {
        // Data inserted
        $_SESSION['registration-success'] =
            '<p class="text-center">User registered successfully !</p>';
        // redirectingToLogin
        header('location:' . HOMEURL . '');
    } else {
        // Failed
        $_SESSION['registration-failure'] =
            '<p class="text-center">Failed to register. Please try again later  !</p>';
        // redirectingToRetry
        header('location:' . HOMEURL . '/register.php');
    }
} ?>
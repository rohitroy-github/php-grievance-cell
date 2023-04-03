<?php
include './client-partials/constants.php';
?>

<?php
// fethcingUserID
if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
} else {
    header('location: ' . HOMEURL . '/login.php');
    exit();
}

// fetchingUserDetails
$sql2 = "SELECT * FROM tbl_user WHERE id='$userId'";
$res2 = mysqli_query($conn, $sql2);
$rows2 = mysqli_fetch_assoc($res2);

$full_name = $rows2['full_name'];
$contact = $rows2['contact'];
$email = $rows2['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./client-styles/add-complain.css" />
    <link rel="stylesheet" href="./client-styles/clientStyles.css" />

    <title>Lodge A Complain</title>
</head>

<body>
    <div class="container">
        <div class="col-md-7 col-lg-7">
            <form class="login-form" action="" method="POST" enctype="multipart/form-data">
                <h2 class="text-center">Lodge A Complain</h2>
                <br />
                <div class="form-group">
                    <label for="title">Complain Header</label>
                    <input name="title" type="text" class="form-control" id="title"
                        placeholder="Enter a complain header ?" required />
                </div>
                <div class="form-group">
                    <label for="description">Detailed Complain</label>
                    <textarea name="description" type="text" class="form-control" id="description"
                        placeholder="Explain your complain in brief ?" required></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Select Relevant Category : </label>
                    <select name="category">
                        <!-- addSQLCodeHere -->
                        <option value="0">No Category Found</option>a
                    </select>
                </div>
                <div class="form-group">
                    <label for="username">Full Name</label>
                    <input name="full_name" type="text" class="form-control" id="full_name"
                        placeholder="Enter your full name ?" />
                </div>
                <div class="form-group">
                    <label for="username">Contact Number</label>
                    <input name="full_name" type="text" class="form-control" id="full_name"
                        placeholder="Enter your contact number ?" />
                </div>
                <div class="form-group">
                    <label for="username">Contact Email</label>
                    <input name="full_name" type="email" class="form-control" id="full_name"
                        placeholder="Enter your email ?" value="<?php echo $full_name; ?>" />
                </div>
                <button name="submit" type="submit" class="btn formBtn" value="add-dish">
                    Lodge Complain
                </button>
            </form>
            <br />
            <!-- sessionalMessages -->
            <div>
                <?php
                if (isset($_SESSION['complain-lodge-failure'])) {
                    echo $_SESSION['complain-lodge-failure'];
                    unset($_SESSION['complain-lodge-failure']);
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
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $userId = $_POST['user_id'];
    $complain = $_POST['complain'];
    $complain_header = $_POST['complain_header'];
    $category_id = $_POST['category_id'];

    // Set SQL query
    $sql = "INSERT INTO tbl_reciever SET
    full_name = '$full_name',
    user_id = '$userId',
    contact = '$contact',
    email = '$email',
    complain = '$complain'
    complain_header = '$complain_header'
    ";

    // executeQuery
    ($res = mysqli_query($conn, $sql)) or die(mysqli_error());

    // dataInserted?
    if ($res == true) {
        // Data Insertion Successfull !

        $_SESSION['complain-lodge-success'] =
            '<p class="text-center">Complain lodged successfully !</p>';

        // Redirect to dashboard
        header('location:' . HOMEURL . '/index.php');
    } else {
        // Data Insertion Failed !

        $_SESSION['complain-lodge-failure'] =
            '<p class="text-center">Failed to lodge complain. Please try again later !</p>';

        // Redirect to retry
        header('location:' . HOMEURL . '/add-complain.php');
    }
}
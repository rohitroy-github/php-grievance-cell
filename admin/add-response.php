<?php
include './partials/constants.php';

// extractingIDFromURL
$complainId = $_GET['complainId'];

// fetchingAdminDetails
$sql_complain = "SELECT * FROM tbl_complain WHERE id='$complainId'";
$res_complain = mysqli_query(
    $conn,
    $sql_complain
);
$rows_complain = mysqli_fetch_assoc($res_complain);
$full_name = $rows_complain['full_name'];
$user_id = $rows_complain['user_id'];
$contact = $rows_complain['contact'];
$email = $rows_complain['email'];
$complain = $rows_complain['complain'];
$admin_response = $rows_complain['admin_response'];
$complain_header = $rows_complain['complain_header'];
$complain_date = $rows_complain['complain_date'];
$category_id = $rows_complain['category_id'];
$status = $rows_complain['status'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./styles/admin.css" />
    <link rel="stylesheet" href="./styles/adminStyles.css" />

    <title>Respond To Complain</title>
</head>

<body>
    <div class="container">
        <div class="col-md-10 col-lg-10">
            <form class="login-form" action="" method="POST">
                <h2 class="text-center">View Complain | Add Response</h2>
                <br />
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for=" full_name">Name</label>
                        <input name="full_name" type="text" class="form-control" id="full_name"
                            placeholder="Enter your full name ?" value="<?php echo $full_name; ?>" disabled />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="contact">Contact</label>
                        <input name="contact" type="text" class="form-control" id="contact"
                            placeholder="Enter your contact number ?" value="<?php echo $contact; ?>" disabled />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="username">Email</label>
                        <input name="email" type="email" class="form-control" id="full_name"
                            placeholder="Enter your email ?" value="<?php echo $email; ?>" disabled />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="price">Selected Category</label>
                        <?php
                        $sql_category_selection = "SELECT * FROM tbl_complain_category WHERE id='$category_id'";
                        $res_category_selection = mysqli_query($conn, $sql_category_selection);
                        $row_category = mysqli_fetch_assoc($res_category_selection);
                        $title = $row_category['title'];
                        ?>
                        <input name="category" type="text" class="form-control" id="category"
                            placeholder="Enter a complain category ?" value="<?php echo $title; ?>" disabled />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="contact">Complained Filed On</label>
                        <input name="date" type="date" class="form-control" id="date"
                            value="<?php echo $complain_date; ?>" disabled />
                    </div>
                </div>
                <div class="form-group">
                    <label for="title">Complain Header</label>
                    <input name="complain_header" type="text" class="form-control" id="complain_header"
                        placeholder="Enter a complain header ?" value="<?php echo $complain_header; ?>" disabled />
                </div>
                <div class="form-group">
                    <label for="complain">Detailed Complain</label>
                    <input name="complain" type="text" class="form-control" id="complain"
                        value="<?php echo $complain; ?>" disabled />
                </div>
                <div class="form-group">
                    <label for="complain">Response</label>
                    <textarea name="admin_response" type="text" class="form-control" id="admin_response"
                        placeholder="Admin response ?" required><?php echo $admin_response; ?></textarea>
                </div>
                <button name="submit" type="submit" class="btn formBtn">
                    Submit Response
                </button>
            </form>
            <br />
            <!-- sessionalMessages -->
            <div>
                <?php
                if (isset($_SESSION['complain-reponse-failure'])) {
                    echo $_SESSION['complain-reponse-failure'];
                    unset($_SESSION['complain-reponse-failure']);
                }
                ?>
            </div>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>

</html>

<?php if (isset($_POST['submit'])) {
    $admin_response = $_POST['admin_response'];

    // Set SQL query
    $sql = "UPDATE tbl_complain SET
        admin_response = '$admin_response',
        status = 'resolved'
        WHERE id='$complainId'
    ";

    // executeQuery
    $res = mysqli_query($conn, $sql);

    // dataInserted?
    if ($res == true) {
        // Data Insertion Successfull !

        $_SESSION['complain-reponse-success'] =
            '<p class="text-center">Complain responded successfully !</p>';

        // Redirect to dashboard
        header('location:' . HOMEURL . 'admin/manage-complain.php');
    } else {
        // Data Insertion Failed !

        $_SESSION['complain-reponse-failure'] =
            '<p class="text-center">Failed to respond to complain. Please try again later !</p>';

        // Redirect to retry
        header('location:' . HOMEURL . 'admin/add-response.php');
    }
}
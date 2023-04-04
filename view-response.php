<?php
include './client-partials/constants.php';

// extractingIDFromURL
$complainId = $_GET['complainId'];

// fetchingAdminDetails
$sql_complain = "SELECT * FROM tbl_complain WHERE id='$complainId'";
$res_complain = mysqli_query(
    $conn,
    $sql_complain
);
$rows_complain = mysqli_fetch_assoc($res_complain);
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
    <link rel="stylesheet" href="./client-styles/add-complain.css" />
    <link rel="stylesheet" href="./client-styles/clientStyles.css" />

    <title>View Response</title>
</head>

<body>
    <div class="container">
        <div class="col-md-9 col-lg-9">
            <form class="login-form" action="" method="POST">
                <h2 class="text-center">View Response</h2>
                <br />
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
                    <label for="complain">Admin Response</label>
                    <textarea name="admin_response" type="text" class="form-control" id="admin_response"
                        placeholder="Admin response ?" required disabled><?php echo $admin_response; ?></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="price">Category</label>
                        <?php
                        $sql_category_selection = "SELECT * FROM tbl_complain_category WHERE id='$category_id'";
                        $res_category_selection = mysqli_query($conn, $sql_category_selection);
                        $row_category = mysqli_fetch_assoc($res_category_selection);
                        $title = $row_category['title'];
                        ?>
                        <input name="category" type="text" class="form-control" id="category"
                            placeholder="Enter a complain category ?" value="<?php echo $title; ?>" disabled />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="contact">Filed On</label>
                        <input name="date" type="date" class="form-control" id="date"
                            value="<?php echo $complain_date; ?>" disabled />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="contact">Updated Status</label>
                        <input name="status" type="text" class="form-control" id="status" value="<?php echo $status; ?>"
                            disabled />
                    </div>
                </div>
                <button name="submit" type="submit" class="btn formBtn">
                    Raise Another Complain
                </button>
            </form>
            <br />
            <!-- sessionalMessages -->
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>

</html>

<?php if (isset($_POST['submit'])) {
    // RedirectingToRaiseNewComplain
    header('location:' . HOMEURL . 'add-complain.php');
}
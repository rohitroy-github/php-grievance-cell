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

// extractingIDFromURL
$complainId = $_GET['complainId']; // extract the id value from the URL parameter

// fetchingPreviousComplainDetails
$sql_tbl_complain = "SELECT * FROM tbl_complain WHERE id='$complainId'";
$res_tbl_complain = mysqli_query(
    $conn,
    $sql_tbl_complain
);
$rows_complain = mysqli_fetch_assoc($res_tbl_complain);
$complain_header = $rows_complain['complain_header'];
$complain = $rows_complain['complain'];
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

    <title>Edit Complain</title>
</head>

<body>
    <div class="container">
        <div class="col-md-7 col-lg-7">
            <form class="login-form" action="" method="POST" enctype="multipart/form-data">
                <h2 class="text-center">Edit Complain</h2>
                <br />
                <div class="form-group">
                    <label for="title">Complain Header</label>
                    <input name="complain_header" type="text" class="form-control" id="complain_header"
                        placeholder="Enter a complain header ?" value="<?php echo $complain_header; ?>" required />
                </div>
                <div class=" form-group">
                    <label for="complain">Detailed Complain</label>
                    <textarea name="complain" type="text" class="form-control" id="complain"
                        placeholder="Explain your complain in brief ?" required><?php echo $complain; ?></textarea>
                </div>
                <div class=" form-group">
                    <label for="price">Select Relevant Category : </label>
                    <select name="category_id">
                        <?php
                        $sql_category_selection = "SELECT * FROM tbl_complain_category";
                        $res_category_selection = mysqli_query($conn, $sql_category_selection);
                        $count = mysqli_num_rows($res_category_selection);

                        if ($count > 0) {
                            while ($row = mysqli_fetch_assoc($res_category_selection)) {

                                $category_id = $row['id'];
                                $title = $row['title'];
                                ?>
                                <option value="<?php echo $category_id; ?>">
                                    <?php echo $title; ?>
                                </option>
                                <?php
                            }
                        } else {
                            ?>
                            <option value="0">No Category Found</option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="username">Full Name</label>
                    <input name="full_name" type="text" class="form-control" id="full_name"
                        placeholder="Enter your full name ?" value="<?php echo $full_name; ?>" disabled />
                </div>
                <div class="form-group">
                    <label for="username">Contact Number</label>
                    <input name="contact" type="text" class="form-control" id="contact"
                        placeholder="Enter your contact number ?" value="<?php echo $contact; ?>" disabled />
                </div>
                <div class="form-group">
                    <label for="username">Contact Email</label>
                    <input name="email" type="email" class="form-control" id="full_name"
                        placeholder="Enter your email ?" value="<?php echo $email; ?>" disabled />
                </div>
                <button name="submit" type="submit" class="btn formBtn" value="add-dish">
                    Lodge Complain
                </button>
            </form>
            <br />
            <!-- sessionalMessages -->
            <div>
                <?php
                if (isset($_SESSION['complain-edit-failure'])) {
                    echo $_SESSION['complain-edit-failure'];
                    unset($_SESSION['complain-edit-failure']);
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
    $complain = $_POST['complain'];
    $complain_header = $_POST['complain_header'];
    $category_id = $_POST['category_id'];

    // Set SQL query
    $sql = "UPDATE tbl_complain SET 
    complain_header='$complain_header',
    complain='$complain',
    category_id='$category_id'
    WHERE id='$complainId'";

    // executeQuery
    $res = mysqli_query($conn, $sql);

    // dataInserted?
    if ($res == true) {
        // Data Insertion Successfull !

        $_SESSION['complain-edit-success'] =
            '<p class="text-center">Complain edited successfully !</p>';

        // Redirect to dashboard
        header('location:' . HOMEURL . '/index.php');
    } else {
        // Data Insertion Failed !

        $_SESSION['complain-edit-failure'] =
            '<p class="text-center">Failed to edit complain. Please try again later !</p>';

        // Redirect to retry
        header('location:' . HOMEURL . '/edit-complain.php');
    }
}
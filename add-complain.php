<!-- <?php
include '../config/constants.php';
include './partials/login-check.php';
?> -->

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

    <title>Raise A Complain</title>
</head>

<body>
    <div class="container">
        <div class="col-md-7 col-lg-7">
            <form class="login-form" action="" method="POST" enctype="multipart/form-data">
                <h2 class="text-center">Lodge A Complain</h2>
                <br />
                <!-- Printing SUCCESSS message -->
                <?php
                if (isset($_SESSION['food-image-upload-failed'])) {
                    echo $_SESSION['food-image-upload-failed'];
                    // Ending session
                    unset($_SESSION['food-image-upload-failed']);
                }

                if (isset($_SESSION['add-food'])) {
                    echo $_SESSION['add-food'];
                    // Ending session
                    unset($_SESSION['add-food']);
                }
                ?>
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
                        placeholder="Enter your email ?" />
                </div>
                <!-- <div class="form-group">
                    <label for="image">Upload Image</label>
                    <input name="image" type="file" id="image" placeholder="Upload dish image ?" required />
                </div> -->
                <button name="submit" type="submit" class="btn formBtn" value="add-dish">
                    Lodge Complain
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
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // Radio input type

    // Featured Option

    if (isset($_POST['featured'])) {
        $featured = $_POST['featured'];
    } else {
        $featured = 'No';
    }

    // Active Option

    if (isset($_POST['active'])) {
        $active = $_POST['active'];
    } else {
        $active = 'No';
    }

    //Checking for image file availibility

    //Display all data of Files/ Image
    // print_r($_FILES['image']);

    if (isset($_FILES['image']['name'])) {
        //Upload Image

        // Auto-Rename our images
        $image_name = $_FILES['image']['name'];

        if ($image_name != '') {
            $ext = explode('.', $image_name);

            $extension = end($ext);

            $image_name_renamed =
                'food-name-' .
                $title .
                '-' .
                rand(0000, 9999) .
                '.' .
                $extension;

            echo $image_name_renamed;

            $source_path = $_FILES['image']['tmp_name'];

            $destination_path = '../images/food/' . $image_name_renamed;

            $upload = move_uploaded_file($source_path, $destination_path);

            // Check Uploaded/ Not ?

            if ($upload == false) {
                // If upload failed ?

                $_SESSION['food-image-upload-failed'] =
                    '<p class="text-center">Failed to upload selected image !</p>';
                header('location:' . HOMEURL . 'admin/add-food.php');

                // Stop Processing

                die();
            }
        }
    } else {
        // Upload Rejected !

        $image_name = '';
    }

    // Set SQL query

    $sql2 = "INSERT INTO tbl_food SET title = '$title',description = '$description',price = $price,image_name = '$image_name_renamed',category_id = $category,featured = '$featured',active = '$active'";

    // Execute query into database
    $res2 = mysqli_query($conn, $sql2);

    // Check whether data is inserted ?

    if ($res2 == true) {
        // Data Insertion Successfull !

        $_SESSION['add-food'] =
            '<p class="text-center">Menu item added successfully !</p>';

        // Redirect to ManageAdmin Page
        header('location:' . HOMEURL . 'admin/manage-food.php');
    } else {
        // Data Insertion Failed !

        $_SESSION['add-food'] =
            '<p class="text-center">Failed to delete menu item !</p>';

        // Redirect to addAdmin Page again
        header('location:' . HOMEURL . 'admin/add-food.php');
    }
}

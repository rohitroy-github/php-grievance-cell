<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./styles/adminStyles.css">
    <title>Grievance Cell | Manage Category</title>
</head>

<body>
    <!-- Menu Section -->
    <div class="top-container">
        <?php include './partials/navbar.php'; ?>
    </div>

    <!-- mainContentSection -->
    <div class="main-container container">
        <div class="content">
            <h2 style="font-weight: 500; text-align: center;">
                <b>Manage Categories</b>
            </h2>
            <div class="d-flex justify-content-center" style="padding: 0; padding-bottom: 1%">
                <a href="add-category.php" class="btn adminPanelBtn">
                    Add New Category
                </a>
            </div>
            <div>
                <?php
                if (isset($_SESSION['category-add-success'])) {
                    echo $_SESSION['category-add-success'];
                    // Ending session
                    unset($_SESSION['category-add-success']);
                }

                if (isset($_SESSION['delete-category'])) {
                    echo $_SESSION['delete-category'];
                    // Ending session
                    unset($_SESSION['delete-category']);
                }

                if (isset($_SESSION['category-update-success'])) {
                    echo $_SESSION['category-update-success'];
                    // Ending session
                    unset($_SESSION['category-update-success']);
                }

                if (isset($_SESSION['no-category-found'])) {
                    echo $_SESSION['no-category-found'];
                    // Ending session
                    unset($_SESSION['no-category-found']);
                }
                ?>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <h5><b>Serial Number</b></h5>
                            </th>
                            <th>
                                <h5><b>Title</b></h5>
                            </th>
                            <th>
                                <h5><b>Actions</b></h5>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = 'SELECT * FROM tbl_complain_category';

                        $res = mysqli_query($conn, $sql);

                        if ($res == true) {
                            // Count rows for checking data availibility
                            $count = mysqli_num_rows($res);

                            $sn = 1;

                            if ($count > 0) {
                                while ($rows = mysqli_fetch_assoc($res)) {

                                    //Run as long as data is available
                                    $id = $rows['id'];
                                    $title = $rows['title'];
                                    ?>
                                    <tr>
                                        <td>
                                            <p>
                                                <?php echo $sn++; ?>
                                            </p>
                                        </td>
                                        <td>
                                            <p>
                                                <?php echo $title; ?>
                                            </p>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="<?php echo HOMEURL; ?>admin/update-category.php?categoryId=
                                    <?php echo $id; ?>" class="btn adminPanelBtn mr-2">
                                                    Update
                                                </a>
                                                <a href="<?php echo HOMEURL; ?>admin/delete-category.php?categoryId=<?php echo $id; ?>"
                                                    class="btn adminPanelBtn mr-2">
                                                    Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <p>
                                    Currently there are no listed categories. <a href="add-category.php"><b>Click here</b></a>
                                    to create one now !
                                </p>
                                <?php
                            }
                        }
                        ?>
                </table>
            </div>
        </div>
    </div>

    <!-- footerSection -->
    <div class="bottom-container">
        <?php include './partials/footer.php'; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
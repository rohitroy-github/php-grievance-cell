<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./client-styles/clientStyles.css">
    <link rel="stylesheet" href="./client-styles/index.css">

    <title>Grievance Cell | My Complains
    </title>
</head>

<body>
    <!-- Menu Section -->
    <div class="top-container">
        <?php include './client-partials/navbar.php'; ?>
    </div>

    <!-- fetchingUserIdWhoLoggedIn -->
    <?php if (isset($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];
    } else {
        header('location: ' . HOMEURL . 'login.php');
        exit();
    } ?>

    <!-- mainContentSection -->
    <div class="main-container container" id="dashboard">
        <div class="content">
            <h2 style="font-weight: 500; text-align: center;">
                <b>My Complains</b>
            </h2>
            <div class="d-flex justify-content-center" style="padding: 1%;">
                <a href="add-complain.php" class="btn adminPanelBtn">Raise A New Complain</a>
            </div>
            <!-- sessionalMessages -->
            <div>
                <p class="text-center">All your <b>Complains</b> are listed here !
                </p>
                <?php if (isset($_SESSION['login'])) {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                } ?>

                <?php if (isset($_SESSION['complain-lodge-success'])) {
                    echo $_SESSION['complain-lodge-success'];
                    unset($_SESSION['complain-lodge-success']);
                } ?>

                <?php if (isset($_SESSION['complain-edit-success'])) {
                    echo $_SESSION['complain-edit-success'];
                    unset($_SESSION['complain-edit-success']);
                } ?>

                <?php if (isset($_SESSION['delete-complain'])) {
                    echo $_SESSION['delete-complain'];
                    unset($_SESSION['delete-complain']);
                } ?>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <h6><b>Serial</b></h6>
                            </th>
                            <th>
                                <h6><b>Header</b></h6>
                            </th>
                            <th>
                                <h6><b>Category</b></h6>
                            </th>
                            <th>
                                <h6><b>Date</b></h6>
                            </th>
                            <th>
                                <h6><b>Status</b></h6>
                            </th>
                            <th>
                                <h6><b>Actions</b></h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_tbl_complain = "SELECT * FROM tbl_complain WHERE user_id=$userId ORDER BY id DESC ";

                        $res_tbl_complain = mysqli_query(
                            $conn,
                            $sql_tbl_complain
                        );

                        if ($res_tbl_complain == true) {
                            $count = mysqli_num_rows($res_tbl_complain);

                            $sn = 1;

                            if ($count > 0) {
                                while ($rows = mysqli_fetch_assoc($res_tbl_complain)) {

                                    $id = $rows['id'];
                                    $complain_header = $rows['complain_header'];

                                    $category_id = $rows['category_id'];
                                    $sql2 = "SELECT * FROM tbl_complain_category WHERE id='$category_id'";
                                    $res2 = mysqli_query($conn, $sql2);
                                    $rows2 = mysqli_fetch_assoc($res2);
                                    $category_title = $rows2['title'];

                                    $complain_date = $rows['complain_date'];
                                    $status = $rows['status'];
                                    ?>
                                    <tr>
                                        <td>
                                            <p>
                                                <?php echo $sn++; ?>
                                            </p>
                                        </td>
                                        <td>
                                            <p>
                                                <?php echo $complain_header; ?>
                                            </p>
                                        </td>
                                        <td>
                                            <p>
                                                <?php echo $category_title; ?>
                                            </p>
                                        </td>
                                        <td>
                                            <p>
                                                <?php echo $complain_date; ?>
                                            </p>
                                        </td>
                                        <td>
                                            <p>
                                                <?php echo $status; ?>
                                            </p>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <?php
                                                if ($status == 'unresolved') {
                                                    ?>
                                                    <a href="<?php echo HOMEURL; ?>edit-complain.php?complainId=<?php echo $id; ?>"
                                                        class="btn adminPanelBtn mr-2">
                                                        Edit Complain
                                                    </a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a href="<?php echo HOMEURL; ?>view-response.php?complainId=<?php echo $id; ?>"
                                                        class="btn adminPanelBtn mr-2">
                                                        View Response
                                                    </a>
                                                    <?php
                                                }
                                                ?>
                                                <a href="<?php echo HOMEURL; ?>delete-complain.php?complainId=<?php echo $id; ?>"
                                                    class="btn adminPanelBtn mr-2">
                                                    Delete Complain
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <p>
                                    Currently there are no registered complains !
                                </p>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- footerSection -->
    <div class="bottom-container">
        <?php include './client-partials/footer.php'; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
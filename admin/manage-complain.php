<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./styles/adminStyles.css">
    <title>Grievance Cell | Manage Complain</title>
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
                <b>Manage Complain</b>
            </h2>
            <!-- sessionalMessages -->
            <div>
                <?php if (isset($_SESSION['update-order'])) {
                    echo $_SESSION['update-order'];
                    // Ending session
                    unset($_SESSION['update-order']);
                } ?>

                <?php if (isset($_SESSION['complain-reponse-success'])) {
                    echo $_SESSION['complain-reponse-success'];
                    // Ending session
                    unset($_SESSION['complain-reponse-success']);
                } ?>
            </div>
            <br />
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <h6><b>Serial</b></h6>
                            </th>
                            <th>
                                <h6><b>Complainant Name</b></h6>
                            </th>
                            <th>
                                <h6><b>Subject</b></h6>
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
                        $sql = 'SELECT * FROM tbl_complain ORDER BY id DESC';

                        $res = mysqli_query($conn, $sql);

                        if ($res == true) {
                            // Count rows for checking data availibility
                            $count = mysqli_num_rows($res);

                            $sn = 1;

                            if ($count > 0) {
                                while ($rows = mysqli_fetch_assoc($res)) {
                                    //Run as long as data is available
                                    $id = $rows['id'];
                                    $full_name = $rows['full_name'];
                                    $complain_header = $rows['complain_header'];

                                    $category_id = $rows['category_id'];
                                    // fetchingCategotyName
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
                                                <?php echo $full_name; ?>
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
                                                <a href="<?php echo HOMEURL; ?>admin/add-response.php?complainId=<?php echo $id; ?>"
                                                    class="btn adminPanelBtn mr-2">
                                                    View / Respond
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td>
                                        <p>
                                            Currently there are no complains !
                                        </p>
                                    </td>
                                </tr>
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
        <?php include './partials/footer.php'; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
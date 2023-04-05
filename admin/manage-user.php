<!-- Main CMS/ Admin file  -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./styles/adminStyles.css">
    <title>Grievance Cell | Manage Users</title>
</head>

<body>
    <!-- Menu Section -->
    <div class="top-container">
        <?php include './partials/navbar.php'; ?>
    </div>

    <!-- Main Content Section-->
    <div class="main-container container">
        <div class="content">
            <h2 style="font-weight: 500; text-align: center;">
                <b>Manage Users</b>
            </h2>
            <!-- sessionalMessages -->
            <div>
                <p class="text-center">All registered <b>Users</b> are listed here !
                </p>
                <?php
                if (isset($_SESSION['update-user-success'])) {
                    echo $_SESSION['update-user-success'];
                    // Ending session
                    unset($_SESSION['update-user-success']);
                }
                if (isset($_SESSION['delete-user'])) {
                    echo $_SESSION['delete-user'];
                    // Ending session
                    unset($_SESSION['delete-user']);
                }
                if (isset($_SESSION['update-password'])) {
                    echo $_SESSION['update-password'];
                    // Ending session
                    unset($_SESSION['update-password']);
                }

                if (isset($_SESSION['user-not-found'])) {
                    echo $_SESSION['user-not-found'];
                    // Ending session
                    unset($_SESSION['user-not-found']);
                }

                if (isset($_SESSION['password-not-match'])) {
                    echo $_SESSION['password-not-match'];
                    // Ending session
                    unset($_SESSION['password-not-match']);
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
                                <h5><b>Full Name</b></h5>
                            </th>
                            <th>
                                <h5><b>Username</b></h5>
                            </th>
                            <th>
                                <h5><b>Actions</b></h5>
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sql = 'SELECT * FROM tbl_user';

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
                                    $username = $rows['username'];
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
                                                <?php echo $username; ?>
                                            </p>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <!-- <a href="<?php echo HOMEURL; ?>admin/update-passowrd.php?id=<?php echo $id; ?>"
                                                    class="btn adminPanelBtn mr-2">
                                                    Change Password
                                                </a> -->
                                                <a href="<?php echo HOMEURL; ?>admin/update-user.php?userId=<?php echo $id; ?>"
                                                    class="btn adminPanelBtn mr-2">
                                                    View | Update
                                                </a>
                                                <a href="<?php echo HOMEURL; ?>admin/delete-user.php?userId=<?php echo $id; ?>"
                                                    class="btn adminPanelBtn">
                                                    Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <?php
                                }
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
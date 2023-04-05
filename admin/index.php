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

  <title>Grievance Cell | Admin's Panel</title>
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
        <b>Grievance Cell | Dashboard</b>
      </h2>
      <!-- sessionalMessages -->
      <div>
        <p class="text-center">A summary of all the activities on <b>Grievance Cell</b> !
        </p>
        <?php if (isset($_SESSION['login'])) {
          echo $_SESSION['login'];
          unset($_SESSION['login']);
        } ?>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>
                <h5><b>Total Admins</b></h5>
              </th>
              <th>
                <h5><b>Total Users</b></h5>
              </th>
              <th>
                <h5><b>Total Categories</b></h5>
              </th>
              <th>
                <h5><b>Pending Complain</b></h5>
              </th>
              <th>
                <h5><b>Resolved Complain</b></h5>
              </th>
            </tr>
          </thead>
          <?php
          // fetchingTotalNumberOfAdmins
          $sql_admin = 'SELECT * FROM tbl_admin';
          $res_admin = mysqli_query($conn, $sql_admin);
          if ($res_admin == true) {
            $count_admin = mysqli_num_rows($res_admin);
          }

          // fetchingTotalNumberOfUsers
          $sql_user = 'SELECT * FROM tbl_user';
          $res_user = mysqli_query($conn, $sql_user);
          if ($res_user == true) {
            $count_user = mysqli_num_rows($res_user);
          }

          // fetchingTotalCategories
          $sql_category = 'SELECT * FROM tbl_complain_category';
          $res_category = mysqli_query($conn, $sql_category);
          if ($res_category == true) {
            $count_category = mysqli_num_rows($res_category);
          }

          // fetchingTotalComplains
          $sql_complain_unresolved = 'SELECT * FROM tbl_complain WHERE status="unresolved"';
          $res_complain_unresolved = mysqli_query($conn, $sql_complain_unresolved);
          if ($res_complain_unresolved == true) {
            $count_complain_unresolved = mysqli_num_rows($res_complain_unresolved);
          }

          $sql_complain_resolved = 'SELECT * FROM tbl_complain WHERE status="resolved"';
          $res_complain_resolved = mysqli_query($conn, $sql_complain_resolved);
          if ($res_complain_resolved == true) {
            $count_complain_resolved = mysqli_num_rows($res_complain_resolved);
          }
          ?>
          <tbody>
            <tr>
              <td>
                <h3>
                  <?php echo $count_admin; ?>
                </h3>
              </td>
              <td>
                <h3>
                  <?php echo $count_user; ?>
                </h3>
              </td>
              <td>
                <h3>
                  <?php echo $count_category; ?>
                </h3>
              </td>
              <td>
                <h3>
                  <?php echo $count_complain_unresolved; ?>
                </h3>
              </td>
              <td>
                <h3>
                  <?php echo $count_complain_resolved; ?>
                </h3>
              </td>
            </tr>
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
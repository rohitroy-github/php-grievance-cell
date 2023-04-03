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

  <?php if (isset($_SESSION['login'])) {
      echo $_SESSION['login'];
      unset($_SESSION['login']);
  } ?>

  <!-- mainContentSection -->
  <div class="main-container container">
    <div class="content">
      <h2 style="font-weight: 500; text-align: center;">
        <b>Dashboard</b>
      </h2>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>
                <h4><b>Admins</b></h4>
              </th>
              <th>
                <h4><b>Users</b></h4>
              </th>
              <th>
                <h4><b>Categories</b></h4>
              </th>
              <th>
                <h4><b>Complains</b></h4>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <h3>
                  5
                </h3>
              </td>
              <td>
   
                <h3>
5                 </h3>
              </td>
              <td>
              
                <h3>
5                </h3>
              </td>
              <td>

                <h3>
       5
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
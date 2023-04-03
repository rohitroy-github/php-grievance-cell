<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./client-styles/clientStyles.css">
    <link rel="stylesheet" href="./client-styles/about.css">

    <title>Grievance Cell | About Us</title>
</head>

<body>
    <!-- navbarPortion -->
    <div class="top-container">
        <?php include './client-partials/navbar.php'; ?>
    </div>
    <div class="main-container container" id="about-us">
        <div class="content">
            <div class="row">
                <div class="col-md-7">
                    <h2>About Us</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse
                        gravida massa non lectus volutpat, in ornare lectus commodo. Duis quis
                        ante sit amet odio dignissim rutrum at a nulla. Sed vel malesuada mi,
                        id dictum sapien. Sed commodo vel lacus sed consequat. Sed fermentum,
                        enim vel convallis blandit, mauris enim hendrerit quam, vel sodales
                        turpis eros ac enim.
                    </p>
                    <p>
                        Nam ac nisi tortor. Maecenas vel mi euismod, eleifend ipsum in, varius
                        arcu. Suspendisse malesuada eget nunc et faucibus. Pellentesque eu
                        dolor massa. Vestibulum nec enim magna. Duis luctus ex justo, ac
                        congue ante finibus id.
                    </p>
                </div>
                <div class="col-md-5">
                    <img src="./assets/logo.png" alt="about us image" />
                </div>
            </div>
        </div>
    </div>
    <!-- footerPortion -->
    <div class="bottom-container">
        <?php include './client-partials/footer.php'; ?>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
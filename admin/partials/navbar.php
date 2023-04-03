<?php
include 'constants.php';
include 'login-check.php';
?>

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="index.php">Admin's Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="link nav-link" href="index.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="link nav-link" href="manage-admin.php">Admins</a>
                </li>
                <li class="nav-item">
                    <a class="link nav-link" href="manage-user.php">Users</a>
                </li>
                <li class="nav-item">
                    <a class="link nav-link" href="manage-category.php">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="link nav-link" href="manage-complain.php">Complains</a>
                </li>
                <li class="nav-item">
                    <a class="link nav-link" href="logout.php">Log Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
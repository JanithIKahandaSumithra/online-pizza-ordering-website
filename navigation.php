<?php

include "components/dbconnection.php"

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NavBar</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        .badge {
            font-size: 0.8rem;
            padding: 2px 6px;
        }
    </style>


</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mt-2">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">PIZZA-PARADISE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse me-5" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active me-3" aria-current="page" href="content.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-3" href="firstMenu.php">Our Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-3" href="contactUs.php">Contact Us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Login / Sign up
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="loginForm.php">Login</a></li>
                            <li><a class="dropdown-item" href="register.php">Sign up</a></li>

                        </ul>
                    </li>

                </ul>





                <a href="cart.php" class="cart-icon position-relative me-5 text-bg-dark">
                    <i class="fas fa-shopping-cart fa-lg">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?php

                            if (isset($_SESSION["user"])) {
                                $uemail = $_SESSION["user"]["email"];
                                $sql = "SELECT * FROM cart WHERE user_email = '$uemail'";
                                $result1 = mysqli_query($con, $sql);
                                $rowCount1 = mysqli_num_rows($result1);
                                echo $rowCount1;
                            } ?>
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </i>
                </a>



                <div class="dropdown me-5">
                    <a href="#" class="profile-icon position-relative me-3 text-bg-dark" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle fa-lg"></i>
                    </a>


                    <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                       
                        <li><a class="dropdown-item" href="myProfile.php">Profile</a></li>
                        
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="logout.php">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                Logout
                            </a></li>
                    </ul>
                </div>

                <form class="d-flex" role="search" method="GET" action="search.php">
                    <input class="form-control me-3 " type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success text-light" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.js"></script>






</body>

</html>
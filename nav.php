<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NavBar</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mt-2">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                Pizza Paradise</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse me-5" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link me-3 text-light active" aria-current="page" href="content.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-3 text-light" href="firstMenu.php">Our Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-3 text-light" href="#">Contact Us</a>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Login / Sign up
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="loginForm.php">Login</a></li>
                            <li><a class="dropdown-item" href="register.php">Sign up</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>

                        </ul>
                    </li>

                </ul>

                <form class="d-flex" role="search">
                    <input class="form-control me-3" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success text-light" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>


    





    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.js"></script>








</body>

</html>
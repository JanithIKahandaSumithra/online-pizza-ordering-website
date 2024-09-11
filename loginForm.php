<?php
session_start();
if (isset($_SESSION["user"])) {
?>
    <script>
        window.location = "content.php";
    </script>
<?php
} else {
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">

        <script src="validate/loginvalidate.js"></script>

    </head>

    <body>

        <?php

        include "navigation.php";

        ?>

        <?php
        if (isset($_POST["login"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            require_once "components/dbconnection.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($con, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {

                    $_SESSION["user"] = $user;
                    // echo $_SESSION["user"]["email"];
        ?>
                    <script>
                        window.location = "content.php";
                    </script>
        <?php

                    die();
                } else {
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }
        }
        ?>

        <div class="mx-auto position-absolute top-50 start-50 translate-middle shadow-lg p-3 mb-5 bg-body rounded" style="width: 500px;">


            <div class="card" style="width: 29rem;">
                <div class="card-header text-center fs-4">
                    USER LOGIN
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">

                        <form action="loginForm.php" id="login" onsubmit="return validateForm()" method="post" novalidate>


                            <div class="form-group fw-semibold">
                                <label for="Email">Email address</label>
                                <input type="email" class="form-control" id="loginemail" name="email" aria-describedby="emailHelp" placeholder="Enter Email">

                            </div>

                            <br>

                            <div class="form-group fw-semibold">
                                <label for="Password">Password</label><br>
                                <input type="password" name="password" class="form-control" id="loginPassword" placeholder="password">
                            </div>

                            <br>
                            <div class="d-flex justify-content-center">

                                <button type="submit" class="btn btn-primary" name="login" style="--bs-btn-padding-y: .5rem; --bs-btn-padding-x: 3.5rem; --bs-btn-font-size: 1.0rem;">Login</button>
                            </div>


                        </form>




                    </li>


                </ul>
            </div>


        </div>




        <script src="js/bootstrap.js"></script>
        <script src="js/bootstrap.bundle.js"></script>
    </body>

    </html>
<?php
}
?>
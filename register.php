<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="validate/registerValidate.js"></script>
</head>

<body>

    <?php

    include "navigation.php";

    ?>

    <?php
    if (isset($_POST["register"])) {
        $firstName = $_POST["firstname"];
        $lastName = $_POST["lastname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $passwordRepeat = $_POST["repeat_password"];

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $errors = array();

       if (empty($firstName) or empty($lastName) or empty($email) or empty($password) or empty($passwordRepeat)) {
            array_push($errors, "All fields are required");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
        }
        if (strlen($password) < 8) {
            array_push($errors, "Password must be at least 8 charactes long");
        }
        if ($password !== $passwordRepeat) {
            array_push($errors, "Password does not match");
        }
        require_once "components/dbconnection.php";
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($con, $sql);
        $rowCount = mysqli_num_rows($result);
        if ($rowCount > 0) {
            array_push($errors, "Email already exists!");
        }
        if (count($errors) > 0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } else {

            $sql = "INSERT INTO users (first_name,last_name, email, password) VALUES ( ? , ? , ? , ? )";
            $stmt = mysqli_stmt_init($con);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $email, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>You are registered successfully.</div>";
            } else {
                die("Something went wrong");
            }
        }
    }
    ?>


    <div class="mx-auto position-absolute top-50 start-50 translate-middle shadow-lg p-3 mb-5 bg-body rounded" style="width: 500px;">


        <div class="card" style="width: 29rem;">
            <div class="card-header text-center fs-4">
                USER REGISTER
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">

                    <form action="register.php" id="register" method="post" onsubmit="return validateRegiterForm()" novalidate>
                        <div class="form-group fw-semibold">
                            <label for="firstname">First Name : </label>
                            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter First Name">
                        </div>
                        <div class="form-group fw-semibold">
                            <label for="lastname">Last Name : </label>
                            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter Last Name">
                        </div>
                        <div class="form-group fw-semibold">
                            <label for="email">Email : </label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email">
                        </div>
                        <div class="form-group fw-semibold">
                            <label for="password">Password : </label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        </div>
                        <div class="form-group fw-semibold">
                            <label for="repeat_password">Retype Password : </label>
                            <input type="password" class="form-control" name="repeat_password" id="repeat_password" placeholder="Repeat Password">
                        </div>
                        <br>
                        <div class="d-flex justify-content-center">

                            <button type="submit" class="btn btn-primary" name="register" style="--bs-btn-padding-y: .5rem; --bs-btn-padding-x: 3.5rem; --bs-btn-font-size: 1.0rem;">Register</button>
                        </div>

                    </form>


                </li>


            </ul>
        </div>


    </div>


</body>

</html>
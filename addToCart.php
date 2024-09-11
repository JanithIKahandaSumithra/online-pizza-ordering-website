<?php
include "components/dbconnection.php";
session_start();
if (isset($_SESSION["user"])) {
    $uemail = $_SESSION["user"]["email"];

        if (isset($_POST["add"])) {
            $productID = $_POST["hidden_id"];
            $Name = $_POST["hidden_name"];
            $price = $_POST["hidden_price"];
            $quantity = $_POST["quantity"];


            $errors = array();

            require_once "components/dbconnection.php";
            $sql = "SELECT product_ID,price FROM cart WHERE product_ID = '$productID' AND price = '$price' AND user_email='$uemail'";
            $result = mysqli_query($con, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount > 0) {
                
                array_push($errors, "Pizza already exists!");
                
            }
            if (count($errors) > 0) {
                foreach ($errors as  $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {

                $sql = "INSERT INTO cart (product_ID,name,quantity, price,user_email) VALUES ( ? , ? , ? , ? , ? )";
                $stmt = mysqli_stmt_init($con);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "isiis", $productID, $Name, $quantity, $price, $uemail);
                    mysqli_stmt_execute($stmt);
                    ?>
                    <script>
                        window.location = "cart.php";    
                    </script>
                   <?php
                   echo "<div class='alert alert-danger'>Added to cart successfully !!!</div>";
                    
                } else {
                    die("Something went wrong");
                }
            }
        }

            if (isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["id"])) {
                $cartItemId = $_GET["id"];
            
                $deleteSql = "DELETE FROM cart WHERE id = '$cartItemId' AND user_email = '$uemail'";
                $deleteResult = mysqli_query($con, $deleteSql);
            
                if ($deleteResult) {
                    echo "<div class='alert alert-success'>Item removed from cart successfully.</div>";
                    ?>
                    <script>
                    window.location = "cart.php";
                    </script>
                
                  <?php  exit;
                } else {
                    echo "<div class='alert alert-danger'>Failed to remove item from cart.</div>";
                }
            }
            
        

    }else{
        ?>
    <script>
        window.location = "loginForm.php";

    </script>
<?php

    }
?>
   

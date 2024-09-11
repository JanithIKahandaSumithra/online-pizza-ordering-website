<?php
include "components/dbconnection.php";
session_start();
if (!isset($_SESSION["user"])) {
    ?>
    <script>
        window.location="loginForm.php";
    </script>
    <?php
}else{


?>


<?php

  
    if (isset($_POST["add"])) {
        if (isset($_SESSION["shopping_cart"])) {
            $item_array_id = array_column($_SESSION["shopping_cart"], "vegpizza_id");
            $item_array_price = array_column($_SESSION["shopping_cart"], "vegpizza_price");
            if (!in_array($_GET["veg_pizza_ID"], $item_array_id) || !in_array($_GET["medium_price"], $item_array_price) || !in_array($_GET["large_price"], $item_array_price)) {
                $count = count($_SESSION["shopping_cart"]);
                $item_array = array(
                    'vegpizza_id' => $_GET["veg_pizza_ID"],
                    'vegpizza_name' => $_POST["hidden_name"],
                    'vegpizza_price' => $_POST["hidden_price"],
                    'vegpizza_quantity' => $_POST["quantity"],
                );
                $_SESSION["shopping_cart"][$count] = $item_array;
                echo '<script>window.location="vegPizzaMenu.php"</script>';
                echo '<script>alert("Product added to cart successfully")</script>';
            } else {
                echo '<script>alert("Product is already in  the cart")</script>';
                echo '<script>window.location="vegPizzaMenu.php"</script>';
            }
        } else {
            $item_array = array(
                'vegpizza_id' => $_GET["veg_pizza_ID"],
                'vegpizza_name' => $_POST["hidden_name"],
                'vegpizza_price' => $_POST["hidden_price"],
                'vegpizza_quantity' => $_POST["quantity"],
            );
            $_SESSION["shopping_cart"][0] = $item_array;
        }
    }

    

    if (isset($_GET["action"])) {
        if ($_GET["action"] == "delete") {
            foreach ($_SESSION["shopping_cart"] as $keys => $value) {
                if ($value["vegpizza_id"] == $_GET["veg_pizza_ID"]) {
                    unset($_SESSION["shopping_cart"][$keys]);
                    echo '<script>alert("Product has been removed")</script>';
                    echo '<script>window.location="cart.php"</script>';
                }
            }
        }
    }




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    
    <?php

    include "navigation.php"

    ?>
    <div class="container">
    <br>
    <h3 class="title2">Shopping Cart Details</h3>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th width="30%">Pizza Name</th>
                <th width="10%">Quantity</th>
                <th width="13%">Price Details</th>
                <th width="10%">Total Price</th>
                <th width="17%">Remove Item</th>
            </tr>

            <?php
            if (!empty($_SESSION["shopping_cart"])) {
                $total = 0;
                foreach ($_SESSION["shopping_cart"] as $key => $value) {
            ?>
                    <tr>
                        <td><?php echo $value["vegpizza_name"]; ?></td>
                        <td><?php echo $value["vegpizza_quantity"]; ?></td>
                        <td><?php echo $value["vegpizza_price"]; ?></td>
                        <td><?php echo number_format($value["vegpizza_price"] * $value["vegpizza_quantity"],2); ?></td>
                        <td><a href="cart.php?action=delete&veg_pizza_ID=<?php echo $value["vegpizza_id"]; ?>"><span class="text-danger">Remove Item</span></a></td>
                    </tr>
                <?php
                    $total = $total + ($value["vegpizza_quantity"] * $value["vegpizza_price"]);
                }
                ?>
                <tr>
                    <td colspan="3">Total</td>
                    <td><?php echo number_format($total,2);?></td>
                    <td></td>
                </tr>
            <?php
            }
            ?>
        </table>
        </div>


</body>

</html>

<?php
}
?>
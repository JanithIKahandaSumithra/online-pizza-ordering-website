<?php
include "components/dbconnection.php";
?>

<?php
include "components/dbconnection.php";
session_start();
if (isset($_SESSION["user"])) {
    $uemail = $_SESSION["user"]["email"];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Checkout</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    </head>

    <body>

        <?php include "navigation.php" ?>


        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data
            $name = mysqli_real_escape_string($con, $_POST["name"]);
            $telephone = mysqli_real_escape_string($con, $_POST["telephone"]);
            $address = mysqli_real_escape_string($con, $_POST["address"]);
            $deliveryDate = $_POST["delivery_date"];
            $deliveryTime = $_POST["delivery_time"];
            $email = $uemail;

            // Calculate the total
            $total = 0;
            $result1 = mysqli_query($con, "SELECT * FROM cart WHERE user_email = '$uemail'");
            while ($value = mysqli_fetch_assoc($result1)) {
                $total += $value["quantity"] * $value["price"];
            }

            $totalPrice = $total;

            // Insert data into the "orders" table
            $sql = "INSERT INTO orders (name, tele_No, address, delivery_date, delivery_time, email, total) VALUES ('$name', '$telephone', '$address', '$deliveryDate', '$deliveryTime', '$email', '$totalPrice')";

            if (mysqli_query($con, $sql)) {
                $orderId = mysqli_insert_id($con); // Retrieve the generated order ID

                // Insert the order details into the "order_details" table
                $result1 = mysqli_query($con, "SELECT * FROM cart WHERE user_email = '$uemail'");
                while ($value = mysqli_fetch_assoc($result1)) {
                    $pizzaName = mysqli_real_escape_string($con, $value["name"]);
                    $quantity = $value["quantity"];
                    $itemPrice = $value["price"];

                    $orderDetailsSql = "INSERT INTO order_details (order_ID, order_items, quantity, price_of_item) VALUES ('$orderId', '$pizzaName', '$quantity', '$itemPrice')";
                    mysqli_query($con, $orderDetailsSql);
                }

                echo '<script>alert("Order placed successfully!")</script>';
                echo '<script>window.location="content.php"</script>';
            } else {
                echo "Error placing the order: " . mysqli_error($con);
            }

            $sqlDeleteCart = "DELETE FROM cart WHERE user_email = '$uemail'";
            if (mysqli_query($con, $sqlDeleteCart)) {
               
            } else {
                echo "Error deleting cart items: " . mysqli_error($con);
            }
        }

        ?>


        <div class="container">
            <br>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card mb-4 shadow">
                        <div class="card-header bg-light">
                            <h3 class="title2 text-center">Checkout</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="30%">Pizza Name</th>
                                            <th width="10%">Quantity</th>
                                            <th width="13%">Price Details</th>
                                            <th width="10%">Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        require_once "components/dbconnection.php";
                                        $sql = "SELECT * FROM cart WHERE user_email = '$uemail'";
                                        $result1 = mysqli_query($con, $sql);
                                        $rowCount1 = mysqli_num_rows($result1);
                                        $total = 0;
                                        if ($rowCount1 > 0) {
                                            while ($value = mysqli_fetch_assoc($result1)) {
                                                $total += $value["quantity"] * $value["price"];
                                        ?>
                                                <tr>
                                                    <td><?php echo $value["name"]; ?></td>
                                                    <td><?php echo $value["quantity"]; ?></td>
                                                    <td><?php echo $value["price"]; ?></td>
                                                    <td><?php echo number_format($value["price"] * $value["quantity"], 2); ?></td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="table-secondary">
                                            <td colspan="3">Total</td>
                                            <td><?php echo number_format($total, 2); ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <!-- Customer Information Form -->
                    <h4>Customer Information</h4>
                    <form class="rounded border p-4 shadow-lg" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);" method="post" action="">
                        <div class="form-group fw-semibold">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                        </div>
                        <br>
                        <div class="form-group fw-semibold">
                            <label for="telephone">Telephone Number:</label>
                            <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Enter your telephone number" required>
                        </div>
                        <br>
                        <div class="form-group fw-semibold">
                            <label for="address">Address:</label>
                            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter your address" required></textarea>
                        </div>
                        <br>
                        <div class="form-group fw-semibold">
                            <label for="delivery_date">Delivery Date:</label>
                            <input type="date" class="form-control" id="delivery_date" name="delivery_date" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+2 days')); ?>" required>
                        </div>
                        <br>
                        <div class="form-group fw-semibold">
                            <label for="delivery_time">Delivery Time:</label>
                            <input type="time" class="form-control" id="delivery_time" name="delivery_time" min="10:00" max="22:00" required>
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary btn-block">Place Order</button>
                    </form>

                    <br><br>

                </div>
            </div>
        </div>


    </body>

    </html>

<?php
} else {
?>
    <script>
        window.location = "loginForm.php";
    </script>
<?php
}
?>
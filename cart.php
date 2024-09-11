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
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shopping Cart Details</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">


    </head>

    <body>

        <?php
        include "navigation.php"
        ?>

        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h3 class="title2 text-center">Shopping Cart Details</h3>
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
                                            <th width="17%">Remove Item</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        require_once "components/dbconnection.php";
                                        $sql = "SELECT * FROM cart WHERE user_email = '$uemail'";
                                        $result1 = mysqli_query($con, $sql);
                                        $rowCount1 = mysqli_num_rows($result1);
                                        $total = 0; // Initialize the $total variable
                                        if ($rowCount1 > 0) {
                                            foreach ($result1 as $key => $value) {
                                                $total += $value["quantity"] * $value["price"];
                                        ?>
                                                <tr>
                                                    <td><?php echo $value["name"]; ?></td>
                                                    <td><?php echo $value["quantity"]; ?></td>
                                                    <td><?php echo $value["price"]; ?></td>
                                                    <td><?php echo number_format($value["price"] * $value["quantity"], 2); ?></td>
                                                    <td>
                                                        <form action="addToCart.php" method="GET">
                                                            <input type="hidden" name="action" value="delete">
                                                            <input type="hidden" name="id" value="<?php echo $value["id"]; ?>">
                                                            <button type="submit" class="btn btn-danger">Remove Item</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo '<tr><td colspan="5">Cart is empty...</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="table-secondary">
                                            <td colspan="3">Total</td>
                                            <td><?php echo number_format($total, 2); ?></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h3 class="title2 text-center">Checkout</h3>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-4">Order Summary:</h5>
                            <div class="row">
                                <div class="col-md-6">Total Items:</div>
                                <div class="col-md-6 text-end"><?php echo $rowCount1; ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">Total Amount:</div>
                                <div class="col-md-6 text-end"><?php echo number_format($total, 2); ?></div>
                            </div>
                            <div class="text-center mt-4">
                                <?php if ($rowCount1 > 0) { ?>
                                    <button class="btn btn-primary" onclick="checkout()">Checkout</button>
                                <?php } else { ?>
                                    <button class="btn btn-primary" disabled>Checkout</button>
                                <?php } ?>
                            </div>

                            <script>
                                function checkout() {
                                    window.location.href = 'checkout.php';
                                }
                            </script>

                        </div>
                    </div>
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
<?php
include "components/dbconnection.php";

session_start();
if (isset($_SESSION["user"])) {
    $uemail = $_SESSION["user"]["email"];

    // Retrieve user's past orders from the database
    $sql = "SELECT orders.delivery_date, orders.delivery_time, order_details.order_items, order_details.quantity, order_details.price_of_item
            FROM orders
            INNER JOIN order_details ON orders.order_ID = order_details.order_ID
            WHERE orders.email = '$uemail'";
    $result = mysqli_query($con, $sql);
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Profile</title>

        
    </head>

    <body>
        <?php include "navigation.php" ?>

        <?php
        require_once "components/dbconnection.php";
        $sql = "SELECT * FROM users WHERE email = '$uemail'";
        $result2 = mysqli_query($con, $sql);
        $rowCount2 = mysqli_num_rows($result2);
        foreach ($result2 as $key => $value) {
            $fname = $value["first_name"];
            $lname = $value["last_name"];
        }
        ?>

        <div class="container">
            <h3 class="text-center mt-5">User Profile</h3>
            <hr>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <h5 class="card-title">Profile Information</h5>
                            <form action="editProfile.php?action=add" method="POST">
                                <div class="form-group">
                                    <label for="fname">First Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $fname; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lname">Last Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $lname; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" value="<?php echo $uemail; ?>" readonly>
                                </div>
                           
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="text-center mt-5">Order History</h3>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Delivery Date</th>
                                        <th>Delivery Time</th>
                                        <th>Ordered Items</th>
                                        <th>Quantity</th>
                                        <th>Price per Item</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['delivery_date'] . "</td>";
                                        echo "<td>" . $row['delivery_time'] . "</td>";
                                        echo "<td>" . $row['order_items'] . "</td>";
                                        echo "<td>" . $row['quantity'] . "</td>";
                                        echo "<td>" . $row['price_of_item'] . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                          
                        </div>
                        
                    </div>
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

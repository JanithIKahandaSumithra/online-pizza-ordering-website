<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
</head>
<body>
    <?php include "navigation.php" ?>

    <div class="container">
        <br><br>
        <h4 class="text-center">Order Management</h4>

        <form id="filter-form" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="filter d-flex justify-content-center">
                <label for="filter-select">Filter:</label>
                <select id="filter-select" name="filter" class="form-control ml-2" onchange="filterOrders()">
                    <option value="all" <?php if (!isset($_GET['filter']) || $_GET['filter'] == 'all') echo 'selected'; ?>>All Orders</option>
                    <option value="today" <?php if (isset($_GET['filter']) && $_GET['filter'] == 'today') echo 'selected'; ?>>Today's Orders</option>
                    <option value="tomorrow" <?php if (isset($_GET['filter']) && $_GET['filter'] == 'tomorrow') echo 'selected'; ?>>Tomorrow's Orders</option>
                </select>
                <button type="submit" class="btn btn-primary ml-2">Apply</button>
            </div>
        </form>

        <table id="orders-table" class="table">
            <thead class="thead-light">
                <tr>
                    <th>Order ID</th>
                    <th>Name</th>
                    <th>Telephone No.</th>
                    <th>Address</th>
                    <th>Delivery Date</th>
                    <th>Delivery Time</th>
                    <th>Email</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="orders-body">
                <?php
                // Database configuration
                include "components/dbconnection.php";

                // Function to fetch and display orders
                function fetchOrders($con, $query) {
                    // Execute the query
                    $result = $con->query($query);

                    // Check if any orders are found
                    if ($result->num_rows > 0) {
                        // Loop through each row of the result
                        while ($row = $result->fetch_assoc()) {
                            // Display order details
                            echo "<tr>";
                            echo "<td>{$row['order_ID']}</td>";
                            echo "<td>{$row['name']}</td>";
                            echo "<td>{$row['tele_No']}</td>";
                            echo "<td>{$row['address']}</td>";
                            echo "<td>{$row['delivery_date']}</td>";
                            echo "<td>{$row['delivery_time']}</td>";
                            echo "<td>{$row['email']}</td>";
                            echo "<td>{$row['total']}</td>";
                            echo "<td><input type='checkbox' onchange='completeOrder(this, {$row['order_ID']})'></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No orders found</td></tr>";
                    }
                }

                // Check if a filter is selected
                if (isset($_GET['filter'])) {
                    $filter = $_GET['filter'];

                    // Filter orders based on the selected option
                    if ($filter == 'today') {
                        $query = "SELECT * FROM orders WHERE delivery_date = CURDATE()";
                        fetchOrders($con, $query);
                    } elseif ($filter == 'tomorrow') {
                        $query = "SELECT * FROM orders WHERE delivery_date = CURDATE() + INTERVAL 1 DAY";
                        fetchOrders($con, $query);
                    } else {
                        // Fetch and display all orders
                        $query = "SELECT * FROM orders";
                        fetchOrders($con, $query);
                    }
                } else {
                    // Fetch and display all orders by default
                    $query = "SELECT * FROM orders";
                    fetchOrders($con, $query);
                }

                // Close the database connection
                $con->close();
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function completeOrder(checkbox, orderID) {
            // Replace with your code to mark order as completed
            if (checkbox.checked) {
                console.log("Order " + orderID + " completed");
            } else {
                console.log("Order " + orderID + " incomplete");
            }
        }
    </script>
</body>
</html>

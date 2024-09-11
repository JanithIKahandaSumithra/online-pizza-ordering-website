<?php

include "components/dbconnection.php"

?>
<!DOCTYPE html>
<html>

<head>
    <title>Add Pizza and Beverages</title>


</head>

<body>

    <?php include "navigation.php" ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">View Tables</h4>
                        <div class="btn-group" role="group" aria-label="Toggle Tables">
                            <button type="button" class="btn btn-primary toggle-btn" data-target="veg-pizza-table">Veg Pizza</button>
                            <button type="button" class="btn btn-primary toggle-btn" data-target="nonveg-pizza-table">Non-Veg Pizza</button>
                            <button type="button" class="btn btn-primary toggle-btn" data-target="beverages-table">Beverages</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="table-container" id="veg-pizza-table">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Veg Pizza List</h4>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Medium Price</th>
                                        <th>Large Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Fetch veg pizza items from database
                                    include "components/dbconnection.php";
                                    $sql = "SELECT * FROM veg_pizza";
                                    $result = $con->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["veg_pizza_ID"] . "</td>";
                                            echo "<td><img src='" . $row["image"] . "' width='50' height='50'></td>";
                                            echo "<td>" . $row["name"] . "</td>";
                                            echo "<td>" . $row["description"] . "</td>";
                                            echo "<td>" . $row["medium_price"] . "</td>";
                                            echo "<td>" . $row["large_price"] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>No veg pizza items found</td></tr>";
                                    }

                                    $con->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="table-container" id="nonveg-pizza-table">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Non-Veg Pizza List</h4>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Medium Price</th>
                                        <th>Large Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Fetch non-veg pizza items from database
                                    include "components/dbconnection.php";

                                    $sql = "SELECT * FROM non_veg_pizza";
                                    $result = $con->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["non_veg_pizza_ID"] . "</td>";
                                            echo "<td><img src='" . $row["image"] . "' width='50' height='50'></td>";
                                            echo "<td>" . $row["name"] . "</td>";
                                            echo "<td>" . $row["description"] . "</td>";
                                            echo "<td>" . $row["medium_price"] . "</td>";
                                            echo "<td>" . $row["large_price"] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>No non-veg pizza items found</td></tr>";
                                    }

                                    $con->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="table-container" id="beverages-table">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Beverages List</h4>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Fetch beverage items from database
                                    include "components/dbconnection.php";

                                    $sql = "SELECT * FROM beverages";
                                    $result = $con->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["bev_ID"] . "</td>";
                                            echo "<td><img src='" . $row["image"] . "' width='50' height='50'></td>";
                                            echo "<td>" . $row["name"] . "</td>";
                                            echo "<td>" . $row["price"] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No beverage items found</td></tr>";
                                    }

                                    $con->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Hide all table containers initially
        const tableContainers = document.querySelectorAll('.table-container');
        tableContainers.forEach(container => {
            container.style.display = 'none';
        });

        // Toggle tables when the corresponding button is clicked
        const toggleButtons = document.querySelectorAll('.toggle-btn');
        toggleButtons.forEach((button, index) => {
            button.addEventListener('click', function() {
                const targetId = button.getAttribute('data-target');
                const targetTable = document.getElementById(targetId);

                if (targetTable.style.display === 'none') {
                    tableContainers.forEach(container => {
                        container.style.display = 'none';
                    });
                    targetTable.style.display = 'block';
                } else {
                    targetTable.style.display = 'none';
                }
            });
        });
    </script>



    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="card-title">Add Pizza</h2>
                        <form action="addPizza.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="pizzaCategory">Pizza Category:</label>
                                <select class="form-control" id="pizzaCategory" name="pizzaCategory" required>
                                    <option value="veg">Veg Pizza</option>
                                    <option value="nonveg">Non-Veg Pizza</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pizzaName">Pizza Name:</label>
                                <input type="text" class="form-control" id="pizzaName" name="pizzaName" required>
                            </div>
                            <div class="form-group">
                                <label for="pizzaDescription">Pizza Description:</label>
                                <textarea class="form-control" id="pizzaDescription" name="pizzaDescription" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="mediumPrice">Medium Pizza Price:</label>
                                <input type="number" class="form-control" id="mediumPrice" name="mediumPrice" required>
                            </div>
                            <div class="form-group">
                                <label for="largePrice">Large Pizza Price:</label>
                                <input type="number" class="form-control" id="largePrice" name="largePrice" required>
                            </div>
                            <div class="form-group">
                                <label for="pizzaImage">Pizza Image:</label>
                                <input type="file" class="form-control-file" id="pizzaImage" name="pizzaImage" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Pizza</button>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="card-title">Add Beverage</h2>
                        <form action="addBeverages.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="beverageName">Beverage Name:</label>
                                <input type="text" class="form-control" id="beverageName" name="beverageName" required>
                            </div>
                            <div class="form-group">
                                <label for="beveragePrice">Beverage Price:</label>
                                <input type="number" class="form-control" id="beveragePrice" name="beveragePrice" required>
                            </div>
                            <div class="form-group">
                                <label for="beverageImage">Beverage Image:</label>
                                <input type="file" class="form-control-file" id="beverageImage" name="beverageImage" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Beverage</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Delete Item Form -->
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h2>Delete Item</h2>
                    <form id="deleteItemForm" method="post">
                        <div class="form-group">
                            <label for="deleteItemType">Item Type:</label>
                            <select class="form-control" id="deleteItemType" name="deleteItemType" required>
                                <option value="veg-pizza">Veg Pizza</option>
                                <option value="nonveg-pizza">Non-Veg Pizza</option>
                                <option value="beverages">Beverages</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="deleteItemID">Item ID:</label>
                            <input type="text" class="form-control" id="deleteItemID" name="deleteItemID" required>
                        </div>
                        <button type="submit" class="btn btn-danger" name="deleteItem">Delete</button>
                    </form>
                </div>
            </div>
        </div>


        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Delete Item
            if (isset($_POST["deleteItem"])) {
                $itemType = $_POST["deleteItemType"];
                $itemID = $_POST["deleteItemID"];

                // Perform the deletion operation
                include "components/dbconnection.php";
                $tableName = "";

                switch ($itemType) {
                    case "veg-pizza":
                        $tableName = "veg_pizza";
                        break;
                    case "nonveg-pizza":
                        $tableName = "non_veg_pizza";
                        break;
                    case "beverages":
                        $tableName = "beverages";
                        break;
                }

                if ($tableName !== "") {
                    $sql = "DELETE FROM $tableName WHERE ";
                    if ($itemType === "beverages") {
                        $sql .= "bev_ID = ?";
                    } else {
                        $sql .= ($itemType === "veg-pizza") ? "veg_pizza_ID = ?" : "non_veg_pizza_ID = ?";
                    }

                    $stmt = $con->prepare($sql);
                    $stmt->bind_param("s", $itemID);

                    if ($stmt->execute()) {
                        echo "Item deleted successfully!";
                    } else {
                        echo "Error deleting item: " . $stmt->error;
                    }

                    $stmt->close();
                } else {
                    echo "Invalid item type selected.";
                }

                $con->close();
            }
        }
        ?>


    </div>







</body>

</html>
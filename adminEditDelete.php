<?php
include "components/dbconnection.php";
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Page</title>

    <style>
        .container {
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Code for updating the pizza details

        if (isset($_POST["updateVegPizza"])) {
            // Update Veg Pizza
            $pizzaID = $_POST["vegPizzaID"];
            $pizzaName = $_POST["vegPizzaName"];
            $pizzaDescription = $_POST["vegPizzaDescription"];
            $mediumPrice = $_POST["vegMediumPrice"];
            $largePrice = $_POST["vegLargePrice"];

            // Check if an image file was uploaded
            if (isset($_FILES["vegPizzaImage"]) && $_FILES["vegPizzaImage"]["error"] == 0) {
                $image = $_FILES["vegPizzaImage"]["tmp_name"];
                $imageName = $_FILES["vegPizzaImage"]["name"];
                $imagePath = "img/Veg/" . $imageName;

                // Move the uploaded image to the desired location
                move_uploaded_file($image, $imagePath);
            }

            // Prepare the SQL statement
            $sql = "UPDATE veg_pizza SET name=?, description=?, medium_price=?, large_price=?, image=? WHERE veg_pizza_ID=?";

            // Prepare the statement and bind parameters
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ssdssi", $pizzaName, $pizzaDescription, $mediumPrice, $largePrice, $imagePath, $pizzaID);

            // Execute the statement
            if ($stmt->execute()) {
                echo '<script>alert("Details updated successfully!")</script>';
                echo '<script>window.location="adminEditDelete.php"</script>';
            } else {
                echo "Error updating veg pizza details: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } elseif (isset($_POST["updateNonVegPizza"])) {
            // Update Non-Veg Pizza
            $pizzaID = $_POST["nonVegPizzaID"];
            $pizzaName = $_POST["nonVegPizzaName"];
            $pizzaDescription = $_POST["nonVegPizzaDescription"];
            $mediumPrice = $_POST["nonVegMediumPrice"];
            $largePrice = $_POST["nonVegLargePrice"];

            // Check if an image file was uploaded
            if (isset($_FILES["nonVegPizzaImage"]) && $_FILES["nonVegPizzaImage"]["error"] == 0) {
                $image = $_FILES["nonVegPizzaImage"]["tmp_name"];
                $imageName = $_FILES["nonVegPizzaImage"]["name"];
                $imagePath = "img/Non-veg/" . $imageName;

                // Move the uploaded image to the desired location
                move_uploaded_file($image, $imagePath);
            }

            // Prepare the SQL statement
            $sql = "UPDATE non_veg_pizza SET name=?, description=?, medium_price=?, large_price=?, image=? WHERE non_veg_pizza_ID=?";

            // Prepare the statement and bind parameters
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ssdssi", $pizzaName, $pizzaDescription, $mediumPrice, $largePrice, $imagePath, $pizzaID);

            // Execute the statement
            if ($stmt->execute()) {
                echo '<script>alert("Details updated successfully!")</script>';
                echo '<script>window.location="adminEditDelete.php"</script>';
            } else {
                echo "Error updating non-veg pizza details: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } elseif (isset($_POST["updateBeverage"])) {
            // Update Beverage
            $beverageID = $_POST["beverageID"];
            $beverageName = $_POST["beverageName"];
            $beveragePrice = $_POST["beveragePrice"];

            // Check if an image file was uploaded
            if (isset($_FILES["beverageImage"]) && $_FILES["beverageImage"]["error"] == 0) {
                $image = $_FILES["beverageImage"]["tmp_name"];
                $imageName = $_FILES["beverageImage"]["name"];
                $imagePath = "img/Beverages/" . $imageName;

                // Move the uploaded image to the desired location
                move_uploaded_file($image, $imagePath);
            }

            // Prepare the SQL statement
            $sql = "UPDATE beverages SET name=?, price=?, image=? WHERE bev_ID=?";

            // Prepare the statement and bind parameters
            $stmt = $con->prepare($sql);
            $stmt->bind_param("sdsi", $beverageName, $beveragePrice, $imagePath, $beverageID);

            // Execute the statement
            if ($stmt->execute()) {
                echo '<script>alert("Details updated successfully!")</script>';
                echo '<script>window.location="adminEditDelete.php"</script>';
            } else {
                echo "Error updating beverage details: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        }

        // Close the database connection
        $con->close();
    }
    ?>

    <?php include "navigation.php"; ?>
    <div class="container">
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
        <div class="row">

            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h2>Edit Veg Pizza</h2>
                        <form id="vegPizzaForm" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="vegPizzaID">Pizza ID:</label>
                                <input type="text" class="form-control" id="vegPizzaID" name="vegPizzaID" required>
                            </div>
                            <div class="form-group">
                                <label for="vegPizzaImage">Image:</label>
                                <input type="file" class="form-control-file" id="vegPizzaImage" name="vegPizzaImage">
                            </div>
                            <div class="form-group">
                                <label for="vegPizzaName">Name:</label>
                                <input type="text" class="form-control" id="vegPizzaName" name="vegPizzaName" required>
                            </div>
                            <div class="form-group">
                                <label for="vegPizzaDescription">Description:</label>
                                <input type="text" class="form-control" id="vegPizzaDescription" name="vegPizzaDescription" required>
                            </div>
                            <div class="form-group">
                                <label for="vegMediumPrice">Medium Price:</label>
                                <input type="number" step="0.01" class="form-control" id="vegMediumPrice" name="vegMediumPrice" required>
                            </div>
                            <div class="form-group">
                                <label for="vegLargePrice">Large Price:</label>
                                <input type="number" step="0.01" class="form-control" id="vegLargePrice" name="vegLargePrice" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="updateVegPizza">Update</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h2>Edit Non-Veg Pizza</h2>
                        <form id="nonVegPizzaForm" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nonVegPizzaID">Pizza ID:</label>
                                <input type="text" class="form-control" id="nonVegPizzaID" name="nonVegPizzaID" required>
                            </div>
                            <div class="form-group">
                                <label for="nonVegPizzaImage">Image:</label>
                                <input type="file" class="form-control-file" id="nonVegPizzaImage" name="nonVegPizzaImage">
                            </div>
                            <div class="form-group">
                                <label for="nonVegPizzaName">Name:</label>
                                <input type="text" class="form-control" id="nonVegPizzaName" name="nonVegPizzaName" required>
                            </div>
                            <div class="form-group">
                                <label for="nonVegPizzaDescription">Description:</label>
                                <input type="text" class="form-control" id="nonVegPizzaDescription" name="nonVegPizzaDescription" required>
                            </div>
                            <div class="form-group">
                                <label for="nonVegMediumPrice">Medium Price:</label>
                                <input type="number" step="0.01" class="form-control" id="nonVegMediumPrice" name="nonVegMediumPrice" required>
                            </div>
                            <div class="form-group">
                                <label for="nonVegLargePrice">Large Price:</label>
                                <input type="number" step="0.01" class="form-control" id="nonVegLargePrice" name="nonVegLargePrice" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="updateNonVegPizza">Update</button>
                        </form>
                    </div>
                </div>
            </div>



        </div>
            <br><br>
            
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h2>Edit Beverage</h2>
                    <form id="beverageForm" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="beverageID">Beverage ID:</label>
                            <input type="text" class="form-control" id="beverageID" name="beverageID" required>
                        </div>
                        <div class="form-group">
                            <label for="beverageImage">Image:</label>
                            <input type="file" class="form-control-file" id="beverageImage" name="beverageImage">
                        </div>
                        <div class="form-group">
                            <label for="beverageName">Name:</label>
                            <input type="text" class="form-control" id="beverageName" name="beverageName" required>
                        </div>
                        <div class="form-group">
                            <label for="beveragePrice">Price:</label>
                            <input type="number" step="0.01" class="form-control" id="beveragePrice" name="beveragePrice" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="updateBeverage">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>


    <div class="container">
        <div class="row">



        </div>
    </div>


    <script>
        $(document).ready(function() {
            // Handle click on Veg Pizza table rows
            $('#vegPizzaTable tbody').on('click', 'tr', function() {
                var pizzaID = $(this).data('id');
                populateForm('vegPizzaForm', pizzaID);
            });

            // Handle click on Non-Veg Pizza table rows
            $('#nonVegPizzaTable tbody').on('click', 'tr', function() {
                var pizzaID = $(this).data('id');
                populateForm('nonVegPizzaForm', pizzaID);
            });

            // Handle click on Beverage table rows
            $('#beverageTable tbody').on('click', 'tr', function() {
                var beverageID = $(this).data('id');
                populateForm('beverageForm', beverageID);
            });

            // Function to populate form fields with data based on ID
            function populateForm(formID, itemID) {
                var form = $('#' + formID);
                var row = $('tr[data-id="' + itemID + '"]');
                var cells = row.find('td');

                form.find('#' + formID + 'ID').val(cells.eq(0).text());
                form.find('#' + formID + 'Name').val(cells.eq(2).text());
                form.find('#' + formID + 'Description').val(cells.eq(3).text());
                form.find('#' + formID + 'MediumPrice').val(cells.eq(4).text());
                form.find('#' + formID + 'LargePrice').val(cells.eq(5).text());
            }
        });
    </script>
</body>

</html>
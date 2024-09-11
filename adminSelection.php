<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selection</title>
</head>

<body>
    <?php include "navigation.php" ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <button class="btn btn-primary btn-lg btn-block" onclick="location.href='adminAddItems.php'">Add / Delete Items</button>
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary btn-lg btn-block" onclick="location.href='adminEditDelete.php'">Edit/Delete Items</button>
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary btn-lg btn-block" onclick="location.href='adminOrders.php'">View Orders</button>
            </div>
        </div>
    </div>



</body>

</html>
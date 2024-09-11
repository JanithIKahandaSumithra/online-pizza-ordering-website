<?php

include "components/dbconnection.php"

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beverages</title>
</head>

<body>

    <?php include "navigation.php" ?>

    <br>
    <div class="container">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="content.php">Home</a></li>
                <li class="breadcrumb-item"><a href="firstMenu.php">Our Menu</a></li>
                <li class="breadcrumb-item active" aria-current="page">BEVERAGES</li>
            </ol>
        </nav>
    </div>

    <br>
    <h4 class="text-center">Pizza-Paradise BEVERAGES</h4>
    <br><br>

    <div class="container">

        <div class="row row-cols-1 row-cols-md-4 g-4 text-center">

            <?php
            $query = "select * from beverages order by bev_ID asc";
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
            ?>

                    <div class="col">
                        <div class="card shadow p-3 mb-5 bg-body rounded">
                            <form method="post" action="addToCart.php?action=add&bev_ID=<?php echo $row["bev_ID"]; ?>">
                                <input type="hidden" name="hidden_id" value="<?php echo $row["bev_ID"]; ?>">
                                <img src="<?php echo $row["image"]; ?>" class="card-img-top" alt="...">
                                <div class="card-body" style="background-color: #F8F5EA;">
                                    <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>">
                                    <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
                                    <h5 class="card-title"><?php echo $row["name"]; ?></h5>
                                    <br>
                                    <div class=" d-flex align-items-center">
                                        <label for="quantity" class="me-2">Quantity</label>
                                        <input type="text" name="quantity" class="form-control" value="1" placeholder="Quantity">
                                    </div>


                                </div>
                                <div class="card-footer">

                                    <input type="submit" name="add" class="btn btn-outline-dark" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: 2rem; --bs-btn-font-size: 1rem;" value="Add to cart">
                                </div>
                            </form>
                        </div>
                    </div>

            <?php }
            }

            ?>


        </div>
    </div>

        <?php
        include "footer.php";
        ?>


</body>

</html>
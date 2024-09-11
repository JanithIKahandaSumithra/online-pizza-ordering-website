
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu</title>

</head>

<body>

  <?php include "navigation.php" ?>

  <div class="container">

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="content.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Our Menu</li>
      </ol>
    </nav>

    <h4 class="text-center">Pizza-Paradise MENU</h4>
    <br>

    <div class="row row-cols-1 row-cols-md-3 g-4 text-center ">
      <div class="col">
        <div class="card h-100 shadow p-3 mb-5 bg-body rounded">
          <img src="img/vegetarian-pizza.jpg" class="card-img-top" alt="...">
          <div class="card-body " style="background-color: #F8F5EA;">
            <h4 class="card-title">VEG PIZZA</h4>
            <p class="card-text">A delight for veggie lovers! Choose from our wide range of delicious vegetarian pizzas, it's softer and tastier</p>
            <a href="vegPizzaMenu.php" class="btn btn-outline-dark">VIEW ALL</a>
          </div>

        </div>
      </div>
      <div class="col">
        <div class="card h-100 shadow p-3 mb-5 bg-body rounded">
          <img src="img/Non-Vege.png" class="card-img-top" alt="...">
          <div class="card-body" style="background-color: #F8F5EA;">
            <h4 class="card-title">NON-VEG PIZZA</h4>
            <p class="card-text">Choose your favourite non-veg pizzas from the Pizza-Paradise's Pizza menu. Get fresh non-veg pizza with your choice of crusts & toppings</p>
            <a href="nonVegPizzaMenu.php" class="btn btn-outline-dark">VIEW ALL</a>
          </div>

        </div>
      </div>
      <div class="col">
        <div class="card h-100 shadow p-3 mb-5 bg-body rounded">
          <img src="img/Beverages.png" class="card-img-top" alt="...">
          <div class="card-body" style="background-color: #F8F5EA;">
            <h4 class="card-title">BEVERAGES</h4>
            <p class="card-text">Complement your pizza with wide range of beverages available at Pizza-Paradise </p>
            <br>
            <a href="beverages.php" class="btn btn-outline-dark ">VIEW ALL</a>
          </div>

        </div>
      </div>
    </div>

    <br><br><br>


  </div>

  <?php
  include "footer.php";
  ?>



</body>

</html>
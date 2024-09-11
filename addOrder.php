<?php
       
       if ($_SERVER["REQUEST_METHOD"] == "POST") {
           // Retrieve form data
           $name = mysqli_real_escape_string($con, $_POST["name"]);
           $telephone = mysqli_real_escape_string($con, $_POST["telephone"]);
           $address = mysqli_real_escape_string($con, $_POST["address"]);
           $deliveryDate = $_POST["delivery_date"];
           $deliveryTime = $_POST["delivery_time"];
           $email = $uemail; 
           $totalPrice = $total; 

           // Insert data into the "orders" table
           $sql = "INSERT INTO orders (name, tele_No, address, delivery_date, delivery_time, email, total) VALUES ('$name', '$telephone', '$address', '$deliveryDate', '$deliveryTime', '$email', '$totalPrice')";

           // Execute the query
           if (mysqli_query($con, $sql)) {
               $orderId = mysqli_insert_id($con); // Retrieve the generated order ID

               // Insert the order details into the "order_details" table
               foreach ($result1 as $key => $value) {
                   $pizzaName = mysqli_real_escape_string($con, $value["name"]);
                   $quantity = $value["quantity"];
                   $itemPrice = $value["price"];

                   $orderDetailsSql = "INSERT INTO order_details (order_ID, order_items, quantity,price_of_item) VALUES ('$orderId', '$pizzaName', '$quantity', '$itemPrice')";
                   mysqli_query($con, $orderDetailsSql);
               }

               
           } else {
               // An error occurred while inserting the data
               // Handle the error appropriately (e.g., display an error message)
               echo "Error placing the order: " . mysqli_error($con);
           }
       }

       ?>
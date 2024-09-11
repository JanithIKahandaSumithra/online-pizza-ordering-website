<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <style>
       

        .card {
            border: none;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .card-title {
            margin-bottom: 20px;
        }

        .contact-details,
        .form-container {
            padding: 20px;
        }

        .navbar {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <?php
    include "navigation.php";


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $message = $_POST["message"];
    
        $sql = "INSERT INTO contact (name, email, message) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $message);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($con);
    
        
        echo '<script>alert("Thank you for contacting us.");</script>';
    }

    ?>

    <div class="container-fluid">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="card-title">Contact Us</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-container">
                            <div class="card-body">
                                <h5 class="card-title">Contact Form</h5>
                                <form action="#" method="POST">
                                    <div class="form-group">
                                        <label for="name">Your Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Your Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="message">Your Message</label>
                                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Send Message</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 contact-details">
                            <div class="card-body">
                                <h5 class="card-title">Contact Details</h5>
                                <ul class="list-unstyled">
                                    <li><strong>Address:</strong><br>123 Pizza Street<br>Colombo</li>
                                    <li><strong>Phone:</strong><br>+94 723356789</li>
                                    <li><strong>Email:</strong><br>info@pizzaparadise.com</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br><br><br>

  <?php
  include "footer.php";
  ?>

    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>

<?php
// Database connection
include "components/dbconnection.php";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["beverageName"];
    $price = $_POST["beveragePrice"];

    // Upload image
    $targetDir = "img/beverages/";
    $targetFile = $targetDir . basename($_FILES["beverageImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a valid image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["beverageImage"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "Error: Invalid image file.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Error: File already exists.";
        $uploadOk = 0;
    }

    // Check file size (limit to 2MB)
    if ($_FILES["beverageImage"]["size"] > 2000000) {
        echo "Error: File size exceeds the limit of 2MB.";
        $uploadOk = 0;
    }

    // Allow only specific image file formats (you can customize this as per your needs)
    if (
        $imageFileType !== "jpg" &&
        $imageFileType !== "jpeg" &&
        $imageFileType !== "png" &&
        $imageFileType !== "gif"
    ) {
        echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk === 0) {
        echo "Error: File upload failed.";
    } else {
        // Move uploaded file to destination directory
        if (move_uploaded_file($_FILES["beverageImage"]["tmp_name"], $targetFile)) {
            // Insert data into the database
            $sql = "INSERT INTO beverages (image, name, price)
                    VALUES ('$targetFile', '$name', '$price')";

            if ($con->query($sql) === true) {
                echo '<script>alert("Beverage added successfully!")</script>';
                echo '<script>window.location="adminAddItems.php"</script>';
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error: Failed to upload file.";
        }
    }
}

$con->close();
?>

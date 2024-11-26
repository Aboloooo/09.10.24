<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bank of icon  https://boxicons.com/  -->
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="stylesheet" href="../style.css? <?= time(); ?>">
</head>

<body>
    <?php
    include_once("../phpLibrary/MyLibrary.php");
    NavigationBarE("");
    ?>

    <?php
    $completedProductDetails = false;

    if (isset($_POST["submit"])) {
        $productName = $_POST["productName"];
        $productDescription = $_POST["productDescription"];
        $productPrice = $_POST["productPrice"];
        $productSize = $_POST["productSize"];

        $productGender = $_POST["productGender"];
        $productGenderUpperCase = strtoupper($productGender);
        if ($productGenderUpperCase != "MALE" && $productGenderUpperCase != "FEMALE" && $productGenderUpperCase != "BOTH") {
            die("Error: Gender can be considered only (Male, Female or Both)");
        }

        // fail to import the img
        // $productImg = $_POST["productImg"];

        // now checking if all the neccesary inputs are filled up
        if (!isset($productName, $productDescription, $productPrice,  $productSize, $productGender)) {
            die("Error: One or more product details are missing.");
            $completedProductDetails = false;
        } else {
            $completedProductDetails = true;
        }

        if ($completedProductDetails) {
            // $productName, $productDescription, $productPrice,  $productSize, $productGender, $productImg
            $productBank =  fopen("../DataBases/Products.csv", "a");
            $NewProduct = [$productName, $productDescription, $productPrice,  $productSize, $productGender];

            fputcsv($productBank, $NewProduct);
        }

        /*        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["productImg"]["productImg"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }*/

        /////////   TEST TEACHER

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }



        //// END TEST TEACHER



    }
    ?>

    <div class="container-new-product">
        <form method="POST" class="form" enctype="multipart/form-data">
            <div class="img-new-product">
                <label for="fileToUpload">Product Image:</label>
                <input type="file" name="fileToUpload">
            </div>
            <div class="detail-new-product">
                <label for="">Product name:</label>
                <input type="text" name="productName">

                <label for="">Description:</label>
                <input type="text" name="productDescription">

                <label for="">Price:</label>
                <input type="money" name="productPrice">

                <label for="">Sizes availible:</label>
                <input type="text" name="productSize">

                <label for="">Gender usage:</label>
                <input type="text" name="productGender">

                <input type="submit" value="submit" name="submit">

            </div>
        </form>
    </div>


    <!-- the following function will create a end bar in the end of the content of a webpage -->
    <?php
    EndBar()
    ?>

</body>

</html>
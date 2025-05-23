<?php
include_once("../phpLibrary/MyLibrary.php");
?>
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
    NavigationBarE("");
    ?>

    <?php
    $completedProductDetails = false;
    if (isset($_POST["submit"])) {
        $productName = $_POST["productName"];
        $productPrice = $_POST["productPrice"];

        $productDescriptionEN = $_POST["productDescription(EN)"];
        $productDescriptionFR = $_POST["productDescription(FR)"];

        $productGenderEN = $_POST["productGender(EN)"];
        $productGenderFR = $_POST["productGender(FR)"];

        // now checking if all the neccesary inputs are filled up
        if (empty($productName) || empty($productDescriptionEN) || empty($productDescriptionFR)  || empty($productPrice)  || empty($productGenderEN) || empty($productGenderFR)) {
            die("Error: One or more product details are missing.");
            $completedProductDetails = false;
        } else {
            $completedProductDetails = true;
        }

        /* CSV */
        /*         if ($completedProductDetails) {
            $ProductsDataBase = fopen("../DataBases/Products.csv", "r");
            $lastId = 0;
            $line = fgets($ProductsDataBase);
            while (!feof($ProductsDataBase)) {
                $line = fgets($ProductsDataBase);
                $splitsOfEachLine = explode(",", $line);
                if (count($splitsOfEachLine) >= 8) {
                    $lastId = $splitsOfEachLine[0];
                }
            }
            $lastId++;
            //print($_SESSION["LastID"]++);
            //  ID, $productName, $productDescription, $productPrice,  $productSize, $productGender, $productImg
            $productBank =  fopen("../DataBases/Products.csv", "a");
            $NewProduct = [$lastId, $productName, $productDescriptionEN, $productPrice, $productGenderEN, "../img/new_product/new_product.jpg", $productDescriptionFR, $productGenderFR];

            fputcsv($productBank, $NewProduct);
        } */
        /* SQL */
        if ($completedProductDetails) {
            $sqlInsertNewProductDetail = $connection->prepare('insert into products(productName, Price, GenderEN, img, GenderFR) VALUES (?,?,?,?,?)');
            $defaultImg = '../img/new_product/new_product.jpg';
            $sqlInsertNewProductDetail->bind_param('sisss', $productName, $productPrice, $productGenderEN, $defaultImg, $productGenderFR);
            $sqlInsertNewProductDetail->execute();
        }
    }
    ?>

    <div class="container-new-product">
        <h1><?= $t["New product"] ?></h1>
        <form method="POST" class="form" enctype="multipart/form-data">
            <div class="img-new-product">
                <label for="fileToUpload"><?= $t["Product Image"] ?>:</label>
                <input type="file" name="fileToUpload">
            </div>
            <div class="detail-new-product">

                <input type="text" placeholder="<?= $t["Product name"] ?>:" name="productName">

                <input type="text" placeholder="<?= $t["Description"] ?>(EN):" name="productDescription(EN)">

                <input type="text" placeholder="<?= $t["Description"] ?>(FR):" name="productDescription(FR)">

                <input type="money" placeholder="<?= $t["Price"] ?>:" name="productPrice">

                <input type="text" placeholder="<?= $t["Gender usage"] ?>(EN):" name="productGender(EN)">

                <input type="text" placeholder="<?= $t["Gender usage"] ?>(FR):" name="productGender(FR)">

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
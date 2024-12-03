<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bank of icon  https://boxicons.com/  -->
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="stylesheet" href="../style.css? <?= time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php
    include_once("../phpLibrary/MyLibrary.php");
    NavigationBarE("Product");
    ?>

    <div class="product-heading-img">
        <div>
            <div>
                <img src="../img/backgro.png" alt="" class="background_img">
            </div>
            <div class="h2-1">
                <?php
                //var_dump($arrayOfStrings); 
                ?>
                <h2><?= $arrayOfStrings["firstPromotiontext"] ?></h2>
            </div>
        </div>
        <div>
            <img src="../img/backgro2.png" alt="" class="background_img2">
        </div>
        <div class="h2-2">
            <h2> <?= $arrayOfStrings["secondPromotiontext"] ?></h2>
        </div>
    </div>

    <!-- Add new products btn !-->
    <?php
    if ($_SESSION["userIsAdmin"] != false) {
    ?>
        <a href="AddingNewProduct.php"><button class="button-24" role="button">Add new product</button></a>
    <?php
    } else {
    ?>
        <h2> <?= $arrayOfStrings["Our products"] ?></h2>
    <?php
    };
    ?>


    <div class="image-container">
        <?php
        $ProductsDataBase = fopen("../DataBases/Products.csv", "r");
        $line = fgets($ProductsDataBase);
        $product_ID_number = 0;
        while (!feof($ProductsDataBase)) {
            $line = fgets($ProductsDataBase);
            $splitsOfEachLine = explode(",", $line);
            if (count($splitsOfEachLine) >= 8) {
        ?>
                <div class="product-box">
                <form method="POST">
                    <!-- ID,Name,DescriptionEN,Price,GenderEN,img,DescriptionFR,GenderFR -->
                    <img src="<?= $splitsOfEachLine[5] ?>" class="product-img">
                    <h2 class="product-title"><?= $splitsOfEachLine[1] ?></h2>
                    <span class="price"><?= $splitsOfEachLine[3] ?>€</span>
                    <p><?php if ($_SESSION["language"] == "EN") {
                            print($splitsOfEachLine[4]);
                        } else if ($_SESSION["language"] == "FR") {
                            print($splitsOfEachLine[7]);
                        } ?></p>
                    <i class='bx bx-shopping-bag add-cart' id="cart-icon"></i>
                   
                        <input type="submit" value="<?= $splitsOfEachLine["BuyNow"] ?>" name="submit">
                    </form>
                </div>


        <?php

            }
            $product_ID_number++;
        }
        $_SESSION["product_ID_number"] = $product_ID_number;
        ?>
    </div>
    <!-- the following function will create a end bar in the end of the content of a webpage -->
    <?php
    EndBar()
    ?>

</body>

</html>
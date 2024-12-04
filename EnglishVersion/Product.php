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
    </div>


    <div class="product-banner">
        <!-- Add new products btn !-->
        <?php
        if ($_SESSION["userIsAdmin"]) {
        ?>
            <div>
                <a href="AddingNewProduct.php"><button class="button-24" role="button">Add new product</button></a>
            </div>
        <?php
        } else {
        ?>
            <div>
                <h2> <?= $arrayOfStrings["Our products"] ?></h2>
            </div>
            <!-- if any customer user is logged the cart icon will be appeared -->
            <?php
            if ($_SESSION[("user")]) {
            ?>
                <div>
                    <box-icon name='cart-add'></box-icon>
                    <?= count($_SESSION["cart"]) ?>
                </div>
            <?php
            }
            ?>
        <?php
        }; ?>
    </div>



    <div class="image-container">
        <?php
        $ProductsDataBase = fopen("../DataBases/Products.csv", "r");
        $line = fgets($ProductsDataBase);

        while (!feof($ProductsDataBase)) {
            $line = fgets($ProductsDataBase);
            $splitsOfEachLine = explode(",", $line);
            if (count($splitsOfEachLine) >= 8) {
        ?>
                <div class="product-box">
                    <!-- ID,Name,DescriptionEN,Price,GenderEN,img,DescriptionFR,GenderFR -->
                    <img src="<?= $splitsOfEachLine[5] ?>" class="product-img">
                    <h2 class="product-title"><?= $splitsOfEachLine[1] ?></h2>
                    <span class="price"><?= $splitsOfEachLine[3] ?>€</span>
                    <p><?php ($_SESSION["language"] == "EN") ? $splitsOfEachLine[4] : $splitsOfEachLine[7] ?></p>
                    <i class='bx bx-shopping-bag add-cart' id="cart-icon"></i>

                    <?php
                    if ($_SESSION[("user")]) {
                    ?>
                        <form method="POST">
                            <!-- hidden input  ID -->
                            <input type="hidden" value="<?= $splitsOfEachLine[0] ?>" name="ID">

                            <!-- buy btn will be there in case a customer has logged in-->
                            <input type="submit" value="<?= $arrayOfStrings["Buy"] ?>" name="btnaddToCart">
                        </form>
                    <?php
                    }
                    ?>
                </div>
        <?php
            }
        }
        //if btn clicked the corresponding information will be keeped as array session
        if (isset($_POST["btnaddToCart"])) {
            $prodcutID = $_POST["ID"];
            addToCart($prodcutID);
        }
        function addToCart($prodcutID)
        {
            array_push($_SESSION["cart"], $prodcutID);
        }
        ?>
    </div>
    <!-- the following function will create a end bar in the end of the content of a webpage -->
    <?php
    EndBar()
    ?>

</body>

</html>
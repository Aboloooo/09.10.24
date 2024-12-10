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

<body class="ProductPageBody">
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
                <div class="container">
                    <div id="show-cart">
                        <box-icon name='cart-add'></box-icon>
                        <?= count($_SESSION["cart"]) ?>
                    </div>

                <?php
            }
                ?>
                <div id="cartTab">
                    <box-icon name='exit' id="closeIcone"></box-icon>
                    <h1>Shopping cart</h1>
                    <div class="listCart">

                        <!--For each item in the cart session the following loop will run-->
                        <?php
                        for ($i = 0; $i < count($_SESSION["cart"]); $i++) {
                            $Products = fopen("../DataBases/Products.csv", "r");
                            $arrayOfStrings = [];
                            $line = fgets($Products);
                            while (!feof($Products)) {
                                $line = fgets($Products);
                                $Product = explode(",", $line);
                                if (count($Product) == 8) {
                                    //finding index of a session array
                                    if ($_SESSION["cart"] == "EN") {
                                        // language will dedicate which element out of csv file will be chosen.
                                        $arrayOfStrings[$Language[0]] = $Language[1];
                                    } else {
                                        $arrayOfStrings[$Language[0]] = $Language[2];
                                    }
                                }
                            }
                        ?>
                            <div class="item">
                                <div class="imgage">
                                    <img src="../img/Men/1/1.1.PNG" alt="">
                                </div>
                                <div class="name">
                                    Name
                                </div>
                                <div class="totalPrice">
                                    200$
                                </div>
                            </div>

                        <?php
                        }
                        ?>

                    </div>
                    <div class="btn">
                        <button>Check out</button>
                        <button id="closeBtn">Close</button>
                    </div>

                </div>
                </div>

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
                            <input type="submit" id="btn" value="<?= $arrayOfStrings["Buy"] ?>" name="btnaddToCart">
                        </form>
                    <?php
                    }
                    ?>
                </div>
        <?php
            }
        }

        ?>
    </div>
    <!-- the following function will create a end bar in the end of the content of a webpage -->
    <?php
    EndBar()
    ?>
    <script>
        document.addEventListener("DOMContentLoaded", ready);

        function ready() {
            //Those will close the side cart
            document.getElementById("closeBtn").addEventListener("click", closeSideCart)
            document.getElementById("closeIcone").addEventListener("click", closeSideCart)

            function closeSideCart() {
                document.getElementById("cartTab").style.right = "-550px"
            }
            //this function will appear the side cart
            document.getElementById("show-cart").addEventListener("click", function() {
                document.getElementById("cartTab").style.right = "0px"
            })
        }
    </script>
</body>

</html>
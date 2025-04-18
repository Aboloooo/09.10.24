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
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body class="ProductPageBody">
    <?php
    NavigationBarE("Product");
    ?>

    <div class="product-banner">
        <!-- Add new products btn -->
        <?php
        if ($_SESSION[("user")]) {
            if (!$_SESSION["userIsAdmin"] == false) {
        ?>
                <div class="AdminPanelProduct">
                    <a href="AddingNewProduct.php"><button class="button-24" role="button"><?= $t["Add new product"] ?></button></a>
                    <a href="CheckedOut.php"><button class="button-24" role="button"><?= $t["Checked out items"] ?></button></a>
                </div>
            <?php
            } else {
            ?>
                <div>
                    <h2> <?= $t["Our products"] ?></h2>
                </div>
                <!-- If any customer user is logged, the cart icon will appear -->
                <div id="show-cart">
                    <box-icon name='cart-add'></box-icon>
                    <?= count($_SESSION["cart"]) ?>

                    <!-- temperory shortcut -->
                    <a href="CheckedOut.php"><?= $t["checkout"] ?></a>
                </div>
        <?php
            }
        }
        ?>
        <!-- SQL application -->
        <div id="cartTab">
            <box-icon name='exit' id="closeIcone"></box-icon>
            <h1><?= $t["ShoppingCart"] ?></h1>
            <div class="listCart">
                <?php
                /* For each item in the cart session the following loop will run */
                $TotalPrice = 0;
                for ($i = 0; $i < count($_SESSION["cart"]); $i++) {
                    if ($connection->connect_error) {
                        die("Connection failed: " . $connection->connect_error);
                    } else {
                        /* I need to check if table products exist first*/

                        $sqlProduct = $connection->prepare('select * from products where productsID=?;');
                        $sqlProduct->bind_param('i', $_SESSION["cart"][$i]);
                        $sqlProduct->execute();
                        $result = $sqlProduct->get_result();

                        while ($row = $result->fetch_assoc()) {
                            if ($row["productsID"] == $_SESSION["cart"][$i]) {
                                $TotalPrice += $row["Price"];
                ?>
                                <div class="item">
                                    <div class="imgage">
                                        <img src="<?= $row['img'] ?>" alt="">
                                    </div>
                                    <div class="name">
                                        <?= $row['productName'] ?>
                                    </div>
                                    <div class="totalPrice">
                                        <?= $row["Price"] ?>€
                                    </div>
                                    <div class="trash">
                                        <box-icon name='trash-alt' type='solid'></box-icon>
                                    </div>
                                </div>
                <?php
                            }
                        }
                    }
                }
                ?>
                <h4>Total: <?= $TotalPrice ?>€ </h4>
            </div>


            <!-- function for check out btn to send all the items in the session array into a CSV file with all the details plus date and time-->
            <form method="POST" class="btn">
                <input type="submit" value="<?= $t["checkout"] ?>" name="check_out">
                <input type="submit" value="<?= $t["Clear all"] ?>" name="ClearAll" id="closeBtn">
            </form>
        </div>
    </div>


    <div class="image-container">
        <?php
        $sqlGetProducts = $connection->prepare("SELECT * FROM products");
        $sqlGetProducts->execute();
        $result = $sqlGetProducts->get_result();
        while ($row = $result->fetch_assoc()) {
            if ($row['productsID']) {
        ?>
                <div class="product-box">
                    <!-- ID,productName,Price,GenderEN,img,GenderFR -->
                    <img src="<?= $row['img'] ?>" class="product-img">
                    <h2 class="product-title"><?= $row['productName'] ?></h2>
                    <span class="price"><?= $row['Price'] ?>€</span>
                    <p><?php ($_SESSION["language"] == "EN") ? $row['GenderEN'] : $row['GenderFR']  ?></p>
                    <i class='bx bx-shopping-bag add-cart' id="cart-icon"></i>

                    <?php

                    if (!$_SESSION[("userIsAdmin")] && $_SESSION[("user")] == true) {
                    ?>
                        <form method="POST">
                            <!-- hidden input  ID -->
                            <input type="hidden" value="<?= $row['productsID'] ?>" name="ID">

                            <!-- buy btn will be there in case a customer has logged in-->
                            <input type="submit" id="btn" value="<?= $t["Buy"] ?>" name="addingToCart">
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
    EndBar();
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
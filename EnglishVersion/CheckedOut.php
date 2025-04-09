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
    <div class="checkedOut">
        <h1><?= $arrayOfStrings["Checked out inventories"] ?></h1>
        <form>
            <label for=""><?= $arrayOfStrings["Find"] ?>: </label>
            <input type="text" width="100px">
            <input type="submit" value="<?= $arrayOfStrings["Go"] ?>">
        </form>
        <?php
        $sqlOrderInfor = $connection->prepare('SELECT * FROM orders');
        $sqlOrderContent = $connection->prepare('SELECT productsID FROM orderContent WHERE orderID = ?');

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        } else {
            $sqlOrderInfor->execute();
            $result = $sqlOrderInfor->get_result();

            while ($row = $result->fetch_assoc()) {
                $orderID = $row['orderID'];
                $userID = $row['userID'];
                $actionDate = $row['actionDate'];
                $actionTime = $row['actionTime'];

                // Get products for this order
                $sqlOrderContent->bind_param('i', $orderID);
                $sqlOrderContent->execute();
                $productIDsforEachOrder = $sqlOrderContent->get_result();
        ?>
                <div>
                    <h3>An order placed on <?= $actionDate ?> at <?= $actionTime ?></h3>
                </div>
                <!-- Create table for each order row -->
                <div class="tableOfOrder">
                    <h2>Order ID <?= $orderID ?></h2>
                    <div class="imgProducts">
                        <?php
                        while ($productIDs = $productIDsforEachOrder->fetch_assoc()) {
                            $productID = $productIDs['productsID'];

                            // Get product info
                            $product = $connection->prepare('SELECT * FROM products WHERE productsID = ?');
                            $product->bind_param('i', $productID);
                            $product->execute();
                            $productInfo = $product->get_result();
                            $productInformation = $productInfo->fetch_assoc();

                            if ($productInformation) {
                                $productName = $productInformation['productName'];
                                $productPrice = $productInformation['Price'];
                                $productImg = $productInformation['img'];
                        ?>
                                <table class="tableOfOrders">
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Price</th>
                                    </tr>
                                    <tr>
                                        <td><img src="<?= $productImg ?>" width="100px" height="110px"></td>
                                        <td><?= $productName ?></td>
                                        <td><?= $productPrice ?></td>
                                    </tr>
                                </table>
                    </div>
            <?php
                            }
                        }
            ?>
                </div>

    </div>
<?php
            }
        }
?>




</div>
</body>

</html>
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
        <h1><?= $t["Checked out inventories"] ?></h1>
        <form>
            <label for=""><?= $t["Find"] ?>: </label>
            <input type="text" width="100px">
            <input type="submit" value="<?= $t["Go"] ?>">
        </form>
        <?php
        global $t;
        $sqlOrderContent = $connection->prepare('SELECT productsID FROM orderContent WHERE orderID = ?');
        $sqlUserLevelCheck = $connection->prepare('SELECT * FROM users where username = ?');

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        } else {
            $sqlUserLevelCheck->bind_param('s', $_SESSION['UserName']);
            $sqlUserLevelCheck->execute();
            $userLevel = $sqlUserLevelCheck->get_result();
            while ($row = $userLevel->fetch_assoc())
                if ($row['level'] == 'admin') {
                    $sqlOrderInfor = $connection->prepare('SELECT * FROM orders');
                } else {
                    $sqlOrderInfor = $connection->prepare('SELECT * FROM orders WHERE userID = ?');
                    $sqlOrderInfor->bind_param('i', $row['userID']);
                }

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
                <!-- Create table for each order row -->
                <div class="tableOfOrder">
                    <h2><?= $t["OrderID"] ?> <?= $orderID ?></h2>
                    <h3><?= $t['An order has been placed on'] ?> <?= $actionDate ?> <?= $t['at'] ?> <?= $actionTime ?></h3>
                    <div class="imgProducts">
                        <table class="tableOfOrders">
                            <tr>
                                <th></th>
                                <th><?= $t['Name'] ?></th>
                                <th><?= $t['Price'] ?></th>
                            </tr>
                            <?php
                            $total = 0;
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
                                    $total += $productPrice;
                            ?>
                                    <tr>
                                        <td><img src="<?= $productImg ?>" width="100px" height="110px"></td>
                                        <td><?= $productName ?></td>
                                        <td><?= $productPrice ?></td>
                                    </tr>
                    </div>
            <?php
                                }
                            }
            ?>
            <tr>
                <td>Total:</td>
                <td></td>
                <td><?= $total ?></td>
            </tr>
            </table>
                </div>

    </div>
<?php
            }
        }
?>




</div>
</body>

</html>
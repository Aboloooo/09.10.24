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
        $findUserName = $connection->prepare('SELECT username FROM users where userID = ?');
        $showUsernameToAdmin = false;

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        } else {
            $sqlUserLevelCheck->bind_param('s', $_SESSION['UserName']);
            $sqlUserLevelCheck->execute();
            $userLevel = $sqlUserLevelCheck->get_result();
            while ($row = $userLevel->fetch_assoc())
                if (strtoupper($row['level']) == 'ADMIN') {
                    $sqlOrderInfor = $connection->prepare('SELECT * FROM orders');
                    $showUsernameToAdmin = true;
                } else {
                    $sqlOrderInfor = $connection->prepare('SELECT * FROM orders WHERE userID = ?');
                    $sqlOrderInfor->bind_param('i', $row['userID']);
                }

            $sqlOrderInfor->execute();
            $result = $sqlOrderInfor->get_result();



            while ($row = $result->fetch_assoc()) {
                $orderID = $row['orderID'];

                $userID = $row['userID'];
                $findUserName->bind_param('i', $userID);
                $findUserName->execute();
                $username = $findUserName->get_result();
                $userName = $username->fetch_assoc();

                $actionDate = $row['actionDate'];
                $actionTime = $row['actionTime'];
                $status = $row['status'];



                // Get products for this order
                $sqlOrderContent->bind_param('i', $orderID);
                $sqlOrderContent->execute();
                $productIDsforEachOrder = $sqlOrderContent->get_result();
        ?>
                <!-- Create table for each order row -->
                <div class="tableOfOrder">
                    <?php
                    if ($showUsernameToAdmin) {
                    ?>
                        <h2><?= $t["OrderID"] ?> <?= $orderID ?> <br> <?= $t["made by"] ?> <?= $userName['username'] ?></h2>
                    <?php
                    } else {
                    ?>
                        <h2><?= $t["OrderID"] ?> <?= $orderID ?></h2>
                    <?php
                    }
                    ?>

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
                            /* changing status of orders */
                            $changeStatusOfOrder = $connection->prepare('UPDATE orders set status = ? where orderID =?');
                            $newStatus = ($status == 'Pending') ? 'Delivered' : 'Pending';
                            if (isset($_POST['changeStatus'])) {
                                $orderID = $_POST['orderDisplayID'];
                                $fetchStatus = $connection->prepare('select status from orders where orderID = ?');
                                $fetchStatus->bind_param('i', $orderID);
                                $fetchStatus->execute();
                                $resultStatus = $fetchStatus->get_result();
                                $orderStatusRow = $resultStatus->fetch_assoc();
                                $orderStatus = $orderStatusRow['status'];
                                $newStatus = ($orderStatus == 'Pending') ? 'Delivered' : 'Pending';

                                $changeStatusOfOrder = $connection->prepare('UPDATE orders SET status = ? WHERE orderID = ?');
                                $changeStatusOfOrder->bind_param('si', $newStatus, $orderID);
                                $changeStatusOfOrder->execute();
                                header("Location: " . $_SERVER['PHP_SELF']);
                            }


            ?>
            <tr style="background-color: <?= $status == 'Pending' ? 'red' : 'lightgreen' ?>;">
                <td><?= $t['Change status'] ?>:</td>
                <td><?= $t[$status] ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="orderDisplayID" value="<?= $row['orderID'] ?>">
                        <button type="submit" name="changeStatus">Change Status</button>
                    </form>
                </td>
            </tr>
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
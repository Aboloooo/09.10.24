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
        $sqlOrderInfor = $connection->prepare('select * from orders natural join orderContent where userID=(select userID from users where username=?;)');
        $sqlOrderInfor->bind_param('s', $_SESSION['UserName']);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        } else {
            $sqlOrderInfor->execute();
            $result = $sqlOrderInfor->get_result();
            while ($row = $result->fetch_assoc()) {
                $userID = $row['userID'];
                $actionDate = $row['actionDate'];
                $actionTime = $row['actionTime'];
                $orderContentID = $row['OrderContentID'];
                $productsID = $row['productsID'];
                /* until here everything must be fine */
                foreach ($orderID as $order) {
                    $sqlProductInfo = $connection->prepare('select * from products natural join orderContent where productsID = ?');
                    $sqlProductInfo->bind_param('i', $row['productsID'])
        ?>
                    <div class="orderRecord">
                        <div>   <!-- product img -->
                            <img src="" alt="">
                        </div>
                        <table class="inventoryList">
                            <h3><?= $arrayOfStrings["An order has been placed."] ?><?= $arrayOfStrings[" On "] . $actionDate ?><?= $arrayOfStrings["at "]. $actionTime ?> </h3>
                            <tr class="itemsRowHead">
                                <th><?= $arrayOfStrings["Product name"] ?></th>
                                <th><?= $arrayOfStrings["Product price"] ?></th>
                            </tr>

                        </table>
                    </div>
                <?php
                }
            }
        }
        ?>



    </div>
</body>

</html>
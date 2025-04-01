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
        $sqlOrderInfor = $connection->prepare('select * from orders natural join orderContent where userID=(select userID from users where username=?)');
        $sqlOrderInfor->bind_param("s", $_SESSION['UserName']);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        } else {
            $sqlOrderInfor->execute();
            $result = $sqlOrderInfor->get_result();
            $orders = [];
            while ($row = $result->fetch_assoc()) {
                $orders[] = [
                    'orderID' => $row['orderID'],
                    'userID' => $row['userID'],
                    'actionDate' => $row['actionDate'],
                    'actionTime' => $row['actionTime'],
                    'productID' => $row['productsID']
                ];
                /* until here everything must be fine */
                foreach ($orders as $order) {
        ?>
                    <!-- create table for each order -->
                    <div>
                        <div>
                            <?php
                            $sqlRetrivingProductImg = $connection->prepare('select img from products where productID = ?');
                            $sqlRetrivingProductImg->bind_param('i', $orders['productID']);
                            $sqlRetrivingProductImg->execute();
                            ?>
                            <img src="" alt="">
                        </div>
                        <div></div>
                    </div>

        <?php
                }
            }
        }
        ?>



    </div>
</body>

</html>
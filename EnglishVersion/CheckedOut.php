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
        $sqlOrderInfor = $connection->prepare('select * from orders');
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        } else {
            $sqlOrderInfor->execute();
            $result = $sqlOrderInfor->get_result();
            while ($row = $result->fetch_assoc()) {
                $orderID = $row['orderID'];
        ?>
                <!-- create table for each order row -->
                
                <div class="tableOfOrder">
                <h2>order ID <?= $orderID ?></h2>
                    <div class="imgProducts">
                        <img src="../img/Men/1/1.1.PNG" alt="">
                        <div></div>
                    </div>
                    <div>
                        <h3>time</h3>
                        <h3>date</h3>
                    </div>
                </div>


        <?php

            }
        }
        ?>



    </div>
</body>

</html>
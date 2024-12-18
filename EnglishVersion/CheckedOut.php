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
        <h1>Checked out inventories</h1>
        <form>
            <label for="">Find: </label>
            <input type="text" width="100px">
            <input type="submit" value="Go">
        </form>

        <?php
        $finlizedOrders = fopen("../DataBases/FinlizedOrders.csv", "r");
        $line = fgets($finlizedOrders);
        while (!feof($finlizedOrders)) {
                $line = fgets($finlizedOrders);
             list($productID, $Date, $Time, $Username) = explode(" => ", trim($line));
        ?>
            <div class="orderRecord">
                <table class="inventoryList">
                    <h3>Ordered by:<?= $Username ?> </h3>
                    <tr>
                        <th>Product ID</th>
                        <th>Date</th>
                        <th>Time</th>
                    </tr>
                    <tr>
                        <th><?= $productID ?></th>
                        <th><?= $Date ?></th>
                        <th><?= $Time ?></th>
                    </tr>
                </table>
            </div>
        <?php
        }
        ?>
    </div>
</body>

</html>
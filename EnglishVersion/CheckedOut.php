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
        <h1>right time, date, seperation of orders</h1>
        <form>
            <label for=""><?= $arrayOfStrings["Find"] ?>: </label>
            <input type="text" width="100px">
            <input type="submit" value="<?= $arrayOfStrings["Go"] ?>">
        </form>
        <?php
        // Reading orders file
        $FinalizedItemsCSV = fopen("../DataBases/FinlizedOrders.csv", "r");
        $emptyFirstOrderLine = fgets($FinalizedItemsCSV);
        $orders = [];
        while (!feof($FinalizedItemsCSV)) {
            $line = fgets($FinalizedItemsCSV);
            $entireLine = explode(" => ", $line);
            $orderBy = $entireLine[0];
            $Date = $entireLine[1];
            $Time = $entireLine[2];
            $ordredProductIDs = explode(",", $entireLine[3]);
            $orders[] = [
                "user" => $orderBy,
                "Date" => $Date,
                "Time" => $Time,
                "ordredProductIDs" => $ordredProductIDs,
            ];
        }

        // Reading products file
        $productMap = [];
        $ProductsCSV = fopen("../DataBases/Products.csv", "r");
        $emptyFirstProductLine = fgets($ProductsCSV);
        while (!feof($ProductsCSV)) {
            $line = fgets($ProductsCSV);
            $ProductsCSVitems = explode(",", $line);
            $productID = $ProductsCSVitems[0];
            $productName = $ProductsCSVitems[1];
            $productPrice = $ProductsCSVitems[3];
            $productMap[$productID] = [
                "productName" => $productName,
                "productPrice" => $productPrice,
            ];
        }

        $currentUser = $_SESSION["UserName"];
        foreach ($orders as $order) {
            if ($currentUser == $order["user"]) {
        ?>
                <div class="orderRecord">
                    <table class="inventoryList">
                        <h3>An order has been placed by <?= $order["user"] ?> on <?= $order["Date"] ?> at <?= $order["Time"] ?></h3>
                        <tr class="itemsRowHead">
                            <th>Product Name</th>
                            <th>Product Price</th>
                        </tr>
                        <?php
                        foreach ($orders["ordredProductIDs"] as $ordredproductID) {
                            if (isset($productMap[$ordredproductID])) {
                        ?>
                                <tr class="itemsRowHead">
                                    <th><?= $productMap[$ordredproductID]["productName"] ?></th>
                                    <th><?= $productMap[$ordredproductID]["productPrice"] ?></th>
                                </tr>
                        <?php
                            }
                        }
                    } else {
                        ?>
                        <div class="orderRecord">
                            <table class="inventoryList">
                                <h3>An order has been placed by <?= $order["user"] ?> on <?= $order["Date"] ?> at <?= $order["Time"] ?></h3>
                                <tr class="itemsRowHead">
                                    <th>Product Name</th>
                                    <th>Product Price</th>
                                </tr>
                                <?php
                                foreach ($orders["ordredProductIDs"] as $ordredproductID) {
                                    if (isset($productMap[$ordredproductID])) {
                                ?>
                                        <tr class="itemsRowHead">
                                            <th><?= $productMap[$ordredproductID]["productName"] ?></th>
                                            <th><?= $productMap[$ordredproductID]["productPrice"] ?></th>
                                        </tr>
                        <?php
                                    }
                                }
                            }
                        }
                        // $total = 0;
                        ?>
                            </table>
                        </div>
                </div>
</body>

</html>
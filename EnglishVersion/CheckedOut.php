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
        // Reading orders file
        $FinalizedItemsCSV = fopen("../DataBases/FinlizedOrders.csv", "r");
        $fileExist = file_exists("../DataBases/FinlizedOrders.csv");
        $emptyFirstOrderLine = fgets($FinalizedItemsCSV);
        $orders = [];
        if ($fileExist) {
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
        } else {
            print("No order record found!");
        }


        //var_dump($orders); 

        // Reading products file
        $productMap = [];
        $ProductsCSV = fopen("../DataBases/Products.csv", "r");
        $ProductsCSVExist = file_exists("../DataBases/Products.csv");
        $emptyFirstProductLine = fgets($ProductsCSV);
        if ($ProductsCSVExist) {
            while (!feof($ProductsCSV)) {
                $line = fgets($ProductsCSV);
                $ProductsCSVitems = explode(",", $line);
                if (count($ProductsCSVitems) == 8) {
                    $productID = $ProductsCSVitems[0];
                    $productName = $ProductsCSVitems[1];
                    $productPrice = $ProductsCSVitems[3];
                    $productMap[$productID] = [
                        "productName" => $productName,
                        "productPrice" => $productPrice,
                    ];
                }
            }
        } else {
            print("Something went wrong!");
        }

        $currentUser = $_SESSION["UserName"];
        foreach ($orders as $order) {
            $total = 0;
            if ($order["user"] == $currentUser || $_SESSION["userIsAdmin"]) {
        ?>
                <div class="orderRecord">
                    <table class="inventoryList">
                        <h3><?= $arrayOfStrings["An order has been placed by"] ?> <?= $order["user"] ?> <?= $arrayOfStrings["on"] ?> <?= $order["Date"] ?> <?= $arrayOfStrings["at"] ?> <?= $order["Time"] ?></h3>
                        <tr class="itemsRowHead">
                            <th><?= $arrayOfStrings["Product name"] ?></th>
                            <th><?= $arrayOfStrings["Product price"] ?></th>
                        </tr>
                        <?php
                        foreach ($order["ordredProductIDs"] as $ordredproductID) {
                            if (isset($productMap[$ordredproductID])) {
                                $total += floatval($productMap[$ordredproductID]["productPrice"]);
                        ?>
                                <tr class="orderitems">
                                    <th><?= $productMap[$ordredproductID]["productName"] ?></th>
                                    <th><?= $productMap[$ordredproductID]["productPrice"] ?>€</th>
                                </tr>
                    <?php
                            }
                        }
                         ?>
                    <tr class="test">
                        <th></th>
                        <th>Total: <?= $total ?>€</th>
                    </tr>
                <?php
                    }  
            }
                ?>
                    </table>
                </div>
    </div>
</body>

</html>
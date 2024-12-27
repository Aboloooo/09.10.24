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
        <h1><?= ($_SESSION["userIsAdmin"]) ? $arrayOfStrings["Checked out inventories"] : $arrayOfStrings["Previous orders"]; ?></h1>
        <h1>the only thing missed is seperation of each order!</h1>
        <form>
            <label for=""><?= $arrayOfStrings["Find"] ?>: </label>
            <input type="text" width="100px">
            <input type="submit" value="<?= $arrayOfStrings["Go"] ?>">
        </form>
        <div class="orderRecord">
            <table class="inventoryList">
                <tr class="itemsRowHead">
                    <th>Product ID</th>
                    <th><?= (!$_SESSION["userIsAdmin"]) ? "Product name" : "Buyer"; ?></th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
                <?php
                $FinalizedItemsCSV = fopen("../DataBases/FinlizedOrders.csv", "r");
                $ProductsCSV = fopen("../DataBases/Products.csv", "r");
                $line = fgets($FinalizedItemsCSV);
                $total = 0;

                while (!feof($FinalizedItemsCSV)) {
                    $line = fgets($FinalizedItemsCSV);
                    $recordLine = explode(",", $line);
                    $entireLine = explode(" => ", $line);
                    $orderBy = $entireLine[0];
                    $Date = $entireLine[1];
                    $Time = $entireLine[2];
                    matchItems($recordLine, $ProductsCSV, $total, $Date, $Time, $orderBy);
                }
                function matchItems($recordLine, $ProductsCSV, $total, $Date, $Time, $orderBy)
                {
                    rewind($ProductsCSV);
                    while (!feof($ProductsCSV)) {
                        $line = fgets($ProductsCSV);
                        $ProductsCSVitems = explode(",", $line);
                        foreach ($recordLine as $itemID) {
                            if ($ProductsCSVitems[0] == $itemID) {
                                $ID = $ProductsCSVitems[0];
                                $ProductName = $ProductsCSVitems[1];
                                $Price = $ProductsCSVitems[3];
                                $total += $ProductsCSVitems[3];
                                displayItems($ID, $ProductName, $Price, $Date, $Time, $orderBy);
                            }
                        }
                    }
                }

                function displayItems($ID, $ProductName, $Price, $Date, $Time, $orderBy)
                {
                    if ($orderBy == $_SESSION["UserName"]) {
                ?>

                        <tr>
                            <th><?= $ID ?></th>
                            <th><?= ($_SESSION["userIsAdmin"]) ? $orderBy :  $ProductName; ?></th>
                            <th><?= $Price ?></th>
                        </tr>


                <?php
                    }
                }
                ?>
                <tr>
                    <th>Total:</th>
                    <th></th>
                    <th></th>
                    <th>total</th>
                </tr>
                <tr>
                    An order has been made on <?= $Date . " at " . $Time ?>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
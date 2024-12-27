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

        <div class="orderRecord">
            <table class="inventoryList">
                <?php
                $FilePath = "../DataBases/FinlizedOrders.csv";
                // // checking if file exist
                function displayOrders($FilePath)
                {
                    if (!file_exists($FilePath)) {
                        print("No record found!");
                        return;
                    } else {
                        $finlizedOrders = fopen($FilePath, "r");
                        return $finlizedOrders;
                    }
                }
                $finlizedOrders = displayOrders($FilePath);
                $currentUser = $_SESSION["UserName"];
                if ($currentUser == "admin") {
                ?>
                    <tr>
                        <th class="itemsRowHead"><?= $arrayOfStrings["Username"] ?></th>
                        <th class="itemsRowHead"><?= $arrayOfStrings["Product ID"] ?></th>
                        <th class="itemsRowHead"><?= $arrayOfStrings["Date"] ?></th>
                        <th class="itemsRowHead"><?= $arrayOfStrings["Time"] ?></th>
                    </tr>
                    <?php
                    $Total;
                    $line = fgets($finlizedOrders);
                    while (!feof($finlizedOrders)) {
                        $line = fgets($finlizedOrders);
                        // $productID, $Date, $Time, $Username
                        $RecordOfItems = explode(" => ", trim($line));
                        $UserName = $RecordOfItems[4];
                        $Total = $Total + $RecordOfItems[2];
                    ?>
                        <tr class="itemsRow">
                            <th><?= $RecordOfItems[5] ?></th>
                            <th><?= $RecordOfItems[0] ?></th>
                            <th><?= $RecordOfItems[3] ?></th>
                            <th><?= $RecordOfItems[4] ?></th>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <th>Total: </th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><?= $Total ?>€</th>
                    </tr>
                <?php
                } else {
                ?>
                    <tr>
                        <th class="itemsRowHead"><?= $arrayOfStrings["Product ID"] ?></th>
                        <th class="itemsRowHead"><?= $arrayOfStrings["Name"] ?></th>
                        <th class="itemsRowHead"><?= $arrayOfStrings["Price"] ?></th>
                        <th class="itemsRowHead"><?= $arrayOfStrings["Date"] ?></th>
                        <th class="itemsRowHead"><?= $arrayOfStrings["Time"] ?></th>
                    </tr>
                    <?php
                    $Total;
                    $line = fgets($finlizedOrders);
                    while (!feof($finlizedOrders)) {
                        $line = fgets($finlizedOrders);
                        // $productID, $Name ,$Price, $Date, $Time, $Username
                        $RecordOfItems = explode(" => ", trim($line));
                        $UserName = $RecordOfItems[5];
                        if ($currentUser == $UserName) {
                            $Total = $Total + $RecordOfItems[2];
                    ?>
                            <tr class="itemsRow">
                                <th><?= $RecordOfItems[0] ?></th>
                                <th><?= $RecordOfItems[1] ?></th>
                                <th><?= $RecordOfItems[2] ?>€</th>
                                <th><?= $RecordOfItems[3] ?></th>
                                <th><?= $RecordOfItems[4] ?></th>
                            </tr>
                <?php
                        }
                    }
                }
                ?>
                <tr>
                    <th>Total: </th>
                    <th></th>
                    <th><?= $Total ?>€</th>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
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

                $currentUsername = $_SESSION["UserName"];
                $line = fgets($finlizedOrders);
                while (!feof($finlizedOrders)) {
                    $line = fgets($finlizedOrders);
                    // $productID, $Date, $Time, $Username
                    $RecordOfItems = explode(" => ", trim($line));
                    // list($productID, $Date, $Time, $Username) = explode(" => ", trim($line));
                    if ($currentUsername == "admin") {
                ?>
                        <tr>
                            <th class="itemsRowHead"><?= $arrayOfStrings["Username"] ?></th>
                            <th class="itemsRowHead"><?= $arrayOfStrings["Product ID"] ?></th>
                            <th class="itemsRowHead"><?= $arrayOfStrings["Date"] ?></th>
                            <th class="itemsRowHead"><?= $arrayOfStrings["Time"] ?></th>
                        </tr>
                        <tr class="itemsRow">
                            <th><?= $RecordOfItems[4] ?></th>
                            <th><?= $RecordOfItems[0] ?></th>
                            <th><?= $RecordOfItems[2] ?></th>
                            <th><?= $RecordOfItems[3] ?></th>
                        </tr>
                    <?php
                    } else if ($currentUsername == $RecordOfItems[4]) {
                    ?>
                        <tr>
                            <th class="itemsRowHead"><?= $arrayOfStrings["Product ID"] ?></th>
                            <th class="itemsRowHead"><?= $arrayOfStrings["Name"] ?></th>
                            <th class="itemsRowHead"><?= $arrayOfStrings["Date"] ?></th>
                            <th class="itemsRowHead"><?= $arrayOfStrings["Time"] ?></th>
                        </tr>
                        <tr class="itemsRow">
                            <th><?= $RecordOfItems[0] ?></th>
                            <th><?= $RecordOfItems[1] ?></th>
                            <th><?= $RecordOfItems[2] ?></th>
                            <th><?= $RecordOfItems[3] ?></th>
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
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

        <div class="orderRecord">
            <table class="inventoryList">
                <tr>
                    <th class="itemsRowHead">Username</th>
                    <th class="itemsRowHead">Product ID</th>
                    <th class="itemsRowHead">Date</th>
                    <th class="itemsRowHead">Time</th>
                </tr>
                <?php
                $finlizedOrders = fopen("../DataBases/FinlizedOrders.csv", "r");
                // checking if file exist
                function displayOrders($finlizedOrders)
                {
                    if (!file_exists($finlizedOrders)) {
                        print("No record found!");
                        return;
                    }
                }
                $currentUsername = $_SESSION["UserName"];
                $line = fgets($finlizedOrders);
                while (!feof($finlizedOrders)) {
                    $line = fgets($finlizedOrders);
                    // $productID, $Date, $Time, $Username
                    $RecordOfItems = explode(" => ", trim($line));
                    // list($productID, $Date, $Time, $Username) = explode(" => ", trim($line));
                    if ($currentUsername == $RecordOfItems[3] || $currentUsername == "admin") {
                ?>
                        <tr class="itemsRow">
                            <th><?= $RecordOfItems[3] ?></th>
                            <th><?= $RecordOfItems[0] ?></th>
                            <th><?= $RecordOfItems[1] ?></th>
                            <th><?= $RecordOfItems[2] ?></th>
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
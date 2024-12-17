<?php
include_once("../phpLibrary/MyLibrary.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css? <?= time(); ?>">
</head>

<body>
    <?php
    NavigationBarE("Product");
    ?>

    <div class="parentDiv">
        <div class="child2 chilTwoAndOne">
            <h1>pic</h1>
            <div class="mainImg">
                main img
                <img src="../img/Men/1/1.1.PNG" alt="">
            </div>
            <div class="optinalImg">

            </div>
        </div>
        <div class="child1">
            <h1>discription</h1>
        </div>
    </div>

</body>

</html>
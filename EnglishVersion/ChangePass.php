<?php
include_once("../phpLibrary/MyLibrary.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
    <!-- bank of icon  https://boxicons.com/  -->
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <style>
        body {
            background-image: url("../img/3.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    <?php
    NavigationBarE("");
    ?>

    <div class="form-location">
        <div class="container-form">
            <h2><?= $t["ChangePassword"] ?></h2>
            <form action="" method="post">
                <input type="password" placeholder="<?= $t["pass"] ?>" name="oldPass">
                <input type="password" placeholder="<?= $t["NewPass"] ?>" name="newPass">
                <input type="password" placeholder="<?= $t["Confirmation"] ?>" name="newPassConfir">

                <input type="submit" value="<?= $t["submit"] ?>" name="submit">
            </form>
        </div>
    </div>

</body>

</html>
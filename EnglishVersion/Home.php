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
    NavigationBarE("Home");
    ?>

    <!-- sign in/up btn -->
    <div class="signInOutBtn">
        <?php
        if (isset($_POST["Login"])) {
            header("Location: Login.php");
        }
        if (isset($_POST["SignUp"])) {
            header("Location: SignUp.php");
        }
        if (isset($_POST["Logout"])) {
            session_unset();
            session_destroy();
            header("Refresh:0");
        }
        if (isset($_POST["ChangePassword"])) {
            header("Location: ChangePass.php");
        }
        if ($_SESSION["user"]) {
        ?>
            <form method="post">
                <input type="submit" value="<?= $t["Logout"] ?>" name="Logout">
                <input type="submit" value="<?= $t["ChangePassword"] ?>" name="ChangePassword">
            </form>

        <?php

        } else {
        ?>
            <form method="post">
                <input type="submit" value="<?= $t["SignUp"] ?>" name="SignUp">
                <input type="submit" value="<?= $t["Login"] ?>" name="Login">
            </form>

        <?php
        }
        ?>

    </div>

</body>

</html>
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
    global $t;

    if (
        !empty($_POST["oldPass"]) &&
        !empty($_POST["newPass"]) &&
        !empty($_POST["newPassConfir"])
    ) {
        $CurrentPass = $connection->prepare('select pass from users where username =?');
        $CurrentPass->bind_param('s', $_SESSION['UserName']);
        $CurrentPass->execute();
        $result = $CurrentPass->get_result();
        $row = $result->fetch_assoc();
        $currentUserPass = $row['pass'];

        /* from now on I can compare currentUserPass with entered one and update it with new one */
    }
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
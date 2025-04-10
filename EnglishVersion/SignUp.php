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

    <div>
        <a href="Login.php"> <?= $t["Login"] ?> </a>
    </div>

    <?php
    global $t;
    $formHasEmptyFilleds = false;
    if (
        !empty($_POST["username"]) &&
        !empty($_POST["password"]) &&
        !empty($_POST["passwordConfirmation"])
    ) {
        $sqlUserCheck =  $connection->prepare('select username from users where username=?;');
        $sqlUserCheck->bind_param('s', $_POST["username"]);
        $sqlUserCheck->execute();
        $result = $sqlUserCheck->get_result();
        $row = $result->fetch_assoc();


        if ($row) {
            print($t["This username is already taken; please choose another!"]);
        } else {
            if ($_POST["password"] == $_POST["passwordConfirmation"]) {
                $sqlInsertUserCredential = $connection->prepare('insert into users (username,pass,email,phoneN,level) values (?,?,?,?,?)');
                $usernameInput = $_POST["username"];
                $userPass = $_POST["password"];
                $hashedPass = password_hash($userPass, PASSWORD_DEFAULT);
                $userEmail = $_POST["Email"];
                $userPhoneN = $_POST["PhoneN"];
                $defaultLevel = 'Customer';
                $sqlInsertUserCredential->bind_param('sssis', $usernameInput, $hashedPass, $userEmail, $userPhoneN, $defaultLevel);
                if ($sqlInsertUserCredential->execute()) {
                    print($t["Registration done successfully!; you can log in now."]);
                } else {
                    echo 'something went wrong!';
                }
            } else {
                print($t["Passwords do not match!"]);
            }
        }
    } else {
        $formHasEmptyFilleds = true;
    }
    /* if ($formHasEmptyFilleds) {
        echo 'All the filleds are required!!';
    } */
    ?>

    <div class="login-form">
        <form action="" method="POST">
            <h1><?= $t["SignUp"] ?></h1>
            <label for="Email">Username</label>
            <input type="text" placeholder="Username or phone number" name="username">
            <label for="password"><?= $t["Password"] ?></label>
            <input type="password" placeholder="<?= $t["Password"] ?>" name="password">
            <label for="password"><?= $t["Password confirmation"] ?></label>
            <input type="password" placeholder="<?= $t["Password confirmation"] ?>" name="passwordConfirmation">

            <label for="email">Email</label>
            <input type="Email" placeholder="<?= $t["EmaiLOrGmail"] ?>" name="Email">

            <label for="PhoneN"><?= $t["PhoneNumber"] ?></label>
            <input type="tel" placeholder="GSM" name="PhoneN">

            <input type="submit" id="submit" placeholder="submit" value="<?= $t["submit"] ?>">

        </form>
    </div>


</body>

</html>
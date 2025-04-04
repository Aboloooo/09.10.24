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
        <a href="Login.php"> <?= $arrayOfStrings["Login"] ?> </a>
    </div>

    <?php

    /*     
    if (isset($_POST["username"], $_POST["password"], $_POST["passwordConfirmation"])) {
        
        $usernameInput = $_POST["username"];

        // check if user is already exist
        $existingAccount = "../DataBases/Client_DataBase.csv";
        $usernameAlreayExist = false;
        if (file_exists($existingAccount)) {
            $OpenedFile = fopen($existingAccount, "r");

            while (($line = fgets($OpenedFile)) !== false) {
                list($username, $password) = explode(" => ", $line);
                if ($username == $usernameInput) {
                    print($arrayOfStrings["This username is already taken; please choose another!"]);
                    $usernameAlreayExist = true;
                    break;
                }
            }
        }

        if (!$usernameAlreayExist) {
            if ($_POST["password"] == $_POST["passwordConfirmation"]) {
                print($arrayOfStrings["Registration in process; please be patient!"]);
                $client_DataBase = fopen("../DataBases/Client_DataBase.csv", "a");

                //A condition to add header for the database
                if (filesize("../DataBases/Client_DataBase.csv") === 0) {
                    fwrite($client_DataBase, "userName" . " => " . "Password" . " => " . "Level");
                    fwrite($client_DataBase, "\n" . "admin" . " => " . "password" . " => " . "Admin");    //Admin created automatically
                };
                //adding crendintial to database for ex) abolo => 123 => Customer
                fwrite($client_DataBase, "\n" . $_POST["username"] . " => " . $_POST["password"] . " => " . "Customer");
            } else {
                print($arrayOfStrings["Passwords do not match!"]);
            }
        }
    } */
    global $arrayOfStrings;
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
            print($arrayOfStrings["This username is already taken; please choose another!"]);
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
                    print($arrayOfStrings["Registration done successfully!; you can log in now."]);
                } else {
                    echo 'something went wrong!';
                }
            } else {
                print($arrayOfStrings["Passwords do not match!"]);
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
            <h1><?= $arrayOfStrings["SignUp"] ?></h1>
            <label for="Email">Username</label>
            <input type="text" placeholder="Username or phone number" name="username">
            <label for="password"><?= $arrayOfStrings["Password"] ?></label>
            <input type="password" placeholder="<?= $arrayOfStrings["Password"] ?>" name="password">
            <label for="password"><?= $arrayOfStrings["Password confirmation"] ?></label>
            <input type="password" placeholder="<?= $arrayOfStrings["Password confirmation"] ?>" name="passwordConfirmation">

            <label for="email"><?= $arrayOfStrings["Email"] ?></label>
            <input type="Email" placeholder="<?= $arrayOfStrings["Email or Gmail"] ?>" name="Email">

            <label for="PhoneN"><?= $arrayOfStrings["Phone Number"] ?></label>
            <input type="tel" placeholder="<?= $arrayOfStrings["GSM"] ?>" name="PhoneN">

            <input type="submit" id="submit" placeholder="submit" value="<?= $arrayOfStrings["submit"] ?>">

        </form>
    </div>


</body>

</html>
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
    if (isset($_POST["username"], $_POST["password"], $_POST["passwordConfirmation"])) {
        global $arrayOfStrings;
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
    }
    ?>

    <div class="login-form">
        <form action="" method="POST">
            <h1><?= $arrayOfStrings["SignUp"] ?></h1>
            <label for="Email">Email</label>
            <input type="text" placeholder="<?= $arrayOfStrings["Email or Phone"] ?>" name="username">
            <label for="password"><?= $arrayOfStrings["Password"] ?></label>
            <input type="password" placeholder="<?= $arrayOfStrings["Password"] ?>" name="password">
            <label for="password"><?= $arrayOfStrings["Password confirmation"] ?></label>
            <input type="password" placeholder="<?= $arrayOfStrings["Password confirmation"] ?>" name="passwordConfirmation">

            <input type="submit" id="submit" placeholder="submit" value="<?= $arrayOfStrings["submit"] ?>">

        </form>
    </div>


</body>

</html>
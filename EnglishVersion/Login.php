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
    <link rel="stylesheet" href="../style.css?<? time(); ?>">
</head>

<body>
    <?php
    NavigationBarE("");
    ?>
    <?php
    /*     $accounts = "../DataBases/Client_DataBase.csv";*/
    $_SESSION["userIsAdmin"] = false;
    global $arrayOfStrings;

    //check if all the filleds are filled up
    if (isset($_POST["username"], $_POST["password"])) {
        $usernameInput = $_POST["username"];
        $passwordInput = $_POST["password"];
        $sucessfullLogin = false;    //Flags are really important

        //check if the database exists
        /* if (file_exists($accounts)) {
            //Read the database line by line and separate the username and pass from eachother using explode function
            $openFile = fopen($accounts, "r");
            while (($line = fgets($openFile)) !== false) {
                list($username, $password, $Level) = explode(" => ", $line);
                // check if user has an account already
                if ($username == $usernameInput && $password == $passwordInput) {
                    $sucessfullLogin = true;
                    $_SESSION["user"] = true;
                    $_SESSION["UserName"] = $usernameInput;
                    // checking if the user is admin 
                    if (trim($Level) == "Admin") {
                        $_SESSION["userIsAdmin"] = true;
                    }
                    if (isset($_POST["submit"])) {
                        header("Location: Home.php");
                        break;
                    }
                    break;
                };
            };

            if (!$sucessfullLogin) {
                //Temperory text!! apear
                print($arrayOfStrings["Login failled!"]);
            }
        } */


        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        } else {
            $sqlUserLoginChecking = $connection->prepare('select username, pass, level from users where username=?;');
            $sqlUserLoginChecking->bind_param("s", $usernameInput);
            $sqlUserLoginChecking->execute();
            $result = $sqlUserLoginChecking->get_result();

            while ($row = $result->fetch_assoc()) {
                $usernameStored = $row["username"];
                $passStored = $row["pass"];
                $levelStored = $row["level"];
                if ($usernameInput == $usernameStored) {
                    if ($passwordInput == $passStored) {
                        if ($levelStored == 'Admin') {
                            $_SESSION["userIsAdmin"] = true;
                        }
                        $sucessfullLogin = true;
                        $_SESSION["user"] = true;
                        $_SESSION["UserName"] = $usernameInput;
                        header("location: Home.php");
                    } else {
                        echo 'password is incorrect!';
                    }
                }
            }
        }
    }
    ?>

    <div>
        <a href="SignUp.php"><?= $arrayOfStrings["SignUp"] ?></a>
    </div>

    <div class="login-form">
        <form action="" method="POST">
            <h1><?= $arrayOfStrings["Login"] ?></h1>
            <label for="username"><?= $arrayOfStrings["Username"] ?></label>
            <input type="text" placeholder="<?= $arrayOfStrings["Email or Phone"] ?>" name="username">
            <label for="password"><?= $arrayOfStrings["Password"] ?></label>
            <input type="password" placeholder="<?= $arrayOfStrings["Password"] ?>" name="password">
            <div>

                <a href="#"><?= $arrayOfStrings["Forgotten password"] ?></a>
                <a href="SignUp.php"><?= $arrayOfStrings["Create an account"] ?></a>
            </div>
            <input type="submit" id="submit" value="<?= $arrayOfStrings["submit"] ?>" name="submit">

        </form>
    </div>

</body>

</html>
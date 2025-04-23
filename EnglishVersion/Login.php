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
    $_SESSION["userIsAdmin"] = false;
    global $t;

    //check if all the filleds are filled up
    if (isset($_POST["username"], $_POST["password"])) {
        $usernameInput = $_POST["username"];
        $passwordInput = $_POST["password"];
        $sucessfullLogin = false;    //Flags are really important

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
                $level = strtoupper($levelStored);
                if ($usernameInput == $usernameStored) {
                    if (password_verify($passwordInput, $passStored)) {
                        if ($level == 'ADMIN') {
                            $_SESSION["userIsAdmin"] = true;
                        }
                        $sucessfullLogin = true;
                        $_SESSION["user"] = true;
                        $_SESSION["UserName"] = $usernameInput;
                        header("location: Home.php");
                    } else {
                        echo $t['password is incorrect!'];
                    }
                } else {
                    echo $t['Please check again your username and password!'];
                }
            }
        }
    }
    ?>

    <div>
        <a href="SignUp.php"><?= $t["SignUp"] ?></a>
    </div>

    <div class="login-form">
        <form action="" method="POST">
            <h1><?= $t["Login"] ?></h1>
            <label for="username"><?= $t["Username"] ?></label>
            <input type="text" placeholder="<?= $t["Email or Phone"] ?>" name="username">
            <label for="password"><?= $t["Password"] ?></label>
            <input type="password" placeholder="<?= $t["Password"] ?>" name="password">
            <div>

                <a href="#"><?= $t["Forgotten password"] ?></a>
                <a href="SignUp.php"><?= $t["Create an account"] ?></a>
            </div>
            <input type="submit" id="submit" value="<?= $t["submit"] ?>" name="submit">

        </form>
    </div>

</body>

</html>
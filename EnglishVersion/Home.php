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

    <!-- <div class="SignInUpBtn">
        <div class="loginBtnDesign">
            <a href="Login.php" class="LoginBtn"> <?php
                                                    /*  if ($_SESSION["user"]) { */
                                                    ?>
                     here we convert the link into a btn for loging out -->
    <!--  <form action="" method="POST">
                        <input type="submit" value="<?= $arrayOfStrings["Logout"] ?>" name="Logout">
                    </form> -->
    <!--  <?php   //function of the logout btn
            /*    if (isset($_POST["Logout"])) {
                                                            session_unset();
                                                            session_destroy();
                                                            header("Refresh:0");
                                                        }
                                                    } else {
                                                        print($arrayOfStrings["Login"]);
                                                    } */
            ?> -->
    </a>
    <!--  </div>
        <div class="SignUpBtnDesign">
            <a href="SignUp.php"><?= $arrayOfStrings["SignUp"] ?></a>
        </div> -->

    </div>
    <!-- sign in/up btn -->
    <div class="signInOutBtn">


        <?php
        if ($_SESSION["user"]) {
        ?>
            <form method="post">
                <input type="submit" value="Logout" name="Logout">
            </form>

        <?php

        } else {
        ?>
            <form method="post">
                <input type="submit" value="Sign up" name="SignUp">
                <input type="submit" value="Login" name="Login">
            </form>

        <?php
        }
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
        ?>

    </div>

</body>

</html>
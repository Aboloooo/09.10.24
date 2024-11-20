<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
    <!-- bank of icon  https://boxicons.com/  -->
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</head>

<body>
    <?php
    include_once("../phpLibrary/MyLibrary.php");
    NavigationBarE("Home");
    ?>
    

    <a href="../FrenchVersion/Maison.php" id="langChanger">
        <h1>Changer de langue</h1>
    </a>

    <div>
        <a href="Login.php"> <?php
                                if ($_SESSION["user"]) {
                                ?>
                <!-- here we convert the link into a btn for loging out -->
                <form action="" method="POST">
                    <input type="submit" value="Logout" name="Logout">
                </form>
            <?php   //function of the logout btn
                                    if (isset($_POST["Logout"])) {
                                        session_unset();
                                        session_destroy();
                                        header("Refresh:0");  //this refreash doesnt function
                                    }
                                } else {
                                    print("Login");
                                }
            ?>
        </a>
    </div>

    <div>
        <a href="SignUp.php"> Sign up </a>
    </div>

</body>

</html>
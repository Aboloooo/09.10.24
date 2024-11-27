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
    include_once("../phpLibrary/MyLibrary.php");
    NavigationBarE("Contact");
    ?>

    <?php
    if (isset($_GET["submit"])) {
        submitForm();
    }

    function submitForm()
    {
        global $arrayOfStrings;
        // if (isset($_GET["UserName"])) {
        //     if ($_GET["UserName"] == "") {
        //         print("Form cant be submitted.");
        //     }
        // } elseif (isset($_GET["LastName"])) {
        //     if ($_GET["LastName"] == "") {
        //         print("Field in submision, Last name filled cant be empty");
        //     }
        // } elseif (isset($_GET["Email"])) {
        //     if ($_GET["LastName"] == "") {
        //         print("Field in submision, Email filled cant be empty");
        //     }
        // } else {
        //     print("Form submitted successfully");
        // }

        $inputs = array(
            "Key1" => "UserName",
            "Key2" => "LastName",
            "Key3" => "Email"
        );
        $flag = true;
        foreach ($inputs as $key => $value) {
            if (isset($_GET[$value])) {
                if ($_GET[$value] == "") {
                    print($arrayOfStrings["Please fill in all the inputs!"]);
                    $flag = false;
                    break;
                }
            }
        }
        if ($flag == true) {
            print($arrayOfStrings["Form has been submitted succefully!"]);
        }
    };


    ?>
    <div class="form-location">
        <div class="container-form">
            <h3><?= $arrayOfStrings["Contact us"]?></h3>
            <form action="" method="GET">
                <input type="text" placeholder="<?= $arrayOfStrings["First name"]?>" name="UserName">
                <input type="text" placeholder="<?= $arrayOfStrings["Last name"]?>" name="LastName">
                <input type="email" placeholder="Email" name="Email">
                <a href="#" class="Forgotten-password"><?= $arrayOfStrings["Forgotten password"]?></a>

                <div class="countryCodeSelection">
                    <select name="countryCode" id="countryCode" require>
                        <option value="default" selected="selected"><?= $arrayOfStrings["country"]?></option>
                        <?php
                        $countries = [
                            "Luxembourg",
                            "France",
                            "Germany",
                        ];
                        foreach ($countries as $country) {
                        ?>
                            <option value="<?= $country ?>"><?= $country ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <input type="tel" value="" name="phoneNumber" placeholder="GSM" pattern="[0-9]{9}">
                </div>

                <input type="submit" value="<?= $arrayOfStrings["submit"]?>" name="submit">
            </form>
        </div>
    </div>
    <!-- the following function will create a end bar in the end of the content of a webpage -->
    <?php
    EndBar()
    ?>

</body>

</html>
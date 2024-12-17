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
    <script>
        window.onload = function() {
            document.getElementById("btn").addEventListener("click", getLocation);
        };

        function getLocation() {
            navigator.geolocation.getCurrentPosition(function(position) {
                const latitude = position.coords.latitude
                const longitude = position.coords.longitude
                let input = document.getElementById("input").value;
                let inputCorrection = input.toLowerCase();
                let output = document.getElementById("output");

                if (inputCorrection == "home") {
                    output.innerHTML = "latitude: " + latitude + "<br>" + "longitude: " + longitude
                } else {
                    alert("Please try again!")
                }
            })
        }
    </script>
</head>

<body>
    <?php
    NavigationBarE("About");
    ?>
    <label for=""><?= $arrayOfStrings["Write Home"] ?></label>
    <input type="text" id="input" placeholder="Home">
    <button id="btn"><?= $arrayOfStrings["submit"] ?></button>
    <p id="output"></p>
    <!-- the following function will create a end bar in the end of the content of a webpage -->
    <?php
    EndBar()
    ?>

</body>

</html>
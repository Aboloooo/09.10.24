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
            function getLocation (){
            navigator.geolocation.getCurrentPosition(function(position){
                const latitude = position.coords.latitude
                const longitude = position.coords.longitude
                let output = document.getElementById("output").toLowerCase;
                 
                if(output() == "home"){
                    output.innerHTML = latitude + "<br>" + longitude
                }else{
                    alert("Error")
                }    
            })
        }
    </script>
</head>

<body>
    <?php
    include_once("../phpLibrary/MyLibrary.php");
    NavigationBarE("About");
    ?>
    <label for="">Write Home</label>
    <input type="text" placeholder="write home here">
    <button id="btn">submit</button>
    <p id="output"></p>
    <!-- the following function will create a end bar in the end of the content of a webpage -->
    <?php
    EndBar()
    ?>
    
</body>

</html>
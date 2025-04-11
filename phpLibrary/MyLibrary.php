<?php
session_start();

/* connection to database */
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'wesers2';
$connection = mysqli_connect($host, $username, $password, $database);

function NavigationBarE($DedicatedPage)
{
    global $t;
?>

    <nav class="navigationBar">
        <div>
            <h1>ABO Market</h1>
            <div class="links">
                <a href="Home.php" <?php
                                    if ($DedicatedPage == "Home") {
                                        print("class='active'");
                                    } ?>><?= $t["Home"] ?></a>

                <a href="Product.php" <?php
                                        if ($DedicatedPage == "Product") {
                                            print("class='active'");
                                        } ?>><?= $t["Product"] ?></a>

                <a href="Contact.php" <?php
                                        if ($DedicatedPage == "Contact") {
                                            print("class='active'");
                                        } ?>><?= $t["Contact"] ?></a>

                <a href="About.php" <?php
                                    if ($DedicatedPage == "About") {
                                        print("class='active'");
                                    } ?>><?= $t["About"] ?></a>
            </div>

        </div>
    </nav>
    <div id="userName">
        <div>
            <box-icon name='user'></box-icon> <br>
            <?php
            if ($_SESSION["user"]) {
                print($_SESSION["UserName"]);          //here instead of priting user I must print the username that just logged in
            } else {
                echo $t["unknown"];
            }
            ?>

            <br>

            <form method="POST">
                <select name="selectedLang" id="selectLang" onchange="this.form.submit()">
                    <option value="EN" <?php if ($_SESSION["language"] == "EN") {
                                            print("selected");
                                        } ?>>English</option>
                    <option value="FR" <?php if ($_SESSION["language"] == "FR") {
                                            print("selected");
                                        } ?>>French</option>
                </select>
            </form>
        </div>
    </div>

<?php
};

if (!isset($_SESSION["user"])) {
    $_SESSION["user"] = false;
}

if (!isset($_SESSION["userIsAdmin"])) {
    $_SESSION["userIsAdmin"] = false;
}

if (!isset($_SESSION["language"])) {
    $_SESSION["language"] = "EN";
}

if (isset($_GET["language"])) {
    $_SESSION["language"] = $_GET["language"];
}

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}


if (isset($_POST["selectedLang"])) {
    if ($_POST["selectedLang"] == "EN") {
        $_SESSION["language"] = "EN";
    } else if ($_POST["selectedLang"] == "FR") {
        $_SESSION["language"] = "FR";
    } else {
        echo "Error";
    }
}

//if btn clicked the corresponding information will be kept as array session
if (isset($_POST["addingToCart"])) {
    $prodcutID = $_POST["ID"];
    addToCart($prodcutID);
}

function addToCart($prodcutID)
{
    array_push($_SESSION["cart"], $prodcutID);
}

// //Clearing bascket
if (isset($_SESSION["cart"])) {
    if (isset($_POST["ClearAll"])) {
        unset($_SESSION["cart"]);
        // session_unset();
        header("Refresh:0");
    }
}

// adding shopping cart to checkedOut page
if (isset($_POST["check_out"])) {
    finlizedBascket();
    $_SESSION["cart"] = [];
}

/* using database */
function finlizedBascket()
{
    global $connection;
    $Date =  date('Y-m-d');
    $Time = date("H:i:s");
    $userName = $_SESSION["UserName"];
    $defaultStatus = 'Pending';

    /* checking if cart is empty */
    if (empty($_SESSION["cart"])) {
        return '<script>alert($t["Cart is empty!"])</script>';
    }



    /* inserting order into order table for each order not each product */
    $insertOrderRecord = $connection->prepare('insert into orders(userID,actionDate,actionTime,status) VALUES ((select userID from users where username=?) ,?, ?,?)');
    $insertOrderRecord->bind_param('ssss', $userName, $Date, $Time, $defaultStatus);
    if (!$insertOrderRecord->execute()) {
        echo '<script>alert(<?=$t["Order could not be placed!"]?>)</script>';
        die();
    }

    $orderId = $connection->insert_id; // TEACHER GENERATED !!!! // https://www.php.net/manual/en/mysqli.insert-id.php



    for ($i = 0; $i < count($_SESSION["cart"]); $i++) {
        $productID = $_SESSION["cart"][$i];
        $insertOrderedItems = $connection->prepare('insert into orderContent(orderID,productsID) values( ? ,?)');
        $insertOrderedItems->bind_param('ii', $orderId,  $productID);

        if (!$insertOrderedItems->execute()) {
            echo '<script>alert(<?=$t["order can not be placed, inserting order to database got an issue!"]?>)</script>';
        }
    }

    echo '<script>alert(<?=$t["order placed successfully!"]?>)</script>';
}
//end of function

?>

<?php
$t = [];
$languageColumn = '';
if ($_SESSION['language'] == 'EN') {
    $languageColumn = 'txtEN';
} else {
    $languageColumn = 'txtFR';
}
$sqlTranslation = $connection->prepare("select translationID, $languageColumn as translation from translation");
$sqlTranslation->execute();
$result = $sqlTranslation->get_result();
while ($row = $result->fetch_assoc()) {
    $t[$row['translationID']] = $row['translation'];
}
?>

<?php

function EndBar()
{
    global $t;
?>
    <div class="End-Bar">
        <div class="first-section-Resource">
            <h3> <?= $t["Resource"] ?> </h3>
            <div>
                <a href="#">#</a>
                <a href="#">#</a>
                <a href="#">#</a>
                <a href="#">#</a>
            </div>

        </div>
        <div class="second-section-Help">
            <h3> <?= $t["Help"] ?> </h3>
            <div>
                <a href="#">#</a>
                <a href="#">#</a>
                <a href="#">#</a>
                <a href="#">#</a>
            </div>
        </div>
        <div class="third-section-Company">
            <h3> <?= $t["Company"] ?></h3>
            <div>
                <a href="#">#</a>
                <a href="#">#</a>
                <a href="#">#</a>
                <a href="#">#</a>
            </div>
        </div>
        <div class="fourth-section-Location">
            <h3> <?= $t["Our headquarter in USA"] ?></h3>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2794.8282840900973!2d-122.82799792387512!3d45.50561862569456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54950b78c0f1455d%3A0x74da28bbfba4e6a9!2sNike%20World%20Headquarters!5e0!3m2!1sen!2sus!4v1614320981803!5m2!1sen!2sus"
                frameborder="0"
                width="100%"
                height="85%">
            </iframe>
        </div>
    </div>
<?php
}
?>
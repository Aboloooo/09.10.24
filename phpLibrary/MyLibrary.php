<?php

function NavigationBarE($DedicatedPage)
{
    global $arrayOfStrings;
?>

    <nav class="navigationBar">
        <div>
            <h1>ABO Market</h1>
            <div class="links">
                <a href="Home.php" <?php
                                    if ($DedicatedPage == "Home") {
                                        print("class='active'");
                                    } ?>><?= $arrayOfStrings["Home"] ?></a>

                <a href="Product.php" <?php
                                        if ($DedicatedPage == "Product") {
                                            print("class='active'");
                                        } ?>><?= $arrayOfStrings["Product"] ?></a>

                <a href="Contact.php" <?php
                                        if ($DedicatedPage == "Contact") {
                                            print("class='active'");
                                        } ?>><?= $arrayOfStrings["Contact"] ?></a>

                <a href="About.php" <?php
                                    if ($DedicatedPage == "About") {
                                        print("class='active'");
                                    } ?>><?= $arrayOfStrings["About"] ?></a>
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
                echo $arrayOfStrings["unknown"];
            }
            ?>
            <!-- <a href="Home.php?language=EN" id="langChanger">
                    <h3>changer la langue</h3>
                </a> -->
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

session_start();

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



$Translation = fopen("../DataBases/translation.csv", "r");
$arrayOfStrings = [];
$line = fgets($Translation);
while (!feof($Translation)) {
    $line = fgets($Translation);
    $Language = explode(",", $line);
    if (count($Language) == 3) {
        if ($_SESSION["language"] == "EN") {
            // language will dedicate which element out of csv file will be chosen.
            $arrayOfStrings[$Language[0]] = $Language[1];
        } else {
            $arrayOfStrings[$Language[0]] = $Language[2];
        }
    }
}

?>



<?php
function EndBar()
{
    global $arrayOfStrings;
?>
    <div class="End-Bar">
        <div class="first-section-Resource">
            <h3> <?= $arrayOfStrings["Resource"] ?> </h3>
            <div>
                <a href="#">#</a>
                <a href="#">#</a>
                <a href="#">#</a>
                <a href="#">#</a>
            </div>

        </div>
        <div class="second-section-Help">
            <h3> <?= $arrayOfStrings["Help"] ?> </h3>
            <div>
                <a href="#">#</a>
                <a href="#">#</a>
                <a href="#">#</a>
                <a href="#">#</a>
            </div>
        </div>
        <div class="third-section-Company">
            <h3> <?= $arrayOfStrings["Company"] ?></h3>
            <div>
                <a href="#">#</a>
                <a href="#">#</a>
                <a href="#">#</a>
                <a href="#">#</a>
            </div>
        </div>
        <div class="fourth-section-Location">
            <h3> <?= $arrayOfStrings["Our headquarter in USA"] ?></h3>
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


function onLoad()
{
    echo " on load function is working";
}

?>

<!-- French version  -->


<?php
function NavigationBarF($DedicatedPage)
{
?>

    <nav class="navigationBar">
        <div>
            <h1>ABO Market</h1>
            <div class="links">
                <a href="Maison.php" <?php
                                        if ($DedicatedPage == "Maison") {
                                            print("class='active'");
                                        } ?>>Maison</a>

                <a href="Product.php" <?php
                                        if ($DedicatedPage == "Product") {
                                            print("class='active'");
                                        } ?>>Product</a>

                <a href="Contact.php" <?php
                                        if ($DedicatedPage == "Contact") {
                                            print("class='active'");
                                        } ?>>Contact</a>

                <a href="à propos.php" <?php
                                        if ($DedicatedPage == "à propos") {
                                            print("class='active'");
                                        } ?>>à propos</a>
            </div>

        </div>
    </nav>

<?php
};

?>



<?php
function EndBarF()
{
?>
    <div class="End-Bar">
        <div class="first-section-Resource">
            <h3>Ressource</h3>
            <div>
                <a href="#">#</a>
                <a href="#">#</a>
                <a href="#">#</a>
                <a href="#">#</a>
            </div>

        </div>
        <div class="second-section-Help">
            <h3>Aide</h3>
            <div>
                <a href="#">#</a>
                <a href="#">#</a>
                <a href="#">#</a>
                <a href="#">#</a>
            </div>
        </div>
        <div class="third-section-Company">
            <h3>Company</h3>
            <div>
                <a href="#">#</a>
                <a href="#">#</a>
                <a href="#">#</a>
                <a href="#">#</a>
            </div>
        </div>
        <div class="fourth-section-Location">
            <h3>Notre siège aux États-Unis</h3>
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
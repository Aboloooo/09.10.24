<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>
        Hello world!
    </h1>
    <?php

    //create connection to database
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "mydbtest2";

    /* step 1 */
    $connection = mysqli_connect($host, $username, $password, $database);

    ?>
    <form action="">
        <select name="selectionBar" id="">
            <option value="0">All</option>
            <?php
            /* step 2 */
            $sqlSelectStatement = $connection->prepare("select Name, CountryName from users natural join countries");

            $sqlSelectCountries = $connection->prepare("select * from countries");
            $sqlSelectCountries->execute();
            $results = $sqlSelectCountries->get_result();

            while ($row = $results->fetch_assoc()) {
            ?>
                <option value='<?= $row["CountryID"] ?>' <?php if (isset($_GET["selectionBar"]) && $_GET["selectionBar"] == $row["CountryID"]) echo 'selected'; ?>><?= $row["CountryName"] ?></option>
            <?php
            }
            ?>
        </select>
        <input type="submit" value="filter">
    </form>
    <?php
    /* step 3 */
    /* OPTIONAL step: bind parameters from the user ... we will discuss this optional step at a later point! */

    if (isset($_GET["selectionBar"]) && $_GET["selectionBar"] != 0) {
        $sqlSelectStatement = $connection->prepare("select Name, CountryName from users natural join countries where users.countryID = ?;");
        $sqlSelectStatement->bind_param("i", $_GET["selectionBar"]);
    } else {
        $sqlSelectStatement = $connection->prepare("select Name, CountryName from users natural join countries");
    }
    /* step 4 */
    $sqlSelectStatement->execute();

    /* step 5 */
    $results = $sqlSelectStatement->get_result();

    $sqlFilterCommand = $connection->prepare('select * from users where CountryID = ' . $_GET["selectionBar"]);
    $sqlFilterCommand->execute();
    $filtred = $sqlFilterCommand->get_result();
    ?>
    <table>
        <?php
        while ($row = $results->fetch_assoc()) {
        ?>
            <tr>
                <td><?= $row["Name"] ?></td>
                <td><?= $row["CountryName"] ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>
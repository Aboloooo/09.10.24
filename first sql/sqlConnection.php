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
    /* step 2 */
    $sqlSelectStatement = $connection->prepare("select countryName from countries");

    /* step 3 */
    /* OPTIONAL step: bind parameters from the user ... we will discuss this optional step at a later point! */

    /* step 4 */
    $sqlSelectStatement->execute();

    /* step 5 */
    $results = $sqlSelectStatement->get_result();



    /* getting user input */
    if (isset($_GET["submitBtn"])) {
        $userInput = isset($_GET["selectedCountry"]);

        $sqlFilterCommand = $connection->prepare('select * from users where CountryID = ' . $userInput);
        $sqlFilterCommand->execute();
        $filtred = $sqlFilterCommand->get_result();
        echo '<table>
                <th>name</th>';
        while ($row = $filtred->fetch_assoc()) {
    ?>
            <tr><?= $row["Name"] ?></tr>
    <?php
        }
        echo '</table>';
    }
    ?>
    <form action="" method="GET">
        <label for="">choose a country</label>

        <select name="selectedCountry" id="">
            <option value="choose">select</option>
            <?php
            while ($row = $results->fetch_assoc()) {
                $countID++;
            ?>
                <option value="<?= $countID ?>"><?= $row['countryName'] ?> </option>';
            <?php
            }
            ?>
        </select>
        <input type="submit" value="filter" name="submitBtn">
    </form>

    <table>
        <th></th>
    </table>
</body>

</html>
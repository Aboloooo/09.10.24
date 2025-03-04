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
    ?>
    <form action="">
        <select name="selectedCountry" id="">
        <?php
        while ($row = $results->fetch_assoc()) {
            ?>
            <option value="<?= $row['countryName']?>" if() ><?= $row['countryName']?></option>';
           <?php
        }
        ?>
        </select>
    </form>
</body>

</html>
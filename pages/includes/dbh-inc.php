<?php




$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "desk_help";

$conn = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);

//Check your connection === FALSE

if ($conn == FALSE) {
    echo "<p>Unable to connect to the database server.</p>"
            . "<p>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn)
            . "</p>";
}








?>

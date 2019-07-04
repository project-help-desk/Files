<?php
$conn = mysqli_connect("localhost", "root", "", "stenden_helpdesk");
if (!$conn) {
    echo "<p>Unable to connect to the database server.</p>"
    . "<p>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn)
    . "</p>";
}
?>
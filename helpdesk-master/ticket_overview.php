<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Submission - Stenden Helpdesk</title>
    <link rel="stylesheet" href="vendor/Slick/slick.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="fonts/fonts.css">
    <link rel="stylesheet" href="fonts/ticket_overview.css">
</head>
<style>
    table {

        float: left;
        margin: auto 0;
        width: 100%;
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid darkgrey;
    }
    .container{

    }
    .footer {
        float: left;
        width: 100%;
    }
    .table {
        float: left;
        width: 100%;
        height: 850px;
        padding-top: 300px;
    }
</style>
<body>
<?php include_once 'includes/header.php'; ?>
<div class="container">
    <div class="table">
<?php
$connection = mysqli_connect("localhost", "root", "", "stenden_helpdesk");
if (!$connection) {
    die("Connection to the database not succeeded " . mysqli_error($connection));
}
$query_select = "SELECT Incident_id, Status_id, Solution_id, Contact_id, Operator_id, Date_time, Description, type_id FROM incident";
if ($statement = mysqli_prepare($connection, $query_select)) {
    if (mysqli_stmt_execute($statement)) {
    } else {
        echo "Unable to select the table";
        die(mysqli_error($connection));
    }
} else {
    die(mysqli_error($connection));
}
mysqli_stmt_bind_result($statement, $Incident, $Status, $Solution, $Contact, $Operator, $DateTime, $Description, $Type);
mysqli_stmt_store_result($statement);
if (mysqli_stmt_num_rows($statement) > 0) {
echo "<table>";
echo "<th>Incident</th> <th>Status</th> <th>Solution</th> <th>Contact</th> <th>Operator</th> <th>Date/Time</th> <th>Description</th> <th>Type</th> <th>Edit ticket</th>";
//Fetch de informatie van de statement
while ($row = mysqli_stmt_fetch($statement)) {
    echo "<tr>";
    echo "<td>" . $Incident . "</td>";
    echo "<td>" . $Status . "</td>";
    echo "<td>" . $Solution . "</td>";
    echo "<td>" . $Contact . "</td>";
    echo "<td>" . $Operator . "</td>";
    echo "<td>" . $DateTime . "</td>";
    echo "<td>" . $Description . "</td>";
    echo "<td>" . $Type . "</td>";
    echo "<td><a href=>Edit</a></td>"; //needs to be directed to the edit ticket page.
    echo "</tr>";
}
}
else {
    echo "There are currently no tickets";
}
echo "</table>";
mysqli_stmt_close($statement);
mysqli_close($connection);
?>
    </div>
</div>
<div class="footer">
<?php include_once 'includes/footer.php'; ?>
</div>
</body>
</html>

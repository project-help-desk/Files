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
    <link rel="stylesheet" href="css/form.css">
    <style>
        table {
            border-collapse: collapse;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }
        .container{

        }
    </style>
</head>
<body>
<?php include_once 'includes/header.php'; ?>
<div class="container">
<?php
$connection = mysqli_connect("localhost", "root", "", "desk_help");
if (!$connection) {
    die("Connection to the database not succeeded " . mysqli_error($connection));
}
$query_select = "SELECT Time_Registered,Client_ID,Date,Description,Type_ID,Status_ID,Solution_ID FROM incident";
if ($statement = mysqli_prepare($connection, $query_select)) {
    if (mysqli_stmt_execute($statement)) {
    } else {
        echo "Unable to select the table";
        die(mysqli_error($connection));
    }
} else {
    die(mysqli_error($connection));
}
mysqli_stmt_bind_result($statement,$time,$client_id,$date,$description,$type_id,$status_id,$solution_id);
mysqli_stmt_store_result($statement);
if (mysqli_stmt_num_rows($statement) > 0) {
echo "<table>";
echo "<th>Time</th> <th>Client</th> <th>Date</th> <th>Description</th> <th>Type</th> <th>Status</th> <th>Solution</th> <th>Edit ticket</th>";
//Fetch de informatie van de statement
while ($row = mysqli_stmt_fetch($statement)) {
    echo "<tr>";
    echo "<td>" . $time . "</td>";
    echo "<td>" . $client_id . "</td>";
    echo "<td>" . $date . "</td>";
    echo "<td>" . $description . "</td>";
    echo "<td>" . $type_id . "</td>";
    echo "<td>" . $status_id . "</td>";
    echo "<td>" . $solution_id . "</td>";
    echo "<td><a href=>Edit</a></td>"; //needs to be directed to the edit ticket page.
    echo "</tr>";
    echo "</table>";
}
}
else {
    echo "There are currently no tickets";
}
mysqli_stmt_close($statement);
mysqli_close($connection);
?>
</div>
<?php include_once 'includes/footer.php'; ?>
</body>
</html>

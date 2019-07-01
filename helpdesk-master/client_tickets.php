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
         <form method="POST" action="client_tickets.php">
                <div class="push">
                     <p><input type="text" name="contact" placeholder="Your Contact ID here" required></p>
                     </div>
                       <div class="push">
                    <p><input type="submit" name="submit" value="Submit"></p>
                </div>
            </form>
        <?php include_once 'includes/header.php'; ?>
        <div class="container">
            <?php
            
             if (empty($_POST['contact'])) {
        echo "<p>You must fill in every input field.</p>";
    } else {
        //INSERT data from database---
      
        $contact = htmlentities($_POST["contact"]);
        $connection = mysqli_connect("localhost", "root", "", "Stenden_helpdesk");
            if (!$connection) {
                die("Connection to the database not succeeded " . mysqli_error($connection));
            }
            $query_select = "SELECT * FROM incident WHERE Contact_id=". $contact;
            if ($statement = mysqli_prepare($connection, $query_select)) {
                if (mysqli_stmt_execute($statement)) {
                    
                } else {
                    echo "Unable to select the table";
                    die(mysqli_error($connection));
                }
            } else {
                die(mysqli_error($connection));
            }
            mysqli_stmt_bind_result($statement, $Incident_id, $Status_id, $Solution_id, $Contact_id, $Operator_id, $Date_time, $Description, $type_id);
            mysqli_stmt_store_result($statement);
          if(mysqli_stmt_num_rows($statement) != 0) {
                echo "<table>";
                echo "<th>Incident_id</th> <th>Contact_id</th> <th>Status_id</th> <th>Description</th> <th>Operator_id</th> <th>Date</th> <th>Solution</th>";
//Fetch de informatie van de statement
                while (mysqli_stmt_fetch($statement)) {
                    echo "<tr>";
                    echo "<td>" . $Incident_id . "</td>";
                    echo "<td>" . $Contact_id . "</td>";
                    echo "<td>" . $Status_id . "</td>";
                    echo "<td>" . $Description . "</td>";
                    echo "<td>" . $Operator_id . "</td>";
                    echo "<td>" . $Date_time . "</td>";
                    echo "<td>" . $Solution_id . "</td>";

                    echo "</tr>";
                   
                }
                 echo "</table>";
            } else {
                echo "There are currently no tickets";
            }
    
            mysqli_stmt_close($statement);
            mysqli_close($connection);
    }
            ?>
        </div>
        <?php include_once 'includes/footer.php'; ?>
    </body>
</html>
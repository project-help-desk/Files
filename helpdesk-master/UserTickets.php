<?php session_start(); ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Tickets</title>
        <link rel="stylesheet" href="vendor/Slick/slick.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="fonts/fonts.css">
        <link rel="stylesheet" href="css/usertickets.css">
    </head>

    <body>
        <?php include_once 'includes/header.php'; ?>
        <div class="container">
            <?php
            // if(!isset($_SESSION)) uncoment when login and sign on pages are done
            //{
            //    session_start();
            // }
            include_once 'includes/dbh-inc.php';
            $user_id = $_SESSION['valid_id'];
            $TableName = "incident";
            $SQLstring = "SELECT incident.Incident_id, incident.Date_time, incident.Description, incident_status.status_id, incident_status.Description, type.type_description, incident.solution, operator.First_name, operator.Last_name FROM incident LEFT JOIN incident_status ON incident_status.Status_id = incident.Status_id LEFT JOIN type ON type.type_id = incident.type_id LEFT JOIN contact ON contact.Contact_id = incident.Contact_id LEFT JOIN operator ON operator.Operator_id = incident.Operator_id
                    WHERE Incident.contact_id = ?";
            if ($stmt = mysqli_prepare($conn, $SQLstring)) {
                mysqli_stmt_bind_param($stmt, 's', $user_id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $ticketNumber, $date_time, $Descriprion, $status_id, $Status, $type, $solution, $opp_firstname, $opp_lastname);
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 0) {
                    echo "<p>You haven't submitted any tickets!</p>";
                } else {
                    echo "<h1>Tickets overview:</h1>";
                    echo "<table border=1px solid black>";
                    echo "<tr><th>Ticket Id</th>
                           <th>Incident Type</th>
                           <th>Incident Submition Date</th>
                          <th>Incident Description</th>
                          <th>Incident Status</th>
                          <th>Incident Solution</th>
                          <th>Operator handling your ticket</th>
                           <th>Picture</th>
                           <th>Edit incident</th>
                           <th>Delete incident</th></tr>";
                    while (mysqli_stmt_fetch($stmt)) {
                        echo "<tr><td><center>" . $ticketNumber . "</center></td>";
                        echo "<td><center>" . $type . "</center></td>";
                        echo "<td><center>" . $date_time . "</center></td>";
                        echo "<td><center>" . $Descriprion . "</center></td>";
                        echo "<td><center>" . $Status . "</center></td>";
                        echo "<td><center>" . $solution . "</center></td>";
                        echo "<td><center>" . $opp_firstname . " " . $opp_lastname . "</center></td>";
                        echo "<td> <img src ='profile/" . $opp_firstname . "_" . $opp_lastname . ".jpg'width = 50 height = 50 alt= Avatar here></td>";
                        if ($status_id == 2 OR $status_id == 4) {
                            echo '<td></td><td></td></tr>';
                        } else {
                            echo "<td><center><a href=edit_tickets.php?id=$ticketNumber>Edit</a></center></td>";
                            echo "<td><center><a href=delete_tickets.php?class=$ticketNumber>Delete</a></center></td></tr>";
                        }
                    }
                    echo '</table>';
                }
                mysqli_stmt_close($stmt);


                mysqli_close($conn);
            }
            echo "<a href='input_ticket.php' class='button'>Add new ticket</a>";
            ?>
        </div>
        <footer>
            <div class="container">
                <p>© 2019 February guys and me</p>
            </div>
        </footer>
    </body>
</html>

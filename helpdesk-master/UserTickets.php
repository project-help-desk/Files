<?php session_start(); ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // if(!isset($_SESSION)) uncoment when login and sign on pages are done
        //{
        //    session_start();
        // }
        echo '<a href="input_ticket.php">input new ticket</a>';
        $DBConnect = mysqli_connect("localhost", "root", "");
        if ($DBConnect === FALSE) {
            echo "<p>Unable to connect to the database server.</p>"
            . "<p>Error code " . mysqli_errno() . ": " . mysqli_error()
            . "</p>";
        } else {
            $DBName = "stenden_helpdesk";
            if (!mysqli_select_db($DBConnect, $DBName)) {
                echo "<p>Connection to the database failed.</p>";
            } else {
                $user_id = $_SESSION['valid_id'];
                $TableName = "incident";
                //$customerID = $_SESSION['cus_id'];
                // $incidentId = 7;
                $SQLstring = "SELECT incident.Incident_id, incident.Status_id, incident.Solution_id, incident.Contact_id, incident.Operator_id, incident.Date_time, incident.Description, incident.type_id, incident_status.Status_id, incident_status.Description,type.type_id,type.type_description,solution.Solution_id,solution.Description,contact.Contact_id, contact.First_name, contact.Last_name, operator.Operator_id, operator.First_name, operator.Last_name FROM incident LEFT JOIN incident_status ON incident_status.Status_id = incident.Status_id LEFT JOIN type ON type.type_id = incident.type_id LEFT JOIN solution ON solution.Solution_id = incident.Solution_id LEFT JOIN contact ON contact.Contact_id = incident.Contact_id LEFT JOIN operator ON operator.Operator_id = incident.Operator_id
                    WHERE Incident.contact_id = ?";
                if ($stmt = mysqli_prepare($DBConnect, $SQLstring)) {
                    mysqli_stmt_bind_param($stmt, 's', $user_id);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $ticketNumber, $statusId, $SolId, $ContID, $OperatorId, $Date, $Descriprion, $type, $status_id, $status_desc, $type_id, $type_desc, $solution_id, $solution_desc, $contID, $firstname, $lastname, $opp_id, $opp_firstname, $opp_lastname);
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 0) {

                        echo "<p>You haven't submitted any tickets!</p>";
                    } else {

                        echo "<h1>Tickets overview:</h1>";
                        echo "<table border=1px solid black>";
                        echo "<tr><th>Ticket Id</th>
                           <th>Statuse ID</th>
                           <th>Solution ID</th>
                          <th>Contact ID</th>
                          <th>Operator ID</th>
                          <th>Date</th>
                          <th>Description</th>
                           <th>Type</th>
                           <th>Type</th></tr>";
                        while (mysqli_stmt_fetch($stmt)) {
                            echo "<tr><td><center>" . $ContID . "</center></td>";
                            echo "<td><center>" . $OperatorId . "</center></td>";
                            echo "<td><center>" . $Date . "</center></td>";
                            echo "<td><center>" . $Descriprion . "</center></td>";
                            echo "<td><center>" . $type . "</center></td>";
                            echo "<td><center>" . $status_desc . "</center></td>";
                            echo "<td><center>" . $operatorname . "</center></td>";
                            echo "<td><center>" . $company_name . "</center></td>";
                            echo "<td><center>" . $type_Desc . "</center></td>";
                            echo "<td><center>" . $cont_name . "</center></td>";
                            echo "<td><a href=edit_tickets.php?id=$ticketNumber>Edit</a></td>";
                            echo "<td><a href=delete_tickets.php?class=$ticketNumber>Delete </a></td></tr>";
                        }
                        echo '</table>';
                    }
                    mysqli_stmt_close($stmt);
                }
            }

            mysqli_close($DBConnect);
        }
        echo "";
        ?>
    </body>
    <?php
    // include"delete.php";   
    ?>
</html>

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

        include_once 'includes/header.php';
                $TableName = "incident";
                //$customerID = $_SESSION['cus_id'];
                // $incidentId = 7;
                $SQLstring = "SELECT * FROM incident";
                if ($stmt = mysqli_prepare($conn, $SQLstring)) {
                    // mysqli_stmt_bind_param($stmt, 's', $incidentId);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $ticketNumber, $statusId, $SolId, $ContID, $OperatorId, $Date, $Descriprion);
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
                          <th>Description</th></tr>";
                        while (mysqli_stmt_fetch($stmt)) {
                            echo "<tr><td><center>" . $ticketNumber . "</center></td>";
                            echo "<td><center>" . $statusId . "</center></td>";
                            echo "<td><center>" . $SolId . "</center></td>";
                            echo "<td><center>" . $ContID . "</center></td>";
                            echo "<td><center>" . $OperatorId . "</center></td>";
                            echo "<td><center>" . $Date . "</center></td>";
                            echo "<td><center>" . $Descriprion . "</center></td>";
                            echo "<td><a href=edit.php?id=$ticketNumber>Edit</a></td>";
                            echo "<td><a href=delete.php?class=$ticketNumber>Delete </a></td>";
                        }
                        echo '</table>';
                    }
                    mysqli_stmt_close($stmt);
                
            

            mysqli_close($conn);
        }
        echo "";
        ?>
    </body>
        <?php
        // include"delete.php";   
        ?>
</html>

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
                if (isset($_SESSION['valid_id'])) {
                    if ($_POST['perm_level'] > 1) {
                        require_once'OverviewReports.php';
                        echo '<fieldset>';
                        echo 'Number of incidents this week&nbsp;&nbsp;&nbsp;: ' . $weekcount . '<br>';
                        echo 'Number of incidents this month&nbsp;: ' . $monthcount . '<br>';
                        echo 'Number of incidents this year&nbsp;&nbsp;&nbsp;&nbsp;: ' . $yearcount;
                        echo '</fieldset><br><br><br>';

                        $connection = mysqli_connect("localhost", "root", "", "stenden_helpdesk");
                        if (!$connection) {
                            die("Connection to the database not succeeded " . mysqli_error($connection));
                        }
                        $query_select = "SELECT incident.Incident_id, incident.Status_id, incident.Solution, incident.Contact_id, incident.Operator_id, incident.Date_time, incident.Description, incident.type_id, incident_status.Status_id, incident_status.Description,type.type_id,type.type_description,solution.Solution_id,solution.Description,contact.Contact_id, contact.First_name, contact.Last_name, operator.Operator_id, operator.First_name, operator.Last_name 
FROM incident 
LEFT JOIN incident_status ON incident_status.Status_id = incident.Status_id 
LEFT JOIN type ON type.type_id = incident.type_id 
LEFT JOIN solution ON solution.Solution_id = incident.Solution_id 
LEFT JOIN contact ON contact.Contact_id = incident.Contact_id 
LEFT JOIN operator ON operator.Operator_id = incident.Operator_id
";
                        if ($statement = mysqli_prepare($connection, $query_select)) {
                            if (mysqli_stmt_execute($statement)) {
                                
                            } else {
                                echo "Unable to select the table";
                                die(mysqli_error($connection));
                            }
                        } else {
                            die(mysqli_error($connection));
                        }
                        mysqli_stmt_bind_result($statement, $Incident, $statusID, $Solution, $Contact, $Operator, $DateTime, $Description, $Type, $isID, $isDesc, $typeId, $typeDesc, $solutionID, $solutionDesc, $contactID, $contactFirst, $contactLast, $operatorID, $operatorFirst, $operatorLast);
                        mysqli_stmt_store_result($statement);
                        if (mysqli_stmt_num_rows($statement) > 0) {
                            echo "<table>";
                            echo "<th>Incident</th> <th>Status</th> <th>Solution</th> <th>Contact</th> <th>Operator</th> <th>Date/Time</th> <th>Description</th> <th>Type</th> <th>Edit ticket</th>";
//Fetch de informatie van de statement
                            while ($row = mysqli_stmt_fetch($statement)) {
                                if ($statusID == 0) {
                                    //claim button
                                    $link = "<a href=operator_edit.php?id=" . $Incident . ">Edit</a>";
                                } elseif ($statusID == 1) {
                                    if ($_SESSION['perm_level'] == 2) {
                                        //solve button
                                        $link = "<a href=operator_edit.php?id=" . $Incident . ">Edit</a>";
                                    } else {
                                        //close button
                                        $link = '<form action="" method="POST">
                                    <input type="hidden" name="incidentid" value="' . $Incident . '"/>
                                    <input type="submit" name="close1" value="Close"/>
                                    </form>';
                                    }
                                } elseif ($statusID == 3 && $_SESSION['perm_level'] == 3) {
                                    //close button

                                    $link = '<form action="" method="POST">
                                    <input type="hidden" name="incidentid" value="' . $Incident . '"/>
                                    <input type="submit" name="close3" value="Close"/>
                                    </form>';
                                } else {
                                    $link = '';
                                }

                                echo "<tr>";
                                echo "<td>" . $Incident . "</td>";
                                echo "<td>" . $isDesc . "</td>";
                                echo "<td>" . $Solution . "</td>";
                                echo "<td>" . $contactFirst . " " . $contactLast . "</td>";
                                echo "<td>" . $operatorFirst . " " . $operatorLast . "</td>";
                                echo "<td>" . $DateTime . "</td>";
                                echo "<td>" . $Description . "</td>";
                                echo "<td>" . $typeDesc . "</td>";
                                echo "<td>$link</td>"; //needs to be directed to the edit ticket page.
                                echo "</tr>";
                            }
                            if (isset($_POST['close1'])) {
                                $query = "UPDATE incident SET status_id = 2 WHERE incident_id = ?";
                                if ($stmt = mysqli_prepare($connection, $query)) {
                                    mysqli_stmt_bind_param($stmt, "i", $_POST['incidentid']);
                                    if (mysqli_stmt_execute($stmt)) {
                                        echo "";
                                        echo "<br>";
                                    } else {
                                        echo "Unable to Update " . mysqli_error($connection);
                                    }

                                    mysqli_stmt_close($stmt);
                                } else {
                                    echo "Unable to Prepare " . mysqli_error($connection);
                                }
                            }
                            if (isset($_POST['close3'])) {
                                $query = "UPDATE incident SET status_id = 4 WHERE incident_id = ?";
                                if ($stmt = mysqli_prepare($connection, $query)) {
                                    mysqli_stmt_bind_param($stmt, "i", $_POST['incidentid']);
                                    if (mysqli_stmt_execute($stmt)) {
                                        echo "";
                                        echo "<br>";
                                    } else {
                                        echo "Unable to Update " . mysqli_error($connection);
                                    }

                                    mysqli_stmt_close($stmt);
                                } else {
                                    echo "Unable to Prepare " . mysqli_error($connection);
                                }
                            }
                        } else {
                            echo "There are currently no tickets";
                        }
                        echo "</table>";
                        mysqli_stmt_close($statement);
                        mysqli_close($connection);
                        ?>
                        <form action="search.php" method="POST">
                            <input type="text" placeholder="Incident# or Describtion" name="query" />
                            <input type="submit" value="Search" />
                        </form>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        <div class="footer">
            <?php include_once 'includes/footer.php'; ?>
        </div>
    </body>
</html>



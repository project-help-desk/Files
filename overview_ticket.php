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
    <title>FAQ</title>
    <link rel="stylesheet" href="vendor/Slick/slick.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="fonts/fonts.css">
</head>

<body>
    <header>
        <div class="container clearfix">
            <div class="logo">
                <a href="#">
                    <img src="img/logo1.png" width="60%" alt="">
                </a>
            </div>
            <div class="menu-btn not-active"><span></span>
            </div>
            <ul class="menu">
                <li><a href="#">Faq</a>
                </li>
                <li><a href="#">buy a license</a>
                </li>
                <li><a href="#">may be smth else</a>
                </li>
                <li><a href="#">login</a>
                </li>
            </ul>
        </div>
    </header>
    <div class="container">
        <?php
                
               // if(!isset($_SESSION)) uncoment when login and sign on pages are done
                //{
                //    session_start();
               // }
                
                $DBConnect = mysqli_connect("localhost", "root", "");
                if ($DBConnect === FALSE)
                {
                    echo "<p>Unable to connect to the database server.</p>"
                    . "<p>Error code " . mysqli_errno() . ": " . mysqli_error()
                    . "</p>";
                }
                
                else {$DBName = "stenden_helpdesk"; 
                if(!mysqli_select_db ($DBConnect, $DBName))
                {
                  echo "<p>Connection to the database failed.</p>";
                }
                
                else {$TableName = "incident";
                //$customerID = $_SESSION['cus_id'];
                $incidentId = 1;
                $SQLstring = "SELECT * FROM ".$TableName. " WHERE incident_id = ?";
                if ($stmt = mysqli_prepare($DBConnect, $SQLstring)) 
                {
                    mysqli_stmt_bind_param($stmt, 's', $incidentId);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $ticketNumber, $statusId, $SolId, $ContID, $OperatorId, $Date ,$Descriprion);
                    mysqli_stmt_store_result($stmt);
                
                    if (mysqli_stmt_num_rows($stmt) == 0) 
                    {

                         echo "<p>You haven't submitted any tickets!</p>";
                   }

                   else 
                       {

                        echo "<h1>Tickets overview:</h1>";
                        echo "<table style='margin-bottom: 60px; border: 1px solid #000;'>";
                        echo "<tr><th style=' border: 1px solid #000; padding: 5px;'>Ticket Id</th>
                           <th style=' border: 1px solid #000; padding: 5px;'>Statuse ID</th>
                           <th style=' border: 1px solid #000; padding: 5px;'>Solution ID</th>
                          <th style=' border: 1px solid #000; padding: 5px;'>Contact ID</th>
                          <th style=' border: 1px solid #000; padding: 5px;'>Operator ID</th>
                          <th style=' border: 1px solid #000; padding: 5px;'>Date</th>
                          <th style=' border: 1px solid #000; padding: 5px;'>Description</th></tr>";
                        while (mysqli_stmt_fetch($stmt)) {
                        echo "<tr><td style=' border: 1px solid #000; padding: 5px;'><center>".$ticketNumber."</center></td>";
                        echo "<td style=' border: 1px solid #000; padding: 5px;'><center>".$statusId."</center></td>";
                        echo "<td style=' border: 1px solid #000; padding: 5px;'><center>".$SolId."</center></td>";
                        echo "<td style=' border: 1px solid #000; padding: 5px;'><center>".$ContID."</center></td>";
                        echo "<td style=' border: 1px solid #000; padding: 5px;'><center>".$OperatorId."</center></td>";
                        echo "<td style=' border: 1px solid #000; padding: 5px;'><center>".$Date."</center></td>";
                        echo "<td style=' border: 1px solid #000; padding: 5px;'><center>".$Descriprion."</center></td>";
                        
                                            
                        
                        }
                        echo '</table>';
                        

                        }
                        mysqli_stmt_close($stmt);
                }
                    } 
                    
                    mysqli_close($DBConnect);
                }
                
                ?>
        </div>
    <footer>
        <div class="container">
            <p>© 2019 February guys and me</p>
        </div>
    </footer>
    </body>
</html>

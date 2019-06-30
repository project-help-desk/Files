<?php session_start();?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ticket Submission - Stenden Helpdesk</title>
        <link rel="stylesheet" href="vendor/Slick/slick.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="fonts/fonts.css">
        <link rel="stylesheet" href="css/form.css">
    </head>
    <body>
        <?php include_once 'includes/header.php'; ?>
        <div id="boxing"> 
            <div class="push">
                <h1>Ticket Submission</h1>
            </div>
            <div class="error">
                
 <?php

$servername = "localhost";
$username = "root";
$password = "";
$databasename = "customer_db";
$conn = mysqli_connect($servername, $username, $password, $databasename);
if(!$conn) {
	die ('Connection failed: ' . mysqli_connect_error());
}

 
    if (empty($_POST['desc']) || empty($_POST['issue'])) {
        echo "<p>You must fill in every input field.</p>";
    } else {
        //INSERT data from database---
        $desc= htmlentities($_POST["desc"]);
        $issue= htmlentities($_POST["issue"]);
        $date = date("y-m-d");
        $TableName = "incidents";
        $sql = "INSERT INTO incident (Date, Description, Issue) VALUES(?,?,?)";
        if ($statement = mysqli_prepare($conn, $sql)) {
            //s means binding string
            //Binds variables to a prepared statement as parameters
            mysqli_stmt_bind_param($statement, 'sss', $date, $desc, $issue);

            if (mysqli_stmt_execute($statement)) {
                echo "Incident inserted successfully";
            } else {
                echo "error inserting";
                die(mysqli_error($conn));
            }
        } else {
            die(mysqli_error($conn));
        }

        //close the statement
        mysqli_stmt_close($statement);
        mysqli_close($conn);
    }
    ?>
             
            </div>
            <form method="POST" action="input_ticket.php">
                <div class="push">
                    <p>Description</p>            
                    <p><textarea rows="7" cols="35" name="desc" maxlength="2000"></textarea></p>
                </div>
                <div class="push">
                   <p>Type of Issue</p>
                    <p><select name="issue">
                        <option value="Technical Problem">Technical Problem</option>
                        <option value="Functional Problem">Functional Problem</option>
                        <option value="Failure">Failure</option>
                        <option value="Question">Question</option>
                        <option value="Wish">Wish</option>
                  </select></p>
                    <p><input type="submit" name="submit" value="Submit"></p>
                </div>
            </form>   
        </div>

        <script src="vendor/jquery/jquery-3.2.0.min.js"></script>
        <script src="js/core.js"></script>
        <?php include_once 'includes/footer.php'; ?>


    </body>
</html>
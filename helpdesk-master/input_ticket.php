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
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $databasename = "stenden_helpdesk";
            $conn = mysqli_connect($servername, $username, $password, $databasename);
            if (!$conn) {
                die('Connection failed: ' . mysqli_connect_error());
            }
            if (isset($_SESSION['valid_id'])) {
                if ($_SESSION['valid_id'] > 0) {
                    echo'<div class="error">';
                    if (isset($_POST['submit'])) {
                        if (empty($_POST['desc']) || empty($_POST['issue'])) {
                            echo "<p>You must fill in every input field.</p>";
                        } else {

                            $desc = htmlentities($_POST['desc']);
                            $issue = htmlentities($_POST['issue']);
                            $contact_id = htmlentities($_SESSION['valid_id']);
                            $date = date('Y-m-d h:i:s', time());
//                            $fields = array('Date_time', 'Contact_id', 'Description', 'Type_ID', 'Status_ID');
//                            $values = array(, $_SESSION['loggedIn'], $desc, $type, '1'); // TODO change NULL to CLient_ID
//                            $stmt = InsertDBStatement($SQLConnect, "Incident", $fields, $values, "sisii");
                            $sql = "INSERT INTO incident (Date_Time, Description, type_id,contact_id) VALUES (?,?,?,?)";
                            if ($statement = mysqli_prepare($conn, $sql)) {
                                //s means binding string
                                //Binds variables to a prepared statement as parameters
                                mysqli_stmt_bind_param($statement, "ssii", $date, $desc, $issue,$contact_id);
                                if (mysqli_stmt_execute($statement)) {
                                    echo "Incident inserted successfully";
                                } else {
                                    echo "error inserting incident";
                                    die(mysqli_error($conn));
                                }
                            } else {
                                die(mysqli_error($conn));
                            }
                        }
                    }
                    echo'</div>
                    <form method="POST" action="input_ticket.php">
                        <div class="push">
                            <p>Description</p>            
                            <p><textarea rows="7" cols="35" name="desc" maxlength="2000"></textarea></p>
                        </div>
                        <div class="push">
                            <p>Type of Issue</p>
                            <p>
                                <select name="issue">
                                    <option value="1">Technical Problem</option>
                                    <option value="2">Functional Problem</option>
                                    <option value="3">Failure</option>
                                    <option value="4">Question</option>
                                    <option value="5">Wish</option>
                                    <option value="6">Other</option>
                                </select>
                            </p>
                            <p><input type="submit" name="submit" value="Submit"></p>
                        </div>
                    </form>';
                } else {
                    echo'<div class="error">
                    <p>Using the ticket system requires a licence. Licences are available at the licence store or you can try visting the FAQ to find your problem there.</p>
                    <p><form action="BuyLicence.php" method="POST">
                        <input type="submit" value="Buy licence">
                    </form></p>
                    <p><form action="FAQ.php" method="POST">
                        <input type="submit" value="Visit the FAQ">
                    </form></p>
                    </div>';
                }
            } else {
                echo'<div class="error">
                    <p>Please login or sign up first to submit a ticket.</p>
                    <p><form action="login.php" method="POST">
                        <input type="submit" value="Login">
                    </form></p>
                    <p><form action="signup.php" method="POST">
                        <input type="submit" value="Sign Up">
                    </form></p>
                </div>';
            }
            ?>
        </div>
        <script src="vendor/jquery/jquery-3.2.0.min.js"></script>
        <script src="js/core.js"></script>
        <?php include_once 'includes/footer.php'; ?>


    </body>
</html>
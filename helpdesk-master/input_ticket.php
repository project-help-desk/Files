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
                <form method="POST" action="input_ticket.php">
            <div class="push">
                <p>Description</p>            
                <p><textarea rows="7" cols="35" name="desc" maxlength="2000"></textarea></p>
            </div>
            <div class="push">
                <p>Type of Issue</p>
                <p><select name="issue">
                <option value="1">Technical Problem</option>
                <option value="2">Functional Problem</option>
                <option value="3">Failure</option>
                <option value="4">Question</option>
                <option value="5">Wish</option>
                </select></p>
                <p><input type="submit" name="submit" value="Submit"></p>
            </div>
                </form>   
        </div>
        <script src="vendor/jquery/jquery-3.2.0.min.js"></script>
        <script src="js/core.js"></script>
        <?php include_once 'includes/footer.php';?>
        
        <?php

        if (isset($_POST['submit'])) {
        if (empty($_POST['desc']) || empty($_POST['issue'])) {
        echo "<div class='success'><p>You must fill in all the required elements.
            Click your browser's back button to return to the message form.</p></div>";
        } else {
        $SQLConnect = OpenDBConnection();

        $id = NewSolution($SQLConnect);
        $desc = htmlentities(filter_var($_POST['desc'], FILTER_SANITIZE_STRING));
        $type = htmlentities($_POST['issue']);
        $fields = array('Time_Registered', 'Client_ID', 'Date', 'Description', 'Type_ID', 'Status_ID', 'Solution_ID');
        $values = array('CURRENT_TIME', '1', 'CURRENT_DATE', $desc, $type, '1', $id); // TODO change NULL to CLient_ID
        $stmt = InsertDBStatement($SQLConnect, "Incident", $fields, $values, "isiii");

        if ($stmt != false) {
            $QueryResult2 = $stmt->execute();
            if ($QueryResult2 === false) {
                DisplayDBError($SQLConnect);
            } else {
                echo "<h1>Thank you for submitting your ticket!</h1>";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "error";
        }
        CloseDBConnection($SQLConnect);
    }
}

?>
    </body>
</html>

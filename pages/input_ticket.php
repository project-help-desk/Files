<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
    
        <title>Ticket Submission - Stenden Helpdesk</title>
    </head>
    <body>
 
                <h1 class="header_details">Ticket Submission</h1>
          
                <form method="POST" action="input_ticket.php">
                <h2>Description</h2>
                <p><textarea name="desc" maxlength="2000"></textarea></p>
                <h2>Type of Issue</h2>
                <p><select name="issue">
                <option value="1">Technical Problem</option>
                <option value="2">Functional Problem</option>
                <option value="3">Failure</option>
                <option value="4">Question</option>
                <option value="5">Wish</option>
                </select></p>
                <p><input type="submit" name="submit" value="Submit"></p>
                </form>

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

    </body></html>




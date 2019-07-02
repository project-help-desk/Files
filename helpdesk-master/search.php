<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Search</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
	<?php
   
    $conn = mysqli_connect("localhost", "root", "", "stenden_helpdesk");
   
    if(mysqli_connect_errno()){
        echo "Failed to connect: " . mysqli_connect_error();
    }
 
    error_reporting(0);
 
    $output = '';
   
    if(isset($_POST['query']) && $_POST['query'] !== ' '){
        $searchq = $_POST['query'];
       
        $q = mysqli_query($conn, "SELECT * FROM incident WHERE Incident_id LIKE '%$searchq%' OR Status_id LIKE '%$searchq%' OR Solution_id LIKE '%$searchq%' OR contact_id LIKE '%$searchq%' OR Operator_id LIKE '%$searchq%' OR Date_time LIKE '%$searchq%'  OR Description LIKE '%$searchq%' OR type_id LIKE '%$searchq%'") or die(mysqli_error());
		
        $c = mysqli_num_rows($q);
        if($c == 0){
            $output = 'No search results for <b>"' . $searchq . '"</b>';
        } else {
            while($row = mysqli_fetch_array($q)){
                $incidentid = $row['Incident_id'];
                $status = $row['Status_id'];
				$solution = $row['Solution_id'];
				$contact = $row['Contact_id'];
                $operator = $row['Operator_id'];
				$date = $row['Date_time'];
				$description = $row['Description'];
				$type = $row['type_id'];
               
                $output .= '<fieldset>
    <legend>Ticket Info:</legend>
                            StatusID: '. $status .'
                              <p>ContactID   ' .$contact.'</p>
							  ' . $solution .'
								 <p>Date: ' . $date . '</p>
								<p>Description: '. $description. '</p>
								<p>TypeID: ' . $type. '</p>
                            </fieldset>';

            }
        }
    } else {
        header("location: ./");
    }
    print("$output");
    mysqli_close($conn);
 
?>
</body>
</html>
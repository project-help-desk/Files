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
            width: auto%;
            height: 850px;
            padding-top: 30px;
        }
    </style>
    <body>
        <?php include_once 'includes/header.php'; ?>
        <div class="container">
            <div class="table">
                <table>
                    <tr>
                        <td>Status </td>
                        <td> ID</td>
                    </tr>
                    <tr>
                        <td>Technical Problem </td>
                        <td> 1</td>
                    </tr>
                    <tr>
                        <td>Functional Problem </td>
                        <td> 2</td>
                    </tr>
                    <tr>
                        <td>Failure </td>
                        <td> 3</td>
                    </tr>
                    <tr>
                        <td>Question </td>
                        <td> 4</td>
                    </tr>
                    <tr>
                        <td>Wish </td>
                        <td> 5</td>
                    </tr>
                    <tr>
                        <td>Other </td>
                        <td> 6</td>
                    </tr>
                </table>

                <?php
                $conn = mysqli_connect("localhost", "root", "", "stenden_helpdesk");

                if (mysqli_connect_errno()) {
                    echo "Failed to connect: " . mysqli_connect_error();
                }

                error_reporting(0);

                $output = '';

                if (isset($_POST['query']) && $_POST['query'] !== ' ') {
                    $searchq = $_POST['query'];

                    $q = mysqli_query($conn, "SELECT * FROM incident WHERE Incident_id LIKE '%$searchq%' OR Status_id LIKE '%$searchq%' OR contact_id LIKE '%$searchq%' OR Operator_id LIKE '%$searchq%' OR Date_time LIKE '%$searchq%'  OR Description LIKE '%$searchq%' OR type_id LIKE '%$searchq%'") or die(mysqli_error());

                    $c = mysqli_num_rows($q);
                    if ($c == 0) {
                        $output = 'No search results for <b>"' . $searchq . '"</b>';
                    } else {
                        while ($row = mysqli_fetch_array($q)) {
                            $incidentid = $row['Incident_id'];
                            $status = $row['Status_id'];
                            $contact = $row['Contact_id'];
                            $operator = $row['Operator_id'];
                            $date = $row['Date_time'];
                            $description = $row['Description'];
                            $type = $row['type_id'];

                            $output .= '<fieldset>
    <legend>Ticket Info:</legend>
                            StatusID: ' . $status . '
                              <p>ContactID   ' . $contact . '</p>
							  ' . $solution . '
								 <p>Date: ' . $date . '</p>
								<p>Description: ' . $description . '</p>
								<p>TypeID: ' . $type . '</p>
                            </fieldset>';
                        }
                    }
                } else {
                    header("location: ./");
                }
                print("$output");
                mysqli_close($conn);
                ?>
            </div>
        </div>
        <div class="footer">
<?php include_once 'includes/footer.php'; ?>
        </div>
    </body>
</html>

<?php

$conn = mysqli_connect("localhost", "root", "", "stenden_helpdesk");
if (!$conn) {
    echo "Connection to the server  not established";
}

if (isset($_POST["submitAcc"]) || isset($_POST["submitComp"])) {
    $firstname = htmlentities($_POST["firstname"]);
    $lastname = htmlentities($_POST["lastname"]);
    $username = htmlentities($_POST["username"]);
    $password = htmlentities($_POST["password"]);
    $password_new = password_hash($password, PASSWORD_BCRYPT);
    $email = htmlentities($_POST["email"]);
    $phone = htmlentities($_POST["phone"]);
    $phone_len = strlen($phone);
     if (!filter_var($email,FILTER_VALIDATE_EMAIL) && (preg_match('#[0-9]#', $username)) && (($phone_len > 15) || (!is_numeric($phone))) ) 
     {
        $emailError = "Please enter an appropriate mail and ";
        $emailError .= "a valid name,userid should not contain number.";
        $emailError .= "Enter a valid phone number as well";
     } 
     else if (!filter_var($email,FILTER_VALIDATE_EMAIL) && (preg_match('#[0-9]#', $username)))
     {
         $emailError = "Please enter an appropriate mail and ";
         $emailError .= "a valid name,userid should not contain number.";
     }
      else if (!filter_var($email,FILTER_VALIDATE_EMAIL) && (($phone_len > 15) || (!is_numeric($phone))) )
     {
         $emailError = "Please enter an appropriate mail and ";
         $emailError .= "Enter a valid phone number as well";
     }
      else if ((preg_match('#[0-9]#', $username)) && (($phone_len > 15) || (!is_numeric($phone))) )
     {
         $emailError = "Enter aa valid nameshould not contain number";
         $emailError .= "Enter a valid phone number as well";
     }
     else if (($phone_len > 15) || (!is_numeric($phone)) )
     {
         $telError = "Enter a valid phone number";
     }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Please enter an appropriate mail  ";
    } else if (preg_match('#[0-9]#', $username)) {
        $nameError = "Invalid name, username should not contain number.";
    } else if (strpos($username, '$') == TRUE) {
        $nameError = "Invalid name, username should not contain a dollar sign.";
    } else {
        if (isset($_POST["submitAcc"])) {
            $licence = htmlentities($_POST["licence"]);
            //Getting the company name assosiated with the licence
            $QueryGetCompany = "SELECT customer.company_name, customer.company_id FROM customer JOIN licence ON customer.company_id=licence.company_id WHERE licence.licence_code = ?";
            if ($stmt = mysqli_prepare($conn, $QueryGetCompany)) {
                mysqli_stmt_bind_param($stmt, "s", $licence);
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_bind_result($stmt, $company_name, $company_id);
                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $company = $company_name;
                    } else {
                        echo "No company with this licence code registered";
                    }
                } else {
                    echo "Error checking database " . mysqli_error($conn);
                }
            }
        } else {
            //Registering a new company
            $company = htmlentities($_POST["company"]);
            $perm_level = 0;
            //Checking if licence is available and correct
            if (isset($_POST['licence'])) {
                echo "licence is set ";
                $licence = htmlentities($_POST["licence"]);
                $QueryCheckLicence = "SELECT licence_code FROM licence WHERE licence_code = ? AND company_id = 0";
                if ($stmt = mysqli_prepare($conn, $QueryCheckLicence)) {
                    mysqli_stmt_bind_param($stmt, "s", $licence);
                    if (mysqli_stmt_execute($stmt)) {
                        mysqli_stmt_bind_result($stmt, $licence_code);
                        mysqli_stmt_store_result($stmt);
                        if (mysqli_stmt_num_rows($stmt) !== 1) {
                            echo "Licence is incorrect or already used ";
                        } else {
                            $perm_level = 1;
                        }
                    } else {
                        echo "Error checking database " . mysqli_error($conn);
                    }
                } else {
                    echo "Error preparing query " . mysqli_error($conn);
                }
            }
            //Inserting data into customer database
            $QueryNewCustomer = "INSERT INTO customer VALUES(NULL, ?, ?)";
            if ($stmt = mysqli_prepare($conn, $QueryNewCustomer)) {
                mysqli_stmt_bind_param($stmt, "ss", $company, $perm_level);
                if (mysqli_stmt_execute($stmt)) {
                    //Inserting company id into licence table when licence is available
                    if ($perm_level == 1) {
                        echo "starting licence updating ";
                        $QueryRegisterLicence = "UPDATE licence SET company_id = (SELECT company_id FROM customer WHERE company_name = ?)
                     WHERE licence_code = ? AND company_id = 0";
                        if ($stmt = mysqli_prepare($conn, $QueryRegisterLicence)) {
                            echo "preparing licence updating";
                            mysqli_stmt_bind_param($stmt, "ss", $company, $licence);
                            if (mysqli_stmt_execute($stmt)) {
                                echo "executing licence updating ";
                                echo "Company succesfully registered";
                            } else {
                                echo "Error registering company " . mysqli_error($conn);
                            }
                        } else {
                            echo "Error registering company " . mysqli_error($conn);
                        }
                    }
                } else {
                    echo "Error executing query " . mysqli_error($conn);
                }
            } else {
                echo "Error preparing query " . mysqli_error($conn);
            }
        }
        $db_insert = "INSERT INTO contact VALUES(
        NULL, (SELECT company_id FROM customer WHERE company_name = ?), ?, ?, ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($conn, $db_insert)) {
            //check for both invalid email and username with numbers

            mysqli_stmt_bind_param($stmt, "sssssss", $company, $firstname, $lastname, $phone, $email, $username, $password_new);
            if (mysqli_stmt_execute($stmt)) {
                $queryLogin = "SELECT contact.contact_id, customer.perm_level FROM contact JOIN customer ON contact.company_id = customer.company_id WHERE contact.username = ?";
                if ($stmt = mysqli_prepare($conn, $queryLogin)) {
                    mysqli_stmt_bind_param($stmt, "s", $username);
                    if (mysqli_stmt_execute($stmt)) {
                        mysqli_stmt_bind_result($stmt, $contact_id, $perm_level);
                        mysqli_stmt_store_result($stmt);
                        echo "<h2 style=text-align:center;>Account successfully created!</h2>
                        <p style=text-align:center;>Redirecting to the login page...</p>";
                        $_SESSION["valid_id"] = $contact_id;
                        $_SESSION["valid_name"] = $username;
                        $_SESSION["perm_level"] = $perm_level;
                         header("Refresh: 7; URL=login.php");
                    }
                }
            } else {
                echo " Unable to create account " . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        }
    }
}


mysqli_close($conn);
?>


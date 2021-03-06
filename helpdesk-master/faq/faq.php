

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
     <?php ?>
<header>
    <div class="container clearfix">
        <div class="logo">
            <a href="../index.php">
                <img src="img/logo1.png" class="logo-pic" alt="Stenden SupportDesk logo">
            </a>
        </div>
        <div class="menu-btn not-active"><span></span>
        </div>
        <ul class="menu">
            <li><a href="faq.php">Faq</a>
            </li>
            <li><a href="#">buy a license</a>
            </li>
            <li>
<?php
if (isset($_SESSION["valid_id"])) {
    if ($_SESSION["perm_level"] == 0 || $_SESSION["perm_level"] == 1) {
        echo'<a href="../UserTickets.php">My Tickets</a>';
    } else {
        echo'<a href="../ticket_overview.php">Ticket Overview</a>';
    }
} else {
    echo'<a href="../login.php">Login</a>';
}
?>
            </li>
            <li>
                <?php
                if (isset($_SESSION["valid_id"]) && isset($_SESSION["valid_name"])) {
                    echo'<a href="../logout.php">Logout</a>';
                } else {
                    echo'<a href="../signup.php">Sign up</a>';
                }
                ?>
            </li>
            <li>
                <?php
                if (isset($_SESSION["valid_id"])) {
                    if ($_SESSION['perm_level'] < 2) {
                        echo"<a href=EditAccount.php?id=".$_SESSION['valid_id'].">Edit account details</a>";
                    }
                }
                ?>
            <li>
        </ul>
    </div>
</header>
    <div class="container">
        <div class="quest clearfix">
        <div class="box ">
            <h2>Frequently asked Questions</h2>
            <ul>
                <h4>Cannot save a file in the current directory</h4>
                <li >You should first check if the file is being saved in the software installaiton diectory. Otherwise, set it like this and restart the system.</li>
                <h4>The software crashes and freezes the computer</h4>
                <li >If this error occures multiple times and does not go away even after restarting the system and the computer, reinstall the programme.</li>
                <h4>I've got an error stating that the connection to the server failed.</h4>
                <li>We suggest you to check your connection again or try to use a wired connection in case you are using Wi-Fi. If the problem still does not dissapear, you should contact your ISP and ask for support.</li>
                <h4>How do I automatically assign tickets to technicians?</h4>
                <li>With Technician Auto Assign, you can allocate tickets to the technicians automatically. The Technician Auto Assign follows a Round Robin Method or Load Balancing Technique to assign technicians based on their availability. If the technician is not available on the due by date of the request, he will not be assigned to that request. 
Technician Auto Assign is executed after the SLA is applied to the request. If the site is specified for a request, then the technicians associated to that site alone are considered. Similarly, if group is specified in a request, the technicians associated to the group are taken into account. </li>
                <h4>How do I convert the database from MYSQL to MSSQL?</h4>
                <li>The following is the procedure to migrate your ServiceDesk Plus database from MYSQL to MSSQL.
Step 1: Stop ManageEngine ServiceDesk Plus service.
Step 2: Take a backup of the existing data and configuration under MYSQL database.
From command prompt, go to [ServiceDesk Plus-Home]\bin directory and execute backUpData.bat command to start the data backup.
cmd> [ServiceDesk Plus Home]\bin
cmd> backUpData.bat
where, ServiceDesk Plus Home -> C:\ManageEngine\ServiceDesk. This backup will be stored under the Backup folder in ServiceDesk Plus Home directory.
Step 3: Invoke ChangeDBServer.bat under [Service Desk-Home]\bin folder. [  Screenshot ]
Step 4: Provide the details of the SQL server (i.e.) Host name, username and password and click Test, By doing this, we will be able to check the connectivity with the SQL server. The message should say connection established as displayed above. Then click Save.
Step 5: Start and stop the ServiceDesk Plus server once.
NOTE: A database called ServiceDesk would be created in the SQL server.
Step 6: Now invoke restoreData.bat under [Service Desk-Home]\bin folder. The data should now be restored under your MSSQL server instance. Follow the on screen instructions to restore the latest backup data performed in step 2. [  Screenshot ] 
Step 7: Start ManageEngine ServiceDesk Plus service once the restore process is complete. 
</li>

            </ul>
        </div>
        </div>
    </div>











     <footer>
        <div class="container">
            <p>© 2019 February and Septemper groups</p>
        </div>
    </footer>
</body>

</html>
<?php

if (isset($_SESSION['loggedIn'])) {
    if ($_SESSION['loggedIn'] == 0) {
        echo'<p>Using the ticket system requires a valid maintence licence. '
        . 'A licence can be bought at <a href="licencestore.php">the licence store</a>'
        . ' or you can visit <a href="FAQ.php">the FAQ page</a></p>';
    } else {
        //Users without licence
        switch ($_SESSION['loggedIn']) {
            //Licenced customers
            case 1:
                echo'
                    <ul class="sidemenu">
                    <li><a href="MyTickets.php">My tickets</a></li>
                    <li><a href="input_ticket.php">Submit ticket</a></li>
                    </ul>
                ';
                break;
            //Operators & administrators
            case 2 || 3:
                echo'
                    <ul class="sidemenu">
                    <li><a href="Overview.php">Overview</a></li>
                    <li><a href="input_ticket.php">Submit ticket</a></li>
                    </ul>
                ';
                break;
        }
    }
} else {
    echo'<p>You need to log in to use the ticket system. <a href="login.php">Login here</a></p>';
}
?>
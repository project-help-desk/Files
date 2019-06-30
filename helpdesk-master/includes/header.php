<header>
    <div class="container clearfix">
        <div class="logo">
            <a href="index.php">
                <img src="img/logo1.png" class="logo-pic" alt="Stenden SupportDesk logo">
            </a>
        </div>
        <div class="menu-btn not-active"><span></span>
        </div>
        <ul class="menu">
            <li><a href="#">Faq</a>
            </li>
            <li><a href="#">buy a license</a>
            </li>
            <li>
                <?php
                if(isset($_SESSION['loggedIn'])){
                    if($_SESSION['loggedIn'] ==0 || $_SESSION['loggedIn'] == 1){
                        echo'<a href="UserTickets.php">My Tickets</a>';
                    } else {
                        echo'<a href="ticket_overview.php">Ticket Overview</a>';
                    }
                    
                } else {
                    echo'<a href="login.php">Login</a>';
                }
                ?>
            </li>
            <li>
                <?php
                if(isset($_SESSION['loggedIn'])){
                    echo'<a href="logout.php">Logout</a>';
                } else {
                    echo'<a href="signup.php">Sign up</a>';
                }
                ?>
            </li>
            <li>
                <?php
                if(isset($_SESSION['loggedIn'])){
                    echo'<a href="EditAccount.php">Edit account details</a>';
                }
                ?>
            <li>
        </ul>
    </div>
</header>
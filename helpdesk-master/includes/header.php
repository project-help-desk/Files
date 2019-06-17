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
                    echo'<a href="dashboard.php">Dashboard</a>';
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
                    echo'<a href="EditAccount.php">Edit account detials</a>';
                }
                ?>
            <li>
        </ul>
    </div>
</header>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li><a href="FirstPage">Recipes</a></li>
            <li><a href="Calendar">Calendar</a></li>
            <?php
            if(!empty($username)) {
                echo '<li><a href="SignOut">Sign out</a></li>';
            } else {
                echo '<li><a href="RegisterForm">Register</a></li>';
                echo '<li><a href="SignInForm">Sign in</a></li>';
            }
            ?>
        </ul>
    </div>
</nav>

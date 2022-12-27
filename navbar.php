<nav class="navbar navbar-inverse">
    <div class="container-fluid">

        <div class="navbar-header">
            <a class="navbar-brand" href="index.php"> Dashboard</a>
        </div>

        <ul class="nav navbar-nav">
            <?php if($user!=0): ?>
                <li><a href="#"><?php echo 'Permission : ', $user['permission']; ?></a></li>
            <?php endif ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <?php if($user!=0):

                $user_id = $user['id'];
                $user_name = $user['username'];
                $user_email = $user['email'];
                $user_pass = $user['password'];

            ?>
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php echo " " . $user['username']; ?> </a></li>
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span>  Logout</a></li>
            <?php endif ?>
        </ul>
    </div>
</nav>

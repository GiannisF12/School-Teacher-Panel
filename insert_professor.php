<?php 
    session_start();
    include 'functions.php';
    $user = login($conn);

    if (!isset($_SESSION['id'])) 
    {
        header("Location: login.php");
    }

    if($user['permission'] != 'Admin')
    {
        header("Location: logout.php");
    }


    function insert_user() 
{
    global $conn;

    if(isset($_POST['insert_user']))
    {
        $user_name = $_POST['username'];
        $user_email = $_POST['email'];
        $user_pass = md5($_POST['password']);
        $user_access = $_POST['permission'];
                
        $insert_user = "insert into users (username,email,password,permission) values ('$user_name','$user_email','$user_pass','$user_access')";
        $run_user = mysqli_query($conn,$insert_user);
        if($run_user)
        {
            echo "<script>alert('New User has been inserted sucessfully')</script>";
            echo "<script>window.open('view_professors.php','_self')</script>";
        }
                
    }
}
    

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Insert Professor</title>
        <?php include 'header.php'; ?>
    </head>

    <body>
        <div>
            <?php
                include 'navbar.php';
                include 'sidebar.php'; 
            ?>
        </div>
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-dashboard"></i> Dashboard / Insert Professor
                        </li>
                    </ol>
                </div>
            </div>
                
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-money fa-fw"></i> Insert Professor
                            </h3>
                        </div>
                    
                        <div class="panel-body">
                            <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Username </label> 
                                    <div class="col-md-6">
                                        <input name="username" type="text" class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> E-mail </label> 
                                    <div class="col-md-6">
                                        <input name="email" type="text" class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Password </label> 
                                    <div class="col-md-6">
                                        <input name="password" type="password" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Permission </label> 
                                    <div class="col-md-6">
                                        <select name="permission" class="form-control">
                                            <option value="Professor">Professor</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label> 
                                    <div class="col-md-6">
                                        <input name="insert_user" value="Insert User" type="submit" class="btn btn-primary form-control">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php insert_user(); ?>
        </div>
    </body>
</html>
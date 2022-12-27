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

    if(isset($_GET['edit_user']))
    {
        
        $edit_user2 = $_GET['edit_user'];
        $get_user2 = "select * from users where users.id=$edit_user2";
        $run_user2 = mysqli_query($conn,$get_user2);
        $row_user2 = mysqli_fetch_array($run_user2);
        
        $user_id2 = $row_user2['id'];
        $user_name2 = $row_user2['username'];
        $user_pass2 = $row_user2['password'];
        $user_email2 = $row_user2['email'];
        $user_access2 = $row_user2['permission'];
        
    }
    

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Professor</title>
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
                            <i class="fa fa-dashboard"></i> Dashboard / Edit Professor
                        </li>
                    </ol>
                </div>
            </div>
                
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-money fa-fw"></i> Edit Professor
                            </h3>
                        </div>
                    
                        <div class="panel-body">
                            <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Username </label> 
                                    <div class="col-md-6">
                                        <input value="<?php echo $user_name2; ?>" name="username" type="text" class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> E-mail </label> 
                                    <div class="col-md-6">
                                        <input value="<?php echo $user_email2; ?>"  name="email" type="text" class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Password </label> 
                                    <div class="col-md-6">
                                        <input value="<?php echo $user_pass2; ?>"  name="password" type="password" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Permission </label> 
                                    <div class="col-md-6">
                                        <select value="<?php echo $user_access2; ?>"  name="permission" class="form-control">
                                            <option value="Professor">Professor</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label> 
                                    <div class="col-md-6">
                                        <input name="update" value="Update User" type="submit" class="btn btn-primary form-control">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php 

            if(isset($_POST['update']))
            {
                $user_name2 = $_POST['username'];
                $user_email2 = $_POST['email'];
                if($user_pass2 != $_POST['password'])
                {
                    $user_pass2 = md5($_POST['password']);
                }
                else
                {
                    $user_pass2 = $_POST['password'];
                }
                $user_access2 = $_POST['permission'];
                
                $update_user = "update users set username='$user_name2',email='$user_email2',password='$user_pass2',permission='$user_access2' where id='$user_id2'";
                $run_user = mysqli_query($conn,$update_user);
                if($run_user)
                {
                    echo "<script>alert('User has been updated sucessfully')</script>";
                    echo "<script>window.open('view_professors.php','_self')</script>";
                }
                
            }
            ?>
        </div>
    </body>
</html>
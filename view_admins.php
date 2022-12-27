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

    //delete user

    if(isset($_GET['delete_user']))
    {
        $delete_user_id = $_GET['delete_user'];
        $delete_user = "delete from users where id='$delete_user_id'";
        $run_delete = mysqli_query($conn,$delete_user);
        if($run_delete){
            echo "<script>alert('User has been Deleted')</script>";
            echo "<script>window.open('view_admins.php','_self')</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin List</title>
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
                            <i class="fa fa-dashboard"></i> Dashboard / View Admins
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-tags"></i>  View Admins
                            </h3>
                        </div>
                        
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th> ID: </th>
                                            <th> User Name: </th>
                                            <th> User Email: </th>
                                            <th> User Password: </th>
                                            <th> User Permission: </th>
                                            <th> Edit: </th>
                                            <th> Delete: </th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        
                                        <?php 
                                            $get_users = "SELECT * from users where users.permission = 'Admin'";
                                            $run_users = mysqli_query($conn,$get_users);

                                            while($row_users=mysqli_fetch_array($run_users))
                                            {
                                                $user_id2 = $row_users['id'];
                                                $user_name2 = $row_users['username'];
                                                $user_email2 = $row_users['email'];
                                                $user_pass2 = $row_users['password'];
                                                $user_access2 = $row_users['permission'];
                                        ?>
                                        
                                            <tr>
                                                <td> <?php echo $user_id2 ?> </td>
                                                <td> <?php echo $user_name2; ?> </td>
                                                <td> <?php echo $user_email2; ?> </td>
                                                <td> <?php echo $user_pass2; ?></td>
                                                <td> <?php echo $user_access2; ?> </td>
                                                <td>    
                                                    <a href="edit_admin.php?edit_user=<?php echo $user_id2; ?>">
                                                        <i class="fa fa-pencil"></i> Edit
                                                    </a> 
                                                </td>
                                                <td> 
                                                    <a href="view_admins.php?delete_user=<?php echo $user_id2; ?>">
                                                        <i class="fa fa-trash-o"></i> Delete
                                                    </a> 
                                                </td>
                                            </tr>
                                        
                                        <?php } ?>
                                        
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

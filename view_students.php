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
        $delete_user = "delete from students where student_id='$delete_user_id'";
        $run_delete = mysqli_query($conn,$delete_user);
        if($run_delete){
            echo "<script>alert('User has been Deleted')</script>";
            echo "<script>window.open('view_students.php','_self')</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Student List</title>
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
                            <i class="fa fa-dashboard"></i> Dashboard / View Students
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-tags"></i>  View Students
                            </h3>
                        </div>
                        
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th> ID: </th>
                                            <th> User Name: </th>
                                            <?php if($user['permission'] == 'Admin'): ?>
                                                <th> User Email: </th>
                                                <th> User Password: </th>
                                                <th> User Permission: </th>
                                                <th> Add Lesson: </th>
                                                <th> Edit: </th>
                                                <th> Delete: </th>
                                            <?php endif ?>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        
                                        <?php 
                                            $get_users = "SELECT * from students";
                                            $run_users = mysqli_query($conn,$get_users);

                                            while($row_users=mysqli_fetch_array($run_users))
                                            {
                                                $user_id = $row_users['student_id'];
                                                $user_name = $row_users['student_name'];
                                                $user_email = $row_users['student_email'];
                                                $user_pass = $row_users['student_password'];
                                                $user_access = $row_users['student_permission']
                                        ?>
                                        
                                            <tr>
                                                <td> <?php echo $user_id; ?> </td>
                                                <td> <?php echo $user_name; ?> </td>
                                                

                                                <?php if($user['permission'] == 'Admin'): ?>

                                                    <td> <?php echo $user_email; ?> </td>
                                                    <td> <?php echo $user_pass; ?></td>
                                                    <td> <?php echo $user_access; ?> </td>

                                                    <td>    
                                                        <a href="add_lesson.php?edit_user=<?php echo $user_id; ?>">
                                                            <i class="fa fa-pencil"></i> Add
                                                        </a> 
                                                    </td>

                                                    <td>    
                                                        <a href="edit_student.php?edit_user=<?php echo $user_id; ?>">
                                                            <i class="fa fa-pencil"></i> Edit
                                                        </a> 
                                                    </td>
                                                     <td> 
                                                        <a href="view_students.php?delete_user=<?php echo $user_id; ?>">
                                                            <i class="fa fa-trash-o"></i> Delete
                                                        </a> 
                                                    </td>

                                                <?php endif ?>

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

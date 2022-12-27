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

    if(isset($_GET['edit_lesson']))
    {
        
        $edit_lesson = $_GET['edit_lesson'];
        $get_lesson = "select * from lessons where lesson_id='$edit_lesson'";
        $run_lesson = mysqli_query($conn,$get_lesson);
        $row_lesson = mysqli_fetch_array($run_lesson);
        
        $lesson_id = $row_lesson['lesson_id'];
        $lesson_name = $row_lesson['lesson_name'];
    }
    

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit User</title>
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
                            <i class="fa fa-dashboard"></i> Dashboard / Edit Lesson
                        </li>
                    </ol>
                </div>
            </div>
                
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-money fa-fw"></i> Edit Lesson
                            </h3>
                        </div>
                    
                        <div class="panel-body">
                            <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Lesson Name </label> 
                                    <div class="col-md-6">
                                        <input value="<?php echo $lesson_name; ?>" name="lesson_name" type="text" class="form-control" required>
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label> 
                                    <div class="col-md-6">
                                        <input name="update" value="Edit" type="submit" class="btn btn-primary form-control">
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
                $lesson_name = $_POST['lesson_name'];

                
                $update_lesson = "update lessons set lesson_name='$lesson_name' where lesson_id='$lesson_id'";
                $run_lesson = mysqli_query($conn,$update_lesson);
                if($run_lesson)
                {
                    echo "<script>alert('User has been updated sucessfully')</script>";
                    echo "<script>window.open('view_lessons.php','_self')</script>";
                }
                
            }
            ?>
        </div>
    </body>
</html>
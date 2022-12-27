<?php 
    session_start();
    include 'functions.php';
    $user = login($conn);

    if (!isset($_SESSION['id'])) 
    {
        header("Location: login.php");
    }

    if(($user['permission'] != 'Admin') && ($user['permission'] != 'Professor'))
    {
        header("Location: logout.php");
    }

    if(isset($_GET['see_student']))
    {
        
        $edit_lesson = $_GET['see_student'];
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
        <title>See Students</title>
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
                            <i class="fa fa-dashboard"></i> Dashboard / See Students
                        </li>
                    </ol>
                </div>
            </div>
                
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                Student List of Lesson: <b><?php echo $lesson_name ?> </b>
                            </h3>
                        </div>
                    
                        <div class="panel-body">
                            <ul class="list-group">
                                    <?php  
                                        $get_student = "SELECT * from student_lesson where lesson_id = $lesson_id ";
                                        $run_student = mysqli_query($conn,$get_student);
                                        while($row_student=mysqli_fetch_array($run_student))
                                        {
                                            $student_id = $row_student['student_id'];

                                            $get_student2 = "SELECT * from students where student_id = $student_id ";
                                            $run_student2 = mysqli_query($conn,$get_student2);
                                            while($row_student2=mysqli_fetch_array($run_student2))
                                            {
                                                $student_name = $row_student2['student_name'];

                                    ?>
                                                <li class="list-group-item"><?php echo $student_name; ?></li>

                                    <?php } } ?>
                            </ul>
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
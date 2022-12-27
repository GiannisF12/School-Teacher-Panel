<?php 
    session_start();
    include 'functions.php';
    $user = login($conn);
    $user_id = $user['id'];

    if (!isset($_SESSION['id'])) 
    {
        header("Location: login.php");
    }

    if(($user['permission'] != 'Admin') && ($user['permission'] != 'Professor'))
    {
        header("Location: logout.php");
    }

    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Register To Lesson</title>
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
                            <i class="fa fa-dashboard"></i> Dashboard / Register Lesson
                        </li>
                    </ol>
                </div>
            </div>
                
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-money fa-fw"></i> Register To Lesson
                            </h3>
                        </div>
                    
                        <div class="panel-body">
                            <form method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group">
                                    <label class="col-md-3 control-label"> Lesson </label> 
                                    <div class="col-md-6">
                                    <select name="lesson_id" class="form-control">
                                        <?php 
                                            $get_lesson = "select * from lessons";
                                            $run_lesson = mysqli_query($conn,$get_lesson);
                                            while($row_lesson=mysqli_fetch_array($run_lesson))
                                            {
                                                $lesson_id = $row_lesson['lesson_id'];
                                                $result = mysqli_query($conn,"SELECT COUNT(id) as n from professor_lesson where professor_lesson.professor_id = $user_id and professor_lesson.lesson_id = $lesson_id ");
                                                $row_result = mysqli_fetch_array($result);
                                                if($row_result['n'] <= 0 )
                                                {

                                                
                                            ?>
                                        <option value="<?php echo $row_lesson['lesson_id'] ?>"><?php echo $row_lesson['lesson_name'] ?></option>
                                        <?php } } ?>
                                </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label> 
                                    <div class="col-md-6">
                                        <input name="update" value="Register to  Lesson" type="submit" class="btn btn-primary form-control">
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
                $lesson_id = $_POST['lesson_id'];
                
                $update_user = "INSERT into professor_lesson (professor_id,lesson_id) values ($user_id,$lesson_id)";
                $run_user = mysqli_query($conn,$update_user);
                if($run_user)
                {
                    echo "<script>alert('User has been updated sucessfully')</script>";
                    echo "<script>window.open('view_my_lessons.php','_self')</script>";
                }
                
            }
            ?>
        </div>
    </body>
</html>
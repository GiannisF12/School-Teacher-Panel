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
    
    function insert_lesson() 
{
    global $conn;

    if(isset($_POST['insert_lesson']))
    {
        $lesson_name = $_POST['lesson_name'];
        $insert_lesson = "insert into lessons (lesson_name) values ('$lesson_name')";
        $run_lesson = mysqli_query($conn,$insert_lesson);
        if($run_lesson)
        {
            echo "<script>alert('New Lesson Has Been Inserted')</script>";
            echo "<script>window.open('view_lessons.php','_self')</script>";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Insert Lesson</title>
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
                        <li>
                            <i class="fa fa-dashboard"></i> Dashboard / Insert Lesson
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-money fa-fw"></i> Insert Lesson
                            </h3>
                        </div>
                        
                        <div class="panel-body">
                            <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="" class="control-label col-md-3">Lesson Name </label>
                                    <div class="col-md-6">
                                        <input name="lesson_name" type="text" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="" class="control-label col-md-3"></label>
                                    <div class="col-md-6">
                                        <input name="insert_lesson" value="Insert" type="submit" class="form-control btn btn-primary">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php insert_lesson(); ?>
            
        </div>
    </body>
</html>

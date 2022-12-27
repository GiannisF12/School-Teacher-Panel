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

    if(isset($_GET['delete_lesson']))
    {
                    
        $delete_lesson_id = $_GET['delete_lesson'];

        $delete_lesson = "delete from lessons where lesson_id='$delete_lesson_id'";
        
        $run_delete = mysqli_query($conn,$delete_lesson);
        
        if($run_delete)
        {
            
            echo "<script>alert('Lesson has been Deleted')</script>";
            
            echo "<script>window.open('view_lessons.php','_self')</script>";
            
        }
    }



?>
<html>
    <head>
        <title>Lessons List</title>
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
                            <i class="fa fa-dashboard"></i> Dashboard / View Lessons
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-tags fa-fw"></i> View Lessons
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th> Lesson ID </th>
                                            <th> Lesson Name </th>
                                            <th> Edit Lesson </th>
                                            <th> Delete Lesson </th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        
                                        <?php 
                                            $i=0;
                                            $get_lesson = "select * from lessons";
                                            $run_lesson = mysqli_query($conn,$get_lesson);
                                            while($row_lesson=mysqli_fetch_array($run_lesson))
                                            {
                                                $lesson_id = $row_lesson['lesson_id'];
                                                $lesson_name = $row_lesson['lesson_name'];
                                        ?>
                                        
                                            <tr>
                                                <td> <?php echo $lesson_id; ?> </td>
                                                <td> <?php echo $lesson_name; ?> </td>
                                                <td> 
                                                    <a href="edit_lesson.php?edit_lesson= <?php echo $lesson_id; ?> ">
                                                        <i class="fa fa-pencil"></i> Edit
                                                    </a>
                                                </td>
                                                <td> 
                                                    <a href="view_lessons.php?delete_lesson= <?php echo $lesson_id; ?> ">
                                                        <i class="fa fa-trash"></i> Delete
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

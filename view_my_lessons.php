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
                        <li class="active">
                            <i class="fa fa-dashboard"></i> Dashboard / View my Lessons
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
                                            <th> Lesson Name </th>
                                            <th> Registered Students </th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        
                                        <?php 
                                            $get_lesson = "SELECT * from professor_lesson";
                                            $run_lesson = mysqli_query($conn,$get_lesson);
                                            while($row_lesson=mysqli_fetch_array($run_lesson))
                                            {
                                                $professor_id = $row_lesson['professor_id'];
                                                $lesson_id = $row_lesson['lesson_id'];

                                                $get_lesson2 = "SELECT * from lessons where lesson_id = $lesson_id ";
                                                $run_lesson2 = mysqli_query($conn,$get_lesson2);
                                                while($row_lesson2=mysqli_fetch_array($run_lesson2))
                                                {
                                                    $lesson_name = $row_lesson2['lesson_name'];
                       

                                        ?>
                                        
                                                    <tr>
                                                        <td> <?php echo $lesson_name; ?> </td>
                                                        <td> 
                                                            <a href="see_students.php?see_student= <?php echo $lesson_id; ?> ">
                                                                <i class="fa fa-pencil"></i> See Students
                                                            </a>
                                                        </td>
                                                    </tr>
                                        
                                        <?php } } ?>
                                    
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

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


    $countAdmins;
    $queryCountAdmin = mysqli_query($conn,"SELECT COUNT(id) as total FROM users where users.permission = 'Admin' ");
    $CountAdminRes = mysqli_fetch_array($queryCountAdmin);
    $countAdmins = $CountAdminRes['total']; 
    
    $countProfessors;
    $queryCountProfessor = mysqli_query($conn,"SELECT COUNT(id) as total FROM users where users.permission = 'Professor' ");
    $CountProfessorRes = mysqli_fetch_array($queryCountProfessor);
    $countProfessors = $CountProfessorRes['total'];

    $countStudents;
    $queryCountStudent = mysqli_query($conn,"SELECT COUNT(student_id) as total FROM students ");
    $CountStudentRes = mysqli_fetch_array($queryCountStudent);
    $countStudents = $CountStudentRes['total'];
    
    $countLessons;
    $queryCountLesson = mysqli_query($conn,"SELECT COUNT(lesson_id) as total FROM lessons");
    $CountLessonRes = mysqli_fetch_array($queryCountLesson);
    $countLessons = $CountLessonRes['total']; 
?> 

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin Panel</title>
        <?php include 'header.php'; ?>
    </head>
    <body>

        <?php
            include 'navbar.php';
            include 'sidebar.php'; 
        ?>
        
        <div class="content">
            <div class="row">

                <?php if($user['permission'] == 'Admin'): ?>

                <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">

                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"> <?php echo $countAdmins; ?> </div>
                                        <div> Admins </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                </div>

                <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">

                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"> <?php echo $countProfessors; ?> </div>
                                        <div> Professors </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                </div>

                <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">

                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"> <?php echo $countStudents; ?> </div>
                                        <div> Students </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                </div>

                <div class="col-lg-3 col-md-6">
                        <div class="panel panel-orange">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"> <?php echo $countLessons; ?> </div>
                                        <div> Lessons </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <?php endif ?>

            </div>
        </div>
    </body>
</html>


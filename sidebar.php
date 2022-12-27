<?php

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



<?php if($user['permission'] == 'Admin'): ?>
    <ul class="nav navbar-nav side-nav">
        <li><a><center><b>Admin Section</b></center></a></li>
        <li>
            <a href="#" data-toggle="collapse" data-target="#admins">
                <i class="fa fa-fw fa-users"></i> Admins
                <i class="fa fa-fw fa-caret-down"></i>
            </a>
            <ul id="admins" class="collapse">
                <li>
                    <a href="insert_admin.php"> Insert Admin </a>
                </li>
                <li>
                    <a href="view_admins.php"> View Admins </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#" data-toggle="collapse" data-target="#professors">
                <i class="fa fa-fw fa-users"></i> Professors
                <i class="fa fa-fw fa-caret-down"></i>
            </a>
            <ul id="professors" class="collapse">
                <li>
                    <a href="insert_professor.php"> Insert Professor </a>
                </li>
                <li>
                    <a href="view_professors.php"> View Professor </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#" data-toggle="collapse" data-target="#a_students">
                <i class="fa fa-fw fa-users"></i> Students
                <i class="fa fa-fw fa-caret-down"></i>
            </a>
            <ul id="a_students" class="collapse">
                <li>
                    <a href="insert_student.php"> Insert Student </a>
                </li>
                <li>
                    <a href="view_students.php"> View Students </a>
                </li>
            </ul>
        </li>
        
        <li>
            <a href="#" data-toggle="collapse" data-target="#lesson">
                <i class="fa fa-fw fa-edit"></i> Lessons
                <i class="fa fa-fw fa-caret-down"></i>
            </a>
            <ul id="lesson" class="collapse">
                <li>
                    <a href="insert_lesson.php"> Insert Lesson </a>
                </li>
                <li>
                    <a href="view_lessons.php"> View Lessons </a>
                </li>
            </ul>
        </li>  
        
        <li>
            <a href="#" data-toggle="collapse" data-target="#admin_profile">
            <span class="glyphicon glyphicon-user"></span> Profile
                <i class="fa fa-fw fa-caret-down"></i>
            </a>
            <ul id="admin_profile" class="collapse">

                <li>
                    <a href="profile.php"> Edit Profile </a>
                </li>
            </ul>
        </li>


    </ul>
<?php elseif($user['permission'] == 'Professor'): ?>
    <ul class="nav navbar-nav side-nav">
        <li><a><center><b>Professor Section</b></center></a></li>
        <li>
            <a href="#" data-toggle="collapse" data-target="#p_lessons">
                <i class="fa fa-fw fa-users"></i> Lessons
                <i class="fa fa-fw fa-caret-down"></i>
            </a>
            <ul id="p_lessons" class="collapse">
                <li>
                    <a href="view_my_lessons.php"> View My Lessons </a>
                </li>
                
                <li>

                <?php 
                    $user_id = $user['id'];
                    $get_user2 = "SELECT * from users where users.permission = 'Professor' and users.id = $user_id";
                    $run_user2 = mysqli_query($conn,$get_user2);
                    while($row_user2 = mysqli_fetch_array($run_user2))
                    {
                        $user_id2 = $row_user2['id'];

                ?>

                    <a href="add_lesson_p.php"> Register to Lesson </a>
                </li>
                <?php } ?>


            </ul>
        </li>

        <li>
            <a href="#" data-toggle="collapse" data-target="#professor_profile">
                <i class="fa fa-fw fa-edit"></i> Profile
                <i class="fa fa-fw fa-caret-down"></i>
            </a>
            <ul id="professor_profile" class="collapse">

                <li>
                    <a href="profile.php"> Edit Profile </a>
                </li>
            </ul>
        </li>

    </ul>




<?php endif ?>


        
                
                                
        
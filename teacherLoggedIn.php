<?php
/**
 * Created by PhpStorm.
 * User: Don
 * Date: 5/1/2018
 * Time: 3:06 PM
 */
session_start();
if (isset($_GET['logout'])) {
    echo "entered here";
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}

if (isset($_POST['course_insert'])) {
    $db_connection = mysqli_connect('localhost', 'root', '', 'university_database');
// Check The Connection
    if (!$db_connection) {
        die("Connection Failed: " . mysqli_connect_error());
    }
    mysqli_select_db($db_connection, "crp");
    $course_code = $_POST['course_id'];
    $semester = 7;
    $room_number = $_POST['room'];
    $slot = $_POST['slot'];
    $cgpa_limit = $_POST['cgpa_limit'];
    $number_of_students = $_POST['no_of_students'];
    $username1 = $_SESSION['username'];

    $insert_q = "INSERT INTO course_offering(id, semester, room_number, slot,cpa_limit,number_of_students) 
VALUES ('$course_code',$semester,'$room_number','$slot',$cgpa_limit,$number_of_students);";
    $insert_q1 = "INSERT INTO teaches (id, courseid) values ($username1,'$course_code');";
//    $insert_q2 = "INSERT INTO enrolls (id, courseid) values ($course_code,'$course_code');";
    $results1 = mysqli_query($db_connection, $insert_q);
    if (!$results1) {
        printf("Error: %s\n", mysqli_error($db_connection));
        exit();
    }

    $results = mysqli_query($db_connection, $insert_q1);
    if (!$results) {
        printf("Error: %s\n", mysqli_error($db_connection));
        exit();
    }
    mysqli_close($db_connection);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome Teacher <?php
        echo $_SESSION['username'];
        ?></title>
    <script src="universal_js.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
<nav class="navbar navbar-inverse">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand">Moodle</a>
        </div>
        <!-- Collection of nav links and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">My Courses</a></li>
                <li><a href="facultyGradeEntry.php">Grade</a></li>
                <li><a href="#">Ticket</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="studentloggedIn.php?logout='1'" style="color: red;">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>


<div class="container">
    <h2>My Courses</h2>
    <table class="table table-striped">
        <caption class="title"></caption>
        <thead>
        <tr>
            <th>#</th>
            <th>Course Id</th>
            <th>No of students</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $username = $_SESSION['username'];

        $db_connection = mysqli_connect('localhost', 'root', '', 'university_database');
        // Check The Connection
        if (!$db_connection) {
            die("Connection Failed: " . mysqli_connect_error());
        }

        mysqli_select_db($db_connection, "crp");
        $sql1 = 'SELECT enrolls.courseid, count(enrolls.id) as numOfStudents
FROM teaches INNER JOIN enrolls ON teaches.courseid = enrolls.courseid
WHERE teaches.id = ' . $username . '/*PHP Session*/ GROUP BY enrolls.courseid;';
        $result = mysqli_query($db_connection, $sql1);
        $no = 1;
        $total = 0;

        while ($row = mysqli_fetch_row($result)) {

            echo '<tr>
					<td>' . $no . '</td>
					<td>' . $row[0] . '</td>
					<td>' . $row[1] . '</td>
				</tr>';
            $no++;
        } ?>
        <!--        <td><button class="btn btn-primary" id = ' . $no . ' onclick="viewFacultyCourses()">View</button></td>-->
        </tbody>
    </table>
</div>

<div class="container">
    <hr>
    <h2>Add A Course</h2>
    <form method="post" action="teacherLoggedIn.php">

        <div class="form-group">
            <label for="course_id">Course Id</label>
            <input type="text" class="form-control" id="course_id" name="course_id" placeholder="course">
        </div>

        <div class="form-group">
            <label for="slot">Course Slot</label>
            <input type="text" class="form-control" id="slot" name="slot" placeholder="slot">
        </div>

        <div class="form-group">
            <label for="room">Room</label>
            <input type="text" class="form-control" id="room" name="room" placeholder="credit">
        </div>

        <div class="form-group">
            <label for="cgpa_limit">CGPA limit</label>
            <input type="number" step="0.01" class="form-control" id="cgpa_limit" name="cgpa_limit"
                   placeholder="cgpa-limit">
        </div>

        <div class="form-group">
            <label for="no_of_students">Max no of Students</label>
            <input type="number" class="form-control" id="no_of_students" name="no_of_students"
                   placeholder="no of students">
        </div>

        <button type="submit" class="btn" name="course_insert">Submit</button>
    </form>
</div>

</body>
</html>

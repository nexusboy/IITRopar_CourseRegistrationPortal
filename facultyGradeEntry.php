<?php
/**
 * Created by PhpStorm.
 * User: merah
 * Date: 02-May-18
 * Time: 11:12 PM
 */
session_start();
if (isset($_GET['logout'])) {
    echo "entered here";
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}

if (isset($_POST['grade_entry'])) {
    $db_connection = mysqli_connect('localhost', 'root', '', 'university_database');
// Check The Connection
    if (!$db_connection) {
        die("Connection Failed: " . mysqli_connect_error());
    }
    mysqli_select_db($db_connection, "crp");

    $student_id = $_POST['student_id'];
    $cur_semester = 7;
    $course_id = $_POST['course_id'];
    $grade = $_POST['grade'];
    $credits = $_POST['credit'];

    $grade_i_q = "INSERT INTO grades(id, semester, courseid, grade,credits) 
VALUES ( $student_id , $cur_semester , '$course_id'  ,  $grade , $credits)";

    $results1 = mysqli_query($db_connection, $grade_i_q);
    if (!$results1) {
        printf("Error: %s\n", mysqli_error($db_connection));
        exit();
    } else {
        echo "inserted succesfully";
    }
    mysqli_close($db_connection);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome Teacher<?php
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
            <a href="#" class="navbar-brand">FACULTY</a>
        </div>
        <!-- Collection of nav links and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="teacherLoggedIn.php">My Courses</a></li>
                <li class="active"><a href="facultyGradeEntry.php">Grade</a></li>
                <li><a href="#">Ticket</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="studentloggedIn.php?logout='1'" style="color: red;">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h2>Grade a Student</h2>
    <form method="post" action="facultyGradeEntry.php">
        <div class="form-group">
            <label for="student_id">Student Id</label>
            <input type="text" class="form-control" id="student_id" name="student_id" placeholder="entry no">
        </div>

        <div class="form-group">
            <label for="course_id">Course Id</label>
            <input type="text" class="form-control" id="course_id" name="course_id" placeholder="course">
        </div>

        <div class="form-group">
            <label for="credit">Credit</label>
            <input type="number" class="form-control" id="credit" name="credit" placeholder="credit">
        </div>

        <div class="form-group">
            <label for="grade">Grade</label>
            <input type="number" class="form-control" id="grade" name="grade" placeholder="grade">
        </div>

        <button type="submit" class="btn" name="grade_entry">Submit</button>
    </form>
</div>

</body>
</html>
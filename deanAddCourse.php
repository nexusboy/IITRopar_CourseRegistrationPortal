<?php
/**
 * Created by PhpStorm.
 * User: merah
 * Date: 03-May-18
 * Time: 11:10 AM
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
    $ltp = $_POST['ltp'];
    $course_title = $_POST['course_title'];
    $course_description= $_POST['course_description'];
    $credits= $_POST['credits'];
    $category= $_POST['category'];
    $department= $_POST['department'];
    $semester = 7;
    $username1 = $_SESSION['username'];

    $insert_q = "INSERT INTO courses(id, ltp, title, description,credits,category,department) 
VALUES ('$course_code','$ltp','$course_title','$course_description',$credits,'$category','$department');";
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
            <a href="#" class="navbar-brand">DEAN</a>
        </div>
        <!-- Collection of nav links and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="deanLoggedIn.php">Ticket</a></li>
                <li class="active"><a href="#">Add Course</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="studentloggedIn.php?logout='1'" style="color: red;">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <hr>
    <h2>Add A Course</h2>
    <form method="post" action="deanAddCourse.php">

        <div class="form-group">
            <label for="course_id">Course Id</label>
            <input type="text" class="form-control" id="course_id" name="course_id" placeholder="course">
        </div>

        <div class="form-group">
            <label for="ltp">LTP</label>
            <input type="text" class="form-control" id="ltp" name="ltp" placeholder="ltp">
        </div>

        <div class="form-group">
            <label for="course_title">Course Title</label>
            <input type="text" class="form-control" id="course_title" name="course_title" placeholder="course title">
        </div>

        <div class="form-group">
            <label for="course_description">Course Description</label>
            <input type="text" class="form-control" id="course_description" name="course_description" placeholder="course description">
        </div>

        <div class="form-group">
            <label for="credits">Credits</label>
            <input type="number" class="form-control" id="credits" name="credits" placeholder="credits">
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" step="0.01" class="form-control" id="category" name="category"
                   placeholder="category">
        </div>

        <div class="form-group">
            <label for="department">Department</label>
            <input type="text" class="form-control" id="department" name="department"
                   placeholder="department">
        </div>

        <button type="submit" class="btn" name="course_insert">Submit</button>
    </form>
</div>

</body>
</html>

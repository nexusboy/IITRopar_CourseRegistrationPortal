<?php
/**
 * Created by PhpStorm.
 * User: merah
 * Date: 02-May-18
 * Time: 12:49 AM
 */
session_start();
if (isset($_GET['logout'])) {
    echo "entered here";
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}

if (isset($_GET['add_course'])) {
    $baby = $_GET['course_id'];
    echo $baby;
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Welcome Student <?php
        echo $_SESSION['username'];
        ?></title>
    <!--    <script src="https://code.jquery.com/jquery.min.js"></script>-->
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
                <li><a href="studentloggedIn.php">Courses</a></li>
                <li class="active"><a href="#">Course Registration</a></li>
                <li><a href="registrationRecord.php">Registration Record</a></li>
                <li><a href="#">Ticket</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="studentloggedIn.php?logout='1'" style="color: red;">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <button id="myButton" onclick="viewCourses()">View_Courses</button>
    <script src="universal_js.js"></script>
</div>


<div class="container">

    <h1>Courses offered this semester</h1>
    <table class="table table-striped" id="table">
        <caption class="title"></caption>
        <thead>
        <tr>
            <th>#</th>
            <th>Course Id</th>
            <th>Name</th>
            <th>Credits</th>
            <th>Slot</th>
            <th>LTP</th>

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
        $sql1 = 'SELECT course_offering.id,title,credits,slot,ltp FROM course_offering INNER JOIN courses ON courses.id=course_offering.id ;';
        $result = mysqli_query($db_connection, $sql1);
        $no = 1;
        $total = 0;


        while ($row = mysqli_fetch_row($result)) {

            $variable = '' . $row[0];

            echo '<tr id=' . $no . '>
					<td>' . $no . '</td>
					<td>' . $row[0] . '</td>
					<td>' . $row[1] . '</td>
					<td>' . $row[2] . '</td>
					<td>' . $row[3] . '</td>
					<td>' . $row[4] . '</td>

					<td><button class="btn btn-primary" id = ' . $no . ' onclick="addCourse(this)">Add</button></td>
				</tr>';

            $no++;
        } ?>
        </tbody>
    </table>
</div>

</body>
</html>

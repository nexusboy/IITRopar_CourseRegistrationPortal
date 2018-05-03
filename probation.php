<?php
/**
 * Created by PhpStorm.
 * User: merah
 * Date: 03-May-18
 * Time: 5:10 AM
 */

session_start();
if (isset($_GET['logout'])) {
    echo "entered here";
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
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
            <a href="#" class="navbar-brand">DEAN OFFICE</a>
        </div>
        <!-- Collection of nav links and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="staffofDeanPage.php">Transcript</a></li>
                <li class="active"><a href="#">Probation Students</a></li>
                <li><a href="deanAggregateGrades.php">Grades</a></li>
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
            <th>Student Id</th>
            <th>Name of students</th>
            <th>Department</th>
            <th>Year</th>
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
        $sql1 = 'select fee.id,name,department,year from (SELECT id
FROM (SELECT grades.id,sum(grade*grades.credits)/SUM(grades.credits) as gpa
FROM grades INNER JOIN courses ON grades.courseid = courses.id
GROUP BY grades.id) as foo
WHERE foo.gpa <=10 ) as fee INNER JOIN students ON fee.id = students.id;';
        $result = mysqli_query($db_connection, $sql1);
        $no = 1;
        $total = 0;

        while ($row = mysqli_fetch_row($result)) {

            echo '<tr>
					<td>' . $no . '</td>
					<td>' . $row[0] . '</td>
					<td>' . $row[1] . '</td>
					<td>' . $row[2] . '</td>
					<td>' . $row[3] . '</td>
				</tr>';
            $no++;
        } ?>
        </tbody>
    </table>
</div>
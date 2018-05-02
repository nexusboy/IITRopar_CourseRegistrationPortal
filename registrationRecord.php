<?php
/**
 * Created by PhpStorm.
 * User: merah
 * Date: 02-May-18
 * Time: 6:25 AM
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
    <title>Welcome Student <?php
        echo $_SESSION['username'];
        ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="universal_js.js"></script>
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
                <li><a href="courseRegistration.php">Course Registration</a></li>
                <li class="active"><a href="#">Registration Record</a></li>
                <li><a href="#">Ticket</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="studentloggedIn.php?logout='1'" style="color: red;">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">

    <h1>Registered Courses</h1>
    <table class="table table-striped" id="table">
        <caption class="title"></caption>
        <thead>
        <tr>
            <th>#</th>
            <th>Course Id</th>
            <th>Credits</th>
            <th>Name</th>
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
        $sql1 = 'SELECT courseid,credits,title
FROM (SELECT courseid FROM enrolls INNER JOIN course_offering ON enrolls.courseid=course_offering.id
WHERE enrolls.id=1) as lol INNER JOIN courses ON courseid=courses.id;';
        $result = mysqli_query($db_connection, $sql1);
        $no = 1;
        $credits = 0;

        while ($row = mysqli_fetch_row($result)) {

            echo '<tr>
					<td>' . $no . '</td>
					<td>' . $row[0] . '</td>
					<td>' . $row[1] . '</td>
					<td>' . $row[2] . '</td>

                    <td><button class="btn btn-danger" id = ' . $no . ' onclick="dropCourse(this)">Drop</button></td>
				</tr>';
            $no++;
            $credits = $credits + $row[1];
        } ?>
        </tbody>
        <tfoot>
        <tr>
            <th colspan="4">REGISTERED CREDITS : <?php echo number_format($credits) ?></th>
        </tr>
        </tfoot>
    </table>
</div>

</body>
</html>
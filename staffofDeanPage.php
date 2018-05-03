<?php
/**
 * Created by PhpStorm.
 * User: Don
 * Date: 5/2/2018
 * Time: 7:51 PM
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
            <a href="#" class="navbar-brand">Moodle</a>
        </div>
        <!-- Collection of nav links and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Transcript</a></li>
                <li><a href="#">Probation Students</a></li>
                <li><a href="#">Grades</a></li>
                <li><a href="#">Ticket</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="studentloggedIn.php?logout='1'" style="color: red;">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>


<div class="container">
    <h2>Student Transcript</h2>


    <div class="form-group">
        <label for="course_id">Course Id</label>
        <input type="text" class="form-control" id="course_id" placeholder="course id">
    </div>

    <table class="table table-striped" id="studentTranscriptTable">

    </table>
    <button class="btn btn-primary" onclick="studentTranscript()">Submit</button>


</div>

</body>
</html>

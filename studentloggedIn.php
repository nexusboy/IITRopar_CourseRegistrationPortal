<?php
/**
 * Created by PhpStorm.
 * User: Don
 * Date: 5/1/2018
 * Time: 1:37 PM
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
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<h1> Hello student </h1>

<body>
<?php if (isset($_SESSION['username'])) : ?>

<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
<p> <a href="studentloggedIn.php?logout='1'" style="color: red;">logout</a> </p>
<?php endif ?>

<button id = "myButton" onclick="viewCourses()">View_Courses</button>
<script>
    function viewCourses()
    {
        var OUT;
        $.ajax({
            type: "POST",
            url: "queryExecutor.php",
            data: { query : 'select * from courses'},
            success: function (OUTPUT) {
                alert(OUTPUT);
                OUT = OUTPUT;
            },
            complete:function(){
                document.getElementById("thisdiv").innerHTML = OUT;
                document.getElementById("thisdiv").style.background = "green";

            }
        });
    }
</script>
</body>
</html>

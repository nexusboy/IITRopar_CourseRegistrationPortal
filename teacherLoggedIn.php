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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome Student <?php
        echo $_SESSION['username'];
        ?></title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<h1> Hello teacher </h1>
<body>
<?php if (isset($_SESSION['username'])) : ?>
    <!--    -->
    <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    <p> <a href="teacherLoggedIn.php?logout='1'" style="color: red;">logout</a> </p>
<?php endif ?>


<form method = "POST" action=".php">
    First name:<br>
    <input type="text" name="firstname" value="Mickey">
    <br>
    Last name:<br>
    <input type="text" name="lastname" value="Mouse">
    <br><br>
    <input type="submit" value="Submit">
</form>
</body>>
</html>

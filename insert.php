<?php
/**
 * Created by PhpStorm.
 * User: merah
 * Date: 02-May-18
 * Time: 7:49 AM
 */

session_start();


$username = $_SESSION['username'];

$db_connection = mysqli_connect('localhost', 'root', '', 'university_database');
// Check The Connection
if (!$db_connection) {
    die("Connection Failed: " . mysqli_connect_error());
}

mysqli_select_db($db_connection, "crp");

$courseID=$_POST['course_id'];

echo "$courseID in ineret";

/*Write insert pending*/


// No courses should be in same slot



// No of credits + course_credits < credit_limit then insert

$query = 'INSERT INTO enrolls(id, courseid) VALUES (' .$username.','.$courseID.');';
mysqli_query($db_connection, $sql1);
?>
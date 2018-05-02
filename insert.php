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

$course_slot = $_POST['course_slot'];


$sql1= "SELECT * FROM (
SELECT slot
FROM (SELECT courseid FROM enrolls WHERE id = $username ) as loo INNER JOIN course_offering ON loo.courseid=course_offering.id) as loo
WHERE slot = '$course_slot' ";


$results = mysqli_query($db_connection,$sql1);
if (!$results) {
    printf("Error: %s\n", mysqli_error($db_connection));
    exit();
}

if ( mysqli_num_rows($results) == 0 ) {
   $q1 = "INSERT INTO enrolls (id, courseid) VALUES ( $username , '$courseID' )";
  $results1 = mysqli_query($db_connection,$q1);
    if (!$results1) {
        printf("Error: %s\n", mysqli_error($db_connection));
        exit();
    }
}
elseif(mysqli_num_rows($results) == 1){
    echo "Cannot add because the student has registered in same slot    ";
}
/*Write insert pending*/


// No courses should be in same slot



// No of credits + course_credits < credit_limit then insert
?>
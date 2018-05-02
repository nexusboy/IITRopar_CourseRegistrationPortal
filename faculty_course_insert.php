<?php
/**
 * Created by PhpStorm.
 * User: Don
 * Date: 5/2/2018
 * Time: 6:50 PM
 */

$db_connection = mysqli_connect('localhost', 'root', '', 'university_database');
// Check The Connection
if (!$db_connection)
{
    die("Connection Failed: " . mysqli_connect_error());
}
mysqli_select_db($db_connection, "crp");
$course_code = 'CSL356';
$semester = 7;
$room_number = 'H3';
$slot = 'B';
$cgpa_limit = 6;
$number_of_students = 60 ;
$insert_q = "INSERT INTO course_offering(id, semester, room_number, slot,cpa_limit,number_of_students) 
VALUES ('$course_code',$semester,'$room_number','$slot',$cgpa_limit,$number_of_students);";
 $results1 = mysqli_query($db_connection, $insert_q);
if (!$results1) {
    printf("Error: %s\n", mysqli_error($db_connection));
    exit();
}
mysqli_close($db_connection);
?>
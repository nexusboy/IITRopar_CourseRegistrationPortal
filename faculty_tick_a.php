<?php
/**
 * Created by PhpStorm.
 * User: Don
 * Date: 5/3/2018
 * Time: 8:55 AM
 */

/*This PHP file is for if faculty approves ticket */
$student_id = 1 ;
$teacher_id = 2 ;
$course_id= 'CSL356';
$dean_id = 7 ;

$db_connection = mysqli_connect('localhost', 'root', '', 'university_database');
// Check The Connection
if (!$db_connection)
{
    die("Connection Failed: " . mysqli_connect_error());
}
mysqli_select_db($db_connection, "crp");

$q_update_table =  "UPDATE ticket_table
SET faculty_id= $dean_id
WHERE student_id = $student_id AND faculty_id = $teacher_id AND course_number='$course_id';";

$query_run =  mysqli_query($db_connection,$q_update_table );
if(!$query_run)
{
    echo "Error: " . mysqli_error($db_connection);;
    exit();
}else{
    echo "ticket approved successfully";
}

mysqli_close($db_connection);
?>
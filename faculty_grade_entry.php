<?php
/**
 * Created by PhpStorm.
 * User: Don
 * Date: 5/2/2018
 * Time: 7:16 PM
 */
$db_connection = mysqli_connect('localhost', 'root', '', 'university_database');
// Check The Connection
if (!$db_connection)
{
    die("Connection Failed: " . mysqli_connect_error());
}
mysqli_select_db($db_connection, "crp");

$student_id = 1 ;
$cur_semester = 7 ;
$course_id = "csl301";
$grade = 10;
$credits = 4 ;

$grade_i_q = "INSERT INTO grades(id, semester, courseid, grade,credits) 
VALUES ($student_id, $cur_semester,'$course_id'/*By form*/,$grade/*By form*/,$credits);";

$results1 = mysqli_query($db_connection, $grade_i_q);
    if (!$results1) {
        printf("Error: %s\n", mysqli_error($db_connection));
        exit();
    }else{
        echo "insert succesfull";
    }
mysqli_close($db_connection);
?>
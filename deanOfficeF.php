<?php
/**
 * Created by PhpStorm.
 * User: Don
 * Date: 5/2/2018
 * Time: 7:30 PM
 */

$db_connection = mysqli_connect('localhost', 'root', '', 'university_database');
// Check The Connection
if (!$db_connection)
{
    die("Connection Failed: " . mysqli_connect_error());
}
mysqli_select_db($db_connection, "crp");


function calc_gpa($db_conncection,$s_id){
    $query = "SELECT sum(grade*grades.credits)/SUM(grades.credits) FROM grades INNER JOIN courses ON grades.courseid = courses.id
WHERE grades.id=$s_id;";
    $query_run =  mysqli_query($db_conncection,$query);
    if(!$query_run)
    {
        echo "Error: " . mysqli_error($db_conncection);;
        exit();
    }

    while ($row = mysqli_fetch_row($query_run)) {
    }
    return $row[0];
}



$student_id = 1 ;
$gpa = calc_gpa($db_connection,$student_id);
echo "GPA of the student".$gpa;


?>
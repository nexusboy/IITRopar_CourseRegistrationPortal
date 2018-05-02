<?php
/**
 * Created by PhpStorm.
 * User: Don
 * Date: 5/2/2018
 * Time: 7:07 PM
 */
$db_connection = mysqli_connect('localhost', 'root', '', 'university_database');
// Check The Connection
if (!$db_connection)
{
    die("Connection Failed: " . mysqli_connect_error());
}
mysqli_select_db($db_connection, "crp");
/*Need to update here from POST Method*/

$faculy_id = 2 ;

$f_query = "SELECT enrolls.courseid,count(enrolls.id) as numOfStudents
FROM teaches
  INNER JOIN enrolls ON teaches.courseid = enrolls.courseid
WHERE teaches.id = $faculy_id /*PHP Session*/ GROUP BY enrolls.courseid;";


$query_run =  mysqli_query($db_connection,$f_query);
	if(!$query_run)
    {
        echo "Error: " . mysqli_error($db_connection);;
        exit();
    }
	$rows = array();
	while($r = mysqli_fetch_assoc($query_run)) {
        $rows[] = $r;
    }
	echo json_encode($rows);
mysqli_close($db_connection);
?>
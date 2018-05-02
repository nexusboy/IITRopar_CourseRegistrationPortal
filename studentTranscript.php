<?php
/**
 * Created by PhpStorm.
 * User: merah
 * Date: 03-May-18
 * Time: 4:35 AM
 */
$student_id = $_POST['student_id'] ;

$db_connection = mysqli_connect('localhost', 'root', '', 'university_database');
// Check The Connection
if (!$db_connection) {
    die("Connection Failed: " . mysqli_connect_error());
}

mysqli_select_db($db_connection, "crp");
$sql1 = "SELECT id,courseid,grade
FROM grades
WHERE id=$student_id/*Given by the Staff*/ and semester =7;"
$result = mysqli_query($db_connection, $sql1);
$no = 1;
$credits = 0;

while ($row = mysqli_fetch_row($result)) {

    echo '<tr>
					<td>' . $no . '</td>
					<td>' . $row[0] . '</td>
					<td>' . $row[1] . '</td>
					<td>' . $row[2] . '</td>          
				</tr>';
    $no++;
    $credits = $credits + $row[1];
}

?>

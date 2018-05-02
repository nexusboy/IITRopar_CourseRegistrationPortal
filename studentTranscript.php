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
WHERE id=$student_id/*Given by the Staff*/ and semester =7;";
$result = mysqli_query($db_connection, $sql1);
$no = 1;
$credits = 0;


echo '<thead>
        <tr>
            <th>#</th>
            <th>Student Id</th>
            <th>Course Id</th>
            <th>Grade</th>
        </tr>
        </thead>';
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


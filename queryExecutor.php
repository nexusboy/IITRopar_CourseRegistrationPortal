<?php
/**
 * Created by PhpStorm.
 * User: Don
 * Date: 5/1/2018
 * Time: 6:13 PM
 */
$db_connection = mysqli_connect('localhost', 'root', '', 'university_database');
// Check The Connection
if (!$db_connection)
{
    die("Connection Failed: " . mysqli_connect_error());
}

mysqli_select_db($db_connection,"crp");

$query = $_POST['query'];
$results = mysqli_query($db_connection, $query);
if(!$results)
{
    echo "Error: " . mysqli_error($db_connection);
    exit();
}

$rows = array();
while($r = mysqli_fetch_assoc($results  )) {
    $rows[] = $r;
}
echo json_encode($rows);

mysqli_close($db_connection);
?>
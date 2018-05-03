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
/* If there is no slot clash */
if ( mysqli_num_rows($results) == 0 ) {
    /*Get the credit limit*/
    $q_credit_limit = "SELECT (sum(grades.credits)/2)*1.25 as cred_limit
FROM grades
WHERE grades.id = $username /*User entry*/ AND (semester = 6/*current semester -1 */ OR semester = 5/*current semester - 2*/) AND (grade >=4 )
GROUP BY grades.id;";
    $q_run = mysqli_query($db_connection,$q_credit_limit);
    $rows = array();
    while($r = mysqli_fetch_assoc($q_run)) {
        $rows[] = $r;
    }
    $cred_limit = $rows[0]['cred_limit'];/*Got the credit limit*/
    //echo $cred_limit;

    $q_enrolled_creds = "SELECT sum(credits) as tot_reg_credits FROM enrolls INNER JOIN courses ON courses.id=enrolls.courseid
WHERE enrolls.id=$username/*username*/
GROUP BY enrolls.id";
    $q_run = mysqli_query($db_connection,$q_enrolled_creds);
    $rows = array();
    while($r = mysqli_fetch_assoc($q_run)) {
        $rows[] = $r;
    }
    $creds_enrolled = $rows[0]['tot_reg_credits'];/*Got the credit limit*/
   // echo "Credits already en ".$creds_enrolled;
    //echo $courseID."sis";
    $q_cur_creds = "SELECT credits as creds
FROM courses
WHERE courses.id='$courseID';";
    $q_run = mysqli_query($db_connection,$q_cur_creds);
    $rows = array();
    while($r = mysqli_fetch_assoc($q_run)) {
        $rows[] = $r;
    }
    $course_credits= $rows[0]['creds'];/*Got the credit limit*/
    //echo "Credits of c_course ".$course_credits;

    if($course_credits+$creds_enrolled <= $cred_limit){

        $q1 = "INSERT INTO enrolls (id, courseid) VALUES ( $username , '$courseID' )";
        $results1 = mysqli_query($db_connection,$q1);
       if (!$results1) {
           printf("Error: %s\n", mysqli_error($db_connection));
           exit();
       }
       else{
           printf("Course Added Successfully \n");
       }

    }else{
        $q_fa_id = "SELECT facultyid as fid
FROM students
WHERE id=$username;";
        $q_run = mysqli_query($db_connection,$q_fa_id);
        $rows = array();
        while($r = mysqli_fetch_assoc($q_run)) {
            $rows[] = $r;
        }
        $advisor_id = $rows[0]['fid'];/*Got the credit limit*/

        $q1 = "INSERT INTO ticket_table(student_id, faculty_id, course_number,description,Current_Status) VALUES ($username,$advisor_id,'$courseID','Credit Limit Problem','In Progress');";
        $results1 = mysqli_query($db_connection,$q1);
        if (!$results1) {
            printf("Error: %s\n", mysqli_error($db_connection));
            exit();
        }
        else{
            printf("\n You have credit limit problem \n Ticket raised successfully \n");
        }


    }

}
elseif(mysqli_num_rows($results) == 1){
    echo "Cannot add because the student has registered in same slot ";
}
/*Write insert pending*/


// No courses should be in same slot



// No of credits + course_credits < credit_limit then insert
?>
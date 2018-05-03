<?php
session_start();

$username = "";
$password = "";
$errors = array();
// connect to postgresql

$db_connection = mysqli_connect('localhost', 'root', '', 'university_database');
// Check The Connection
if (!$db_connection)
{
    die("Connection Failed: " . mysqli_connect_error());
}
// Login user
mysqli_select_db($db_connection,"university_database");
if(isset($_POST['login_user'])){
    $username = mysqli_real_escape_string($db_connection,$_POST['username']) ;
    $password =mysqli_real_escape_string($db_connection,$_POST['password']) ;
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0 ) {
        $query = "SELECT * FROM user_list WHERE username=$username AND password= '$password' ";
        $results = mysqli_query($db_connection, $query);
        if (mysqli_num_rows($results) == 1 ) {
            $r = mysqli_fetch_assoc($results);
            if(strcmp($r['type'],"student") == 0 ) {
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
                header('location: studentloggedIn.php');
                echo "login succesful";
            }
            if(strcmp($r['type'],"teacher") == 0 ) {
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
                header('location: teacherLoggedIn.php');
                echo "login succesful";
            }
            if(strcmp($r['type'],"deanstaff") == 0 ) {
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
                header('location: staffOfDeanPage.php');
                echo "login succesful";
            }
            if(strcmp($r['type'],"deanmain") == 0 ) {
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
                header('location: deanLoggedIn.php');
                echo "login succesful";
            }
        }
        else {
            array_push($errors, "Wrong username/password combination");
        }
    }

}

?>
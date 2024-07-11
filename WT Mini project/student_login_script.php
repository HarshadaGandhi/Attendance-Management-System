<?php

include 'db_connect.php';
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST['username'];
    $password=$_POST['password'];    
$sql="SELECT * FROM student_login WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);
if($result->num_rows==1){
    $_SESSION['username']=$username;
    header("Location: student_dashboard.html");
    exit();
}
else{
    echo "Invalid username or password.";
    exit();
}
}
$conn->close();
?>

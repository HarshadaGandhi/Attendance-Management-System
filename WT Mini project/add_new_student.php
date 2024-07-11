<?php
include 'db_connect.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $s_name = $_POST['name']; 
    $class = $_POST['class']; 
    $roll_no = $_POST['rollno'];

    $sql = "INSERT INTO students_list (name, class, rollno) VALUES ('$s_name', '$class', '$roll_no')";
    $result = $conn->query($sql);

    if ($result === TRUE) {
        // Insertion successful
        echo "New student added successfully!";
    } else {
        // Insertion failed
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

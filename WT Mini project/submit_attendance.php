<?php
include 'db_connect.php';

if(isset($_POST['selectedClass']) && !empty($_POST['selectedClass'])) {
    $selectedClass = mysqli_real_escape_string($conn, $_POST['selectedClass']);

    $sql = "SELECT * FROM students_list WHERE class = '$selectedClass'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $students = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $students[] = $row;
            }
        }

        echo json_encode($students);
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Error: Invalid input";
}

if(isset($_POST['attendanceData'])) {
    $attendanceData = json_decode($_POST['attendanceData'], true);

    foreach($attendanceData as $student) {
        $rollNo = mysqli_real_escape_string($conn, $student['rollNo']);
        $attendance = mysqli_real_escape_string($conn, $student['attendance']);
        // Update attendance for each student in the database
        $updateSql = "UPDATE students_list SET attendance = '$attendance' WHERE roll_number = '$rollNo'";
        $updateResult = mysqli_query($conn, $updateSql);
        if (!$updateResult) {
            echo "Error updating attendance for student with roll number $rollNo: " . mysqli_error($conn);
        }
    }
}
?>

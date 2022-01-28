<?php 
require ("db.php");
require ("student.php");

$student = new Student();

if(isset($_GET['student'])) {
    $student_data = $student->return_student_data($_GET['student']);
    echo $student_data;
}

?>
<?php 
require ("db.php");
require ("student.php");

$student = new Student();

if(isset($_GET['student'])) {
    $student_data = $student->csm_dashboard($_GET['student']);
    print_r($student_data);
}

?>
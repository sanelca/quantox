<?php 
class Student extends Connection {

    public $grades = null;
    public $list_of_grades = null;

    //Calculate avarage grade
    function calculate_grades($students){
        $gradesArray = [];
        foreach($students as $student) {
            $gradesArray[] = $student['grade'];
        }
        $gradeSum = array_sum($gradesArray) / count($gradesArray);
        return $gradeSum;
    }

    //Fetch grades of student
    function fetch_grades($id){
        $grades = $this->db_connection()->prepare("SELECT grade FROM grades WHERE student_id=$id");
        $grades->execute();
        $grades->setFetchMode(PDO::FETCH_ASSOC);
        $this->grades = $grades->fetchAll();
    }
    //CSM dashboard return student data
    function csm_dashboard($id) {
        $this->fetch_grades($id);
        $avarage = $this->calculate_grades($this->grades);
        if($avarage >= 7){
            return "pass";
        }
        return "fail";
    }
}

?>
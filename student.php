<?php 
class Student extends Connection {

    public $grades = null;
    public $list_of_grades = null;
    public $fail_or_pass = 'fail';
    public $student = [];

    function get_student($id){
        $student = $this->db_connection()->prepare("SELECT * FROM student WHERE id=$id");
        $student->execute();
        $student->setFetchMode(PDO::FETCH_ASSOC);

        $data = $student->fetchAll()[0];
        $this->student['id'] = $id;
        $this->student['name'] = $data['name'];
        $this->student['surname'] = $data['surname'];
    }
    //Calculate avarage grade
    function calculate_grades($grades){
        $gradesArray = [];
        foreach($grades as $grade) {
            $gradesArray[] = $grade['grade'];
        }
        $this->list_of_grades = $gradesArray;
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
        $this->student_grades($id);
        $this->get_student($id);
        $this->student['list_of_grades'] = $this->list_of_grades;
        $this->student['fail_or_pass'] = $this->fail_or_pass;

        return json_encode($this->student);
    }

    function student_grades($id) {
        $this->fetch_grades($id);
        $avarage = $this->calculate_grades($this->grades);
        if($avarage >= 7) {
            $this->fail_or_pass = "pass";
 
        }
    }
}

?>
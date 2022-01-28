<?php 
class Student extends Connection {

    public $student = [];
    public $student_school = null;
    public $school_board = null;
    public $return_data = null;

    //function to get student data from database and set data to student array
    function get_student($id){
        $student = $this->db_connection()->prepare("SELECT * FROM student WHERE id=$id");
        $student->execute();
        $student->setFetchMode(PDO::FETCH_ASSOC);
        $data = $student->fetchAll()[0];
        
        $this->student['name'] = $data['name'];
        $this->student['surname'] = $data['surname'];

        $this->student_school = $data['school_id'];
    }

    //Calculate avarage grade nad check if student is pass
    function calculate_grades(){
        $gradeSum = array_sum($this->student['list_of_grades']) / count($this->student['list_of_grades']);
        if($gradeSum >= 7){
            $this->student['Final result'] = "Pass";
        }
    }

    //Fetch grades of student and set grade array to student array
    function fetch_grades($id){
        $grades = $this->db_connection()->prepare("SELECT grade FROM grades WHERE student_id=$id");
        $grades->execute();
        $grades->setFetchMode(PDO::FETCH_ASSOC);

        $gradesArray = [];
        foreach($grades->fetchAll() as $grade) {
            $gradesArray[] = $grade['grade'];
        }

        $this->student['list_of_grades'] = $gradesArray;           
    }

    //CSM dashboard return student data
    function csm_dashboard($id) {
        $this->fetch_grades($id);
        $this->calculate_grades();
    }

    //Check which board has been used
    function get_board_id(){
        $board = $this->db_connection()->prepare("SELECT dashboard_id FROM school WHERE id=$this->student_school");
        $board->execute();
        $board->setFetchMode(PDO::FETCH_ASSOC);
        $this->school_board = $board->fetchAll()[0]['dashboard_id'];
    }

    //Return student data to frontend
    function return_student_data($id) {
        $this->student['id'] = $id;
        $this->student['Final result'] = "Fail";
        $this->get_student($id);
        $this->get_board_id();

        if('1' == $this->school_board){
            $this->csm_dashboard($id);
            $this->return_data = json_encode($this->student);
        } else if('2' == $this->school_board){
            $this->csmb_dashboard($id);
            $this->return_data = $this->return_xml_format();
        }

        return $this->return_data;
    }

    //CSMB board check if student is pass or fail
    function csmb_fail_or_pass(){
        if(count($this->student['list_of_grades']) > 2) {

            sort($this->student['list_of_grades'], SORT_NUMERIC);
            array_shift($this->student['list_of_grades']);

            if(max($this->student['list_of_grades']) > 8) {
                $this->fail_or_pass = "Pass";
            } else {
                $this->calculate_grades();
            }           
        } else {
            $this->calculate_grades();
        }
    }

    //Return xml format for CSMB
    function return_xml_format() {
        $xw = xmlwriter_open_memory();
        xmlwriter_set_indent($xw, 1);
        $res = xmlwriter_set_indent_string($xw, ' ');
        xmlwriter_start_document($xw, '1.0', 'UTF-8');

        xmlwriter_start_element($xw, 'Student');
        xmlwriter_start_attribute($xw, 'card');
        xmlwriter_text($xw, 'Student info');

        xmlwriter_start_element($xw, 'Student_id');
        xmlwriter_text($xw, $this->student['id']);
        xmlwriter_end_element($xw);

        xmlwriter_start_element($xw, 'Student_name');
        xmlwriter_text($xw, $this->student['name'] . " " . $this->student['surname']);
        xmlwriter_end_element($xw);

        xmlwriter_start_element($xw, 'Grades_list');
        xmlwriter_text($xw, implode(", ",$this->student['list_of_grades']));
        xmlwriter_end_element($xw);   

        xmlwriter_start_element($xw, 'Final_result');
        xmlwriter_text($xw, $this->student['Final result']);
        xmlwriter_end_element($xw);  

        xmlwriter_end_attribute($xw);
        xmlwriter_end_element($xw);

        xmlwriter_start_pi($xw, 'php');
        xmlwriter_text($xw, '$foo=2;echo $foo;');
        xmlwriter_end_pi($xw);

        xmlwriter_end_document($xw);

        return xmlwriter_output_memory($xw);
    }

    //CSMB student data return
    function csmb_dashboard($id){
        $this->fetch_grades($id);
        $this->csmb_fail_or_pass();
    }
}

?>
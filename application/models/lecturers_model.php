<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class lecturers_model extends CI_Model{

        private $tbl_name = "lecturers";

        function get_all(){
            $result = $this->db->get($this->tbl_name);
            return $result->result();   //result คือ อาเรย์ of object
        }

        function getteachcoursesmodel($teaching){
            // $data['startdate'] = date('Y-m-d H:i:s');
            // $datestart = date('Y-m-d',time());

            $result = $this->db->from($this->tbl_name);
            $this->db->join('teaching', 'teaching.lecturerID = lecturers.lecturerID');
            $this->db->join('courses', 'courses.courseID = teaching.courseID');
            $this->db->join('class', 'class.courseID = courses.courseID');
            $this->db->join('room','room.roomID = class.roomID');
            $this->db->join('building','building.buildingID = room.buildingID');
            // $this->db->where($data);
            $this->db->where('teaching.teachingID', $teaching);
            
            $result = $this->db->get();
            return $result->result();
        }

        function getsearch_all($keyword){
            $this->db->like('firstName', $keyword);
            $result = $this->db->get($this->tbl_name);
            return $result->result();   //result คือ อาเรย์ of object
        }

        function insert($data){
            return $this->db->insert($this->tbl_name, $data);
        }

        function update($data){
            $this->db->where('lecturerID',$data['lecturerID']);
            $this->db->update($this->tbl_name,$data);
            $result = $this->db->get($this->tbl_name);
            return $result;
        }
        // function historystudentabycoursesmodel($courseID){
        //     $this->db->from('teaching');
        //     $this->db->join('courses', 'courses.courseID = teaching.courseID');
        //     $this->db->join('class', 'class.courseID = courses.courseID');
        //     $this->db->join('checkname', 'class.classID = class.classID');
        //     $this->db->join('students', 'students.studentID = checkname.studentID');
        //     // $this->db->join('checkname', 'checkname.classID = class.classID');
        //     $this->db->where('class.courseID', $courseID);
        //     $result = $this->db->get();
        //     return $result->result();
        // }

        /// เริ่ม
        function getlecturersbyCoursemodel($courseID){
            $this->db->from('courses');
            // $this->db->join('class', 'class.courseID = class.courseID');
            // $this->db->join('room', 'room.roomID = class.roomID');
            // $this->db->join('building', 'building.buildingID = room.buildingID');
            // $this->db->join('teaching', 'teaching.lecturerID = lecturers.lecturerID');
            // $this->db->join('courses', 'courses.courseID = teaching.courseID');
            $this->db->join('class', 'class.courseID = courses.courseID');
            // $this->db->join('room','room.roomID = class.roomID');
            // $this->db->join('building','building.buildingID = room.buildingID');

            $this->db->where('class.courseID', $courseID);

            $result = $this->db->get();
            return $result->result();
        }

        function getCourseByteachingModel($lecturerID){
            $this->db->from('teaching');
            $this->db->join('courses', 'courses.courseID = teaching.courseID');
            $this->db->where('teaching.lecturerID', $lecturerID);
            $result = $this->db->get();
            return $result->result();
        }

        function getAlloursemodel(){
            $this->db->from('courses');
            $result = $this->db->get();
            return $result->result();
        }
        function createcouresbylecturer_model(){
            $this->db->from('class');
            $this->db->where('classID', $classID);
            $this->db->where('studentID', $studentID);
            $this->db->where('roomID', $roomID);
            $this->db->where('starttime', $starttime);
            $this->db->where('endtime', $endtime);
            $this->db->where('startdate', $startdate);
            $this->db->where('startcheck', $startcheck);
            $this->db->where('endcheck', $endcheck);

            // $this->db->where('latitude', $latitude);
            // $this->db->join('courses', 'courses.courseID = teaching.courseID');
            // $this->db->where('courses.teachingID', $teachingID);
            // $this->db->where('courses.courseID', $courseID);
            // $this->db->where('lecturerID.lecturerID', $lecturerID);

            $result = $this->db->get();
            return $result->result();   
        }

        function insert_createcouresbylecturer_model($data){
            return $this->db->insert('teaching', $data);
        }

        function insertdatacreatecouresbylecturer($data){
            return $this->db->insert('teaching', $data);
        }

        function insertdatacreateclassbyTeachs($data){
            return $this->db->insert('class', $data);
        }

        
        // แสดงชื่อนักศึกษา
        function getstudentbycouresmodel(){
            $this->db->from('students');
            $result = $this->db->get();
            return $result->result();
        }

        // update courses
        function update_courses($data){
            $this->db->where('teachingID',$data['teachingID']);
            $this->db->update('teaching',$data);
            $result = $this->db->get('teaching');
            return $result;
        }

        //delete 
        function delete($teachingID){    
            $this->db->where('teachingID', $teachingID); 
            return $this->db->delete('teaching');  
        }
        function getBeforeCourse($teachingID){
            $this->db->where('teachingID', $teachingID);
            $result = $this->db->get('teaching');
            return $result->result();
        }

        // historystudentabycoursesmodel
        function historystudentabycoursesmodel($courseID){
            $this->db->from('studentsregeter');
            $this->db->join('students', 'students.studentID = studentsregeter.studentID');
            $this->db->where('studentsregeter.courseID', $courseID);
            $result = $this->db->get();
            return $result->result();
        }

    }
?>
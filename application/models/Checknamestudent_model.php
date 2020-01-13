<?php
    defined('BASEPATH') OR exit('No direct script access allowed');



    class Checknamestudent_model extends CI_Model{

         
        private $tbl_name = "studentsregeter";

        // function get_all(){
        //     $this->db->select("courses.courseID, courses.courseCode, courses.courseName, courses.lesson, checkname.courseID, checkname.status, checkname.day, studentsregeter.courseID, studentsregeter.studentID ");
        //     $this->db->from($this->tbl_name);
        //     $this->db->join('studentsregeter', 'courses.courseID = studentsregeter.courseID');
        //     // $this->db->join('checkname', 'class.courseID = checkname.courseID');
        //     $this->db->join('class', 'courses.courseID = class.courseID');
        //     $result = $this->db->get();
        //     return $result->result();
        // }

        function getCourseByUserId($userID){
            $datestart = date('Y-m-d',time());
            $this->db->from($this->tbl_name);
            $this->db->join('courses', 'courses.courseID = studentsregeter.courseID');
            $this->db->where('studentsregeter.studentID', $userID);
            $this->db->join('students', 'students.studentID = studentsregeter.studentID');
            $result = $this->db->get();
            return $result->result();

        }

        function getdatatime($coursesid){
            $datestart = date('Y-m-d',time());
            $this->db->from('class');
            // $this->db->where('class.classID', $coursesid );
            $this->db->where('class.courseID', $coursesid);
            $this->db->where('class.startdate', $datestart);
            $result = $this->db->get();
            return $result->row();


        }

        function getcheckname($datetime){
            $this->db->from('checkname');
            $this->db->where('checkname.datetime',$datetime);
            $result = $this->db->get();
            return $result->row();
        }

        function postChecknamedata($classID, $studentID){
            $this->db->from('checkname');
            $this->db->where('classID', $classID);
            $this->db->where('studentID', $studentID);
            // $this->db->where('latitude', $latitude);
            // $this->db->where('longitude', $longitude);
            $result = $this->db->get();
            return $result->result();
        }

        function insert($data){
            return $this->db->insert('checkname', $data);  //table ''
        }

        // function gethistorycourse($courses){
        //     $this->db->from('courses');
        //     $this->db->where('courseID', $courses);
        //     $result = $this->db->get();
        //     return $result->row();
        // }

        function gethistorycoruse($userID){
            $this->db->from($this->tbl_name);
            $this->db->join('courses', 'courses.courseID = studentsregeter.courseID');
            $this->db->join('class', 'class.courseID = courses.courseID');
            $this->db->join('checkname', 'checkname.classID = class.classID');
            $this->db->group_by('courses.courseID');
            $this->db->where('checkname.studentID', $userID);
            $result = $this->db->get();
            return $result->result();
        }

        function posthistorydata($classID, $userID){
                // $this->db->select("checkname.checknameID, checkname.datetime, checkname.status");
                $this->db->from('checkname');
                $this->db->join('class', 'class.classID = checkname.classID');
                $this->db->join('room','room.roomID = class.roomID');
                $this->db->join('building','building.buildingID = room.buildingID');
                //$this->db->group_by('checkname.classID');  
                $this->db->where('checkname.classID' ,$classID);
                $this->db->where('checkname.studentID' ,$userID);

                // $this->db->join('coruse', 'coruse.classID = class.classID');
                // $this->db->like('checkname.classID', $classID);
                // $this->db->like('checkname.studentID', $studentID);
                
                $result = $this->db->get();
                return $result->result();
            }

            function classbycourse($courseID){
                // $datecheck = date('H:i:s');
                // echo($datecheck);
                $this->db->from('class');
                // $this->db->where('class.classID', $classID);
                $this->db->join('courses', 'courses.courseID = class.courseID');
                
                $this->db->where('courses.courseID', $courseID);
                // $this->db->where('class.startdate', $datecheck);
                // $this->('datecheck',$datecheck);
                $result = $this->db->get();
                return $result->result();
            }

            function getclassbycoursesModel($courseID,$classID){
                $this->db->from('class');
                $this->db->join('checkname', 'checkname.classID = class.classID');
                $this->db->where('checkname.classID', $classID);
                $this->db->where('class.courseID', $courseID);
                $result = $this->db->get();
                return $result->result();

            }

    }
?>
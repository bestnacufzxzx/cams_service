<?php
    defined('BASEPATH') OR exit('No direct script access allowed');



    class Checknamestudent_model extends CI_Model{

        private $tbl_name = "checkname";

        function get_all(){
            $this->db->select("studentsregeter.datetimeRegeter ,studentsregeter.courseID , courses.courseCode, courses.courseCode  ");
            $this->db->from($this->tbl_name);
            // $this->db->join('studentsregeter ', 'checkname.courseID = courses.courseID');
            $this->db->join('class', 'courses.courseID = checkname.courseID');
            // $this->db->join('courses', 'studentsregeter.courseID = courseCode.courseID');

            // $this->db->like();
            $result = $this->db->get();
            return $result->result();   //result คือ อาเรย์ of object

            // $result = $this->db->get($this->tbl_name);
            // return $result->result();   //result คือ อาเรย์ of object
        }

    }
?>
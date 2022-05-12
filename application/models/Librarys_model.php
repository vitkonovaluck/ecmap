<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of menu_model
 *
 * @author user
 */
class Librarys_model extends CI_Model  {
    
    //put your code here
         public function __construct()
        {
            $this->load->library('session');
            $this->load->database();
        }


        public function get_library($filter) {
            $sql = "SELECT * FROM `librarys`,`librarys_type` WHERE `librarys`.liibrary_type=`librarys_type`.lt_id ".$filter." order by library_name";
            
            $query = $this->db->query($sql);		
            return $query->result_array();

        }

        public function get_library_count($filter) {
            $sql = "SELECT * FROM `librarys`,`librarys_type` WHERE `librarys`.liibrary_type=`librarys_type`.lt_id ".$filter." order by library_name";
            
            $query = $this->db->query($sql);		
            return $query->num_rows();

        }

        public function get_departament() {
            $sql = "SELECT * FROM `department`";
            
            $query = $this->db->query($sql);		
            return $query->result_array();

        }
 
        
        public function get_library_id($id) {
            $sql = "SELECT * FROM `librarys` WHERE `library_id`=".$id;
           
            $query = $this->db->query($sql);		
            return $query->result_array();

        }
        
        public function get_library_type() {
            $sql = "SELECT * FROM `librarys_type` order by lt_name ";
            
            $query = $this->db->query($sql);		
            return $query->result_array();

        }
        
        public function library_insert($library_id,$library_name,$library_type,$library_sity_type,$library_sity,$library_address) {
            $sql="INSERT INTO `librarys`(`library_id`, `library_name`, `library_sity_type`, `library_sity`, `library_address`, `liibrary_type`) VALUES (null,'".$library_name."','".$library_sity_type."','".$library_sity."','".$library_address."',".$library_type.");";
            echo $sql;
            $query = $this->db->query($sql);		
            return 1;
        }
        
        public function library_edit($library_id,$library_name,$library_type,$library_sity_type,$library_sity,$library_address) {
            $sql="UPDATE `librarys` SET `library_name`='".$library_name."',`library_sity_type`='".$library_sity_type."',`library_sity`='".$library_sity."',`library_address`='".$library_address."',`liibrary_type`=".$library_type." WHERE `library_id`=".$library_id;

            echo $sql;
            $query = $this->db->query($sql);		
            return 1;
            
        }
}

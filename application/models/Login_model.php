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
class login_model extends CI_Model  {
    
    //put your code here
         public function __construct()
        {
            $this->load->library('session');
            $this->load->database();
        }


        public function login($login,$password){
            $sql = "SELECT * FROM `users` WHERE`user_login` = '".$login."' and `user_passw`=md5('".$password."')";
            $query = $this->db->query($sql);		
            return $query->result_array();
        
        }
        
        public function user($uid){
            $sql = "SELECT * FROM `users` WHERE `user_id` = '".$uid."'";
            $query = $this->db->query($sql);		
            return $query->result_array();
        
        }
        
         public function user_id($uid){
            $sql = "SELECT * FROM `users` WHERE `user_login` = '".$uid."'";
            $query = $this->db->query($sql);		
             $row = $query->row_array();
            if (isset($row))
            {   
                return $row['user_id'];
            }
        
        }
        
        public function admin_check($password){
            $sql = "SELECT count(*) cnt FROM `users` WHERE `user_id` = '1' and `user_passw`=md5('".$password."')";
            $query = $this->db->query($sql);		
             $row = $query->row_array();
            if (isset($row))
            {   
                return $row['cnt'];
            }
        
        }

        public function set_password($user_id,$password){
            $sql = "update `users` SET `user_passw`=md5('".$password."') WHERE `user_id` = '".$user_id."'";
 
            $query = $this->db->query($sql);		
            
            return 1;
            
        
        }
               
        public function get_privilege() {
            $sql = "SELECT * FROM `privilege`";
            
            $query = $this->db->query($sql);		
            return $query->result_array();

        }
}

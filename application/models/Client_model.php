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
class Client_model extends CI_Model  {
    
    //put your code here
         public function __construct()
        {
            $this->load->library('session');
            $this->load->database();
        }


        public function all_clients(){
            $sql = "SELECT * FROM `e_doc_Clients` ORDER BY `e_doc_Clients`.`client_name` ASC";
            $query = $this->db->query($sql);		
            return $query->result_array();
        }    
}

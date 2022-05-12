<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Journal
 *
 * @author djey
 */
class Period_model extends CI_Model  {
    //put your code here
     public function __construct()
        {
            $this->load->library('session');
            $this->load->database();
        }

    public function get_period(){
        $sql = "SELECT * FROM `periods` "
                ." ORDER BY `periods`.`period_name`";
        
            $query = $this->db->query($sql);		
            return $query->result_array();
    }

    public function get_period_by_doc($doc_id){
        $sql = "SELECT period_id, period_name, count(*) FROM `journal`,`periods` WHERE `journal_period`=period_id and `journal_doc`=".$doc_id." group by period_id,period_name"
                ." ORDER BY `periods`.`period_name` DESC";
        
            $query = $this->db->query($sql);		
            return $query->result_array();
    }
    
    
}
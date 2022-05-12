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
class Journal_model extends CI_Model  {
    //put your code here
     public function __construct()
        {
            $this->load->library('session');
            $this->load->database();
        }

    public function get_journal($filter){
        $sql = "SELECT * "
                ."FROM `journal`,`documents`,`periods`,`document_status`,`librarys`,`department` "
                ."WHERE `journal_doc`=`document_id` and `journal_period`=`period_id` and `journal_library`=`library_id` "
                ."and `journal_status`= `ds_id`and `journal_depart`= `dep_id`".$filter
                ." ORDER BY `periods`.`period_name`, document_name, dep_name, library_name ASC";
        
            $query = $this->db->query($sql);		
            return $query->result_array();
    }
    
    public function get_journal_sum($filter){
        $sql = "SELECT sum(jurnal_sum) as suma"
               ." FROM e_doc_journal,e_doc_document,e_doc_Clients,e_doc_bh_user,e_doc_doc_status "
               ." WHERE journal_doc=doc_id and doc_sum=1 and journal_client=Client_id and journal_avtor=user_id and journal_status=status_id ".$filter
               ." ORDER by journal_date DESC, journal_numb DESC";
            $query = $this->db->query($sql);		
            
            $row = $query->row_array();
           //  echo print_r($row);   
           //echo $row['suma'];
            return $row['suma'];
    }
}
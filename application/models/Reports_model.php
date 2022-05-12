<?php

class reports_model extends CI_Model  {
    
    //put your code here
         public function __construct()
        {
            $this->load->library('session');
            $this->load->database();
        }

        
        public function get_menu_main() {
            $scr="";
            $scr.= $this->get_menu_id(0);
         
            return $scr;
        }
        
        public function get_title($id){
            $sql = "SELECT * FROM `hkgroups` WHERE `docum` = ".$id." ORDER BY `hkgroups`.`sortnumber` ASC";
            //$sql = "SELECT count(*) cnt FROM `e_doc_journal_files` WHERE `jf_journal`=".$did;
           
            $query = $this->db->query($sql);		
            return $query->result_array();
            
        }
        
        public function get_fields($id){
            $sql = "SELECT *  FROM `hkfields` WHERE `hkgroupid` = ".$id."  ORDER BY `hkfields`.`sortnumber` ASC";
            //$sql = "SELECT count(*) cnt FROM `e_doc_journal_files` WHERE `jf_journal`=".$did;
           
            $query = $this->db->query($sql);		
            return $query->result_array();
            
        }

        public function get_fields_by2($gr,$sn){
            $sql = "SELECT *  FROM `hkfields` WHERE `hkgroupid` = ".$gr." and `hksectionid` is not null  ORDER BY `hkfields`.`sortnumber` ASC";
            //$sql = "SELECT count(*) cnt FROM `e_doc_journal_files` WHERE `jf_journal`=".$did;
            $query = $this->db->query($sql);		
            return $query->result_array();
            
        }
        
        public function get_fields_by($gr,$sn){
            $sql = "SELECT *  FROM `hkfields` WHERE `hkgroupid` = ".$gr."  and `hksectionid` is null  and sortnumber = ".$sn."  ORDER BY `hkfields`.`sortnumber` ASC";
            //$sql = "SELECT count(*) cnt FROM `e_doc_journal_files` WHERE `jf_journal`=".$did;
           
            $query = $this->db->query($sql);		
            return $query->result_array();
            
        }
        public function get_sections1($gr,$col){
            $sql = "SELECT * FROM `hksections` where `parentid` is null and `groupid`=".$gr." AND `col`= ".$col." ORDER BY `hksections`.`SortNumber` ASC";
            $query = $this->db->query($sql);		
            return $query->result_array();
            
        }

        public function get_sections2($gr,$col){
            $sql = "SELECT * FROM `hksections` where `parentid`=".$col." and `groupid`=".$gr." ORDER BY `hksections`.`SortNumber` ASC";
            
            
            $query = $this->db->query($sql);		
            return $query->result_array();
            
        }
        
        public function get_fields_sum($grp,$id,$filter){
            $sql = "SELECT sum(`dd_values`) sm FROM `document_data` where `dd_docid` in (".$filter.") and `dd_fieldsid` in (SELECT `fieldid` FROM `hkfields` WHERE `groupid`=".$grp." and `sortnumber`=".$id.")";
           
            //$sql = "SELECT count(*) cnt FROM `e_doc_journal_files` WHERE `jf_journal`=".$did;
           
            $query = $this->db->query($sql);	
            $row = $query->row_array();
            if (isset($row))
            {   
                return $row['sm'];
            }else{
                return 0;
            } 
        }

        public function get_fields_data($grp,$id,$did){
            $sql = "SELECT `dd_values` sm FROM `document_data` where `dd_docid` in (".$did.") and `dd_fieldsid` in (SELECT `fieldid` FROM `hkfields` WHERE `groupid`=".$grp." and `sortnumber`=".$id.")";
           
            //$sql = "SELECT count(*) cnt FROM `e_doc_journal_files` WHERE `jf_journal`=".$did;
           
            $query = $this->db->query($sql);	
            $row = $query->row_array();
            if (isset($row))
            {   
                return $row['sm'];
            }else{
                return 0;
            } 
        }
        
        
}
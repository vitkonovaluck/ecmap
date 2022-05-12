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
class Document_model extends CI_Model  {
    
    //put your code here
         public function __construct()
        {
            $this->load->library('session');
            $this->load->database();
        }
        
        public function get_documents() {
            $sql = "SELECT * FROM `documents` order by document_name";
            //$sql = "SELECT count(*) cnt FROM `e_doc_journal_files` WHERE `jf_journal`=".$did;
           
            $query = $this->db->query($sql);		
            return $query->result_array();
            
        }        

        public function get_document_dep_report($doc_id) {
            $sql = "SELECT document_dep_report FROM `documents` where document_id=".$doc_id." order by document_name";
            //$sql = "SELECT count(*) cnt FROM `e_doc_journal_files` WHERE `jf_journal`=".$did;
           
            $query = $this->db->query($sql);		
            $row = $query->row_array();
            if (isset($row))
            {   
                return $row['document_dep_report'];
            }
        }        

        public function get_period($p_name) {
            $sql = "SELECT * FROM `periods` WHERE `period_name`='".$p_name."'";
           
            $query = $this->db->query($sql);		
            $row = $query->row_array();
            if (isset($row))
            {   
                return $row['period_id'];
            }else{
                $sql1="INSERT INTO `periods`(`period_id`, `period_name`) VALUES (null,\"".$p_name."\")"; 
                $query = $this->db->query($sql1);
                $sql = "SELECT * FROM `periods` WHERE `period_name`='".$p_name."'";
           
                $query = $this->db->query($sql);		
                $row = $query->row_array();
                return $row['period_id'];
            
            }
        }
      
        public function get_doc_group($id) {
            $sql = "SELECT * FROM `groups` WHERE `docum` = ".$id." ORDER BY `groups`.`SortNumber` ASC";
            //$sql = "SELECT count(*) cnt FROM `e_doc_journal_files` WHERE `jf_journal`=".$did;
           
            $query = $this->db->query($sql);		
            return $query->result_array();
            
        }

        public function get_doc_section($id) {
            $sql = "SELECT * FROM `sections` WHERE `groupid` = ".$id." ORDER BY `SortNumber` ASC";
            //$sql = "SELECT count(*) cnt FROM `e_doc_journal_files` WHERE `jf_journal`=".$did;
           
            $query = $this->db->query($sql);		
            return $query->result_array();
            
        }
             
        public function get_doc_fields($gid,$sid) {
            $sql = "SELECT * FROM `Fields` WHERE `groupid` = ".$gid." and `sectionid` = ".$sid." and visible='true' ORDER BY `SortNumber` ASC";
            //$sql = "SELECT count(*) cnt FROM `e_doc_journal_files` WHERE `jf_journal`=".$did;
           
            $query = $this->db->query($sql);		
            return $query->result_array();
            
        }

        public function get_doc_status() {
            $sql = "SELECT * FROM `document_status` ORDER BY `ds_id` ASC";
            //$sql = "SELECT count(*) cnt FROM `e_doc_journal_files` WHERE `jf_journal`=".$did;
           
            $query = $this->db->query($sql);		
            return $query->result_array();
            
        }
             
        public function check_document($period_id,$doc_id,$user_id,$user_libr,$user_dep){
            $sql = "SELECT * FROM `journal` where `journal_doc`=".$doc_id." AND `journal_period`=".$period_id." AND `journal_library`=".$user_libr." AND`journal_depart`=".$user_dep." AND `journal_user`=".$user_id;
        
            $query = $this->db->query($sql);		
            $row = $query->row_array();
 
            if (isset($row))
            {   
                return 1; 
            }else{
                return 0;
            }
        }
        
        public function add_document($period_id,$doc_id,$user_id,$user_libr,$user_dep,$prim){
            $sql = "INSERT INTO `journal`(`journal_id`, `journal_doc`, `journal_period`, `journal_library`, `journal_depart`, `journal_user`, `journal_date`, `journal_status`,`journal_prim`) VALUES"
                    . " (null,".$doc_id.",".$period_id.",".$user_libr.",".$user_dep.",".$user_id.",'".date("Y-m-d")."',1,'".$prim."')";
            echo $sql."<br>";
            $query = $this->db->query($sql);
            
            $docs_id=0;
            $sql = "SELECT * FROM `journal` where `journal_doc`=".$doc_id." AND `journal_period`=".$period_id." AND `journal_library`=".$user_libr." AND`journal_depart`=".$user_dep." AND `journal_user`=".$user_id;
            echo $sql."<br>";
            $query = $this->db->query($sql);		
            $row = $query->row_array();
            if (isset($row))
            {
                $docs_id=$row['journal_id'];
            }
            $sql = "INSERT INTO `document_status_log`(`dsl_id`, `dsl_doc`, `dsl_user`, `dsl_status`, `dsl_date`) VALUES (null,".$docs_id.",".$user_id.",1,'".date("Y-m-d")."')";
            echo $sql."<br>";
            
            $query = $this->db->query($sql);
            
            
            $sql = "SELECT `Fields`.id,groupid,sectionid FROM `Fields`, groups WHERE groupid=groups.id AND docum=".$doc_id;
            $query = $this->db->query($sql);
            $row = $query->result_array();
            if (isset($row))
            {   
                foreach ($row as $field){
                    $ins_sql="INSERT INTO `document_data`(`dd_id`, `dd_docid`, `dd_fieldsid`, `dd_values`) VALUES (null,".$docs_id.",".$field['id'].",'')";
                   // echo $ins_sql;
                    $query = $this->db->query($ins_sql);
                }
                
            }

            
        }
        
        public function get_doc_data($doc) {
            $sql="Select * from `document_data` WHERE `dd_docid`=".$doc;
            $query = $this->db->query($sql);
            return $query->result_array();
        }
        
        public function put_doc_data($doc,$data) {
            
            $sql = "SELECT `journal_status` FROM `journal` where `journal_id`=".$doc;
            
            $query = $this->db->query($sql);		
            $row = $query->row_array();
            $status=10000;
            if (isset($row))
            {   
                $status=$row['journal_status'];
            }
           // echo $status;
            if($status < 3){
                $icv = urldecode($data[1]);
                $pos = strpos($data[0],'ko_unique_');
                if ($pos !== false) {
                    //echo '<br>'.$data[0],' входить у "ko_unique_" з №'.$pos;        
                    $sql = "UPDATE `document_data` SET `dd_values`='".$icv."' WHERE `dd_docid`=".$doc." and `dd_fieldsid`=".str_replace('ko_unique_', '', $data[0]);
                    echo '<br>'.$sql;
                    //echo '<br>'.$sql;
                    $query = $this->db->query($sql);
                }
            }    
            if($status == 4){
                $icv = urldecode($data[1]);
                $pos = strpos($data[0],'ko_unique_');
                if ($pos !== false) {
                    //echo '<br>'.$data[0],' входить у "ko_unique_" з №'.$pos;        
                    $sql = "UPDATE `document_data` SET `dd_values`='".$icv."' WHERE `dd_docid`=".$doc." and `dd_fieldsid`=".str_replace('ko_unique_', '', $data[0]);
                    echo '<br>'.$sql;
                    //echo '<br>'.$sql;
                    $query = $this->db->query($sql);
                }
               
            }
            if($status < 2){
            
                $sql = "UPDATE `journal` SET `journal_status`=2 WHERE `journal_id`=".$doc;

                $query = $this->db->query($sql);		
                return $query->result_array();
                
                $sql = "INSERT INTO `document_status_log`(`dsl_id`, `dsl_doc`, `dsl_user`, `dsl_status`, `dsl_date`) VALUES (null,".$doc.",".$_SESSION['user_id'].",2,'".date("Y-m-d h:m:i")."')";

                $query = $this->db->query($sql);		
                return $query->result_array();
            }
        }
        
        public function formula_validat($dt_id) {
            $sql = 'SELECT `id`, `groupid`, `formula`, `validation`,`validationmessage`  FROM `Fields` WHERE `groupid` in (select `id` from `groups` where `docum` = '.$dt_id.') and  ((`formula`<>"" ) OR (`validation`<>""))';
            $query = $this->db->query($sql);		
            return $query->result_array();
        }
        
        public function send_doc($doc){
            
            $sql = "SELECT `journal_status` FROM `journal` where `journal_id`=".$doc;
            
            $query = $this->db->query($sql);		
            $row = $query->row_array();
            $status=10000;
            if (isset($row))
            {   
                $status=$row['journal_status'];
            }
            
            if(($status ==2) or ($status ==4)){
            
                $sql = "UPDATE `journal` SET `journal_status`=3 WHERE `journal_id`=".$doc;

                $query = $this->db->query($sql);		
                return $query->result_array();
                
                $sql = "INSERT INTO `document_status_log`(`dsl_id`, `dsl_doc`, `dsl_user`, `dsl_status`, `dsl_date`) VALUES (null,".$doc.",".$_SESSION['user_id'].",3,'".date("Y-m-d h:m:i")."')";

                $query = $this->db->query($sql);		
                return $query->result_array();
            }
        }
        
        public function accept_doc($doc){
            
            $sql = "SELECT `journal_status` FROM `journal` where `journal_id`=".$doc;
            
            $query = $this->db->query($sql);		
            $row = $query->row_array();
            $status=10000;
            if (isset($row))
            {   
                $status=$row['journal_status'];
            }
            
            if($status ==3){
            
                $sql = "UPDATE `journal` SET `journal_status`=5 WHERE `journal_id`=".$doc;

                $query = $this->db->query($sql);		
                return $query->result_array();
                
                $sql = "INSERT INTO `document_status_log`(`dsl_id`, `dsl_doc`, `dsl_user`, `dsl_status`, `dsl_date`) VALUES (null,".$doc.",".$_SESSION['user_id'].",5,'".date("Y-m-d h:m:i")."')";

                $query = $this->db->query($sql);		
                return $query->result_array();
            }
        }
        
        public function back_doc($doc){
            
            $sql = "SELECT `journal_status` FROM `journal` where `journal_id`=".$doc;
            
            $query = $this->db->query($sql);		
            $row = $query->row_array();
            $status=10000;
            if (isset($row))
            {   
                $status=$row['journal_status'];
            }
            
            if($status ==3){
            
                $sql = "UPDATE `journal` SET `journal_status`=4 WHERE `journal_id`=".$doc;

                $query = $this->db->query($sql);		
                return $query->result_array();
                
                $sql = "INSERT INTO `document_status_log`(`dsl_id`, `dsl_doc`, `dsl_user`, `dsl_status`, `dsl_date`) VALUES (null,".$doc.",".$_SESSION['user_id'].",4,'".date("Y-m-d h:m:i")."')";

                $query = $this->db->query($sql);		
                return $query->result_array();
            }
        }
}

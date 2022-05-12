<?php

class menu_model extends CI_Model  {
    
    //put your code here
         public function __construct()
        {
            $this->load->library('session');
            $this->load->database();
        }

        
        public function get_doc_id(){
            $res="";
            if($_SESSION['user_priv']>2){
                $res.="<li class=\"nav-item\">\n";
                $res.="<a class=\"nav-link\" href=\"".base_url()."Documents/create\">Створити документ</a>";
                $res.="</li>\n";                        
            }
            $res.="<li><hr class=\"dropdown-divider\"></li>";
            $res.="<li class=\"nav-item\">\n";
            $res.="<a class=\"nav-link\" href=\"".base_url()."?id=0\">-Всі-</a>";
            $res.="</li>\n";                        
            
            $res.="<li><hr class=\"dropdown-divider\"></li>";
              
            $sql = "SELECT * FROM `documents` WHERE `document_priv`<=".$_SESSION['user_priv']." ORDER BY `document_name` ASC";
            $query = $this->db->query($sql);		
            $row = $query->result_array();
            if (isset($row))
            {   
                
                foreach ($row as $menu){
                    $res.="<li class=\"nav-item\">\n";
                    $res.="<a class=\"nav-link\" href=\"".base_url()."?fltr_doc=".$menu['document_id']."\">".$menu['document_name']."</a>";
                    $res.="</li>\n";                        
                    }
                
            }
                
            return $res;
        
        }

        public function get_menu_id($id){
            $sql = "SELECT * FROM `menu` WHERE `menu_parrent` = ".$id." and `menu_priv`<=".$_SESSION['user_priv']." ORDER BY `menu`.`menu_sort` ASC";
            $query = $this->db->query($sql);		
            $row = $query->result_array();
            if (isset($row))
            {   
                $res="";
                foreach ($row as $menu){
                    if($this->get_menu_count($menu['menu_id'])>0){
                    $res.="<li class=\"nav-item dropdown\" style=\"width: 150px;\">\n";
                    $res.="<a class=\"nav-link dropdown-toggle\" href=\"".$menu['menu_url']."\" id=\"navbarDropdown\" role=\"button\"data-bs-toggle=\"dropdown\" aria-expanded=\"false\">".$menu['menu_name']."</a>";
                    $res.="<ul class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">\n";
                    $res.= $this->get_menu_id($menu['menu_id']);
                    $res.="</ul>\n";
                    $res.="</li>\n";            
                    }elseif($menu['menu_id'] == 5){
                    $res.="<li class=\"nav-item dropdown\" style=\"width: 200px;\">\n";
                    $res.="<a class=\"nav-link dropdown-toggle\" href=\"".$menu['menu_url']."\" id=\"navbarDropdown\" role=\"button\"data-bs-toggle=\"dropdown\" aria-expanded=\"false\">".$menu['menu_name']."</a>";
                    $res.="<ul class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">\n";
                    $res.= $this->get_doc_id();
                    $res.="</ul>\n";
                    $res.="</li>\n";            
                        
                    } else {
                    $res.="<li class=\"nav-item\">\n";
                    $res.="<a class=\"nav-link\" href=\"".base_url().$menu['menu_url']."\">".$menu['menu_name']."</a>";
                    $res.="</li>\n";                        
                    }
                }     
            }
                
            return $res;
        
        }
        
        public function get_menu_count($id){
            $sql = "SELECT count(*) cnt FROM `menu` WHERE `menu_parrent` = ".$id." and `menu_priv`<=".$_SESSION['user_priv']."  ORDER BY `menu`.`menu_sort` ASC";
            //$sql = "SELECT count(*) cnt FROM `e_doc_journal_files` WHERE `jf_journal`=".$did;
           
            $query = $this->db->query($sql);		
            $row = $query->row_array();
            if (isset($row))
            {   
                return $row['cnt'];
            }else{
                return 0;
            }
        
        }
        
        public function get_menu_main() {
            $scr="";
            $scr.= $this->get_menu_id(0);
         
            return $scr;
        }
        
        public function get_menu(){
            $sql = "SELECT * FROM `menu`,privilege where menu_priv=priv_id  ORDER BY `menu`.`menu_parrent`,`menu`.`menu_sort` ASC";
            //$sql = "SELECT count(*) cnt FROM `e_doc_journal_files` WHERE `jf_journal`=".$did;
           
            $query = $this->db->query($sql);		
            return $query->result_array();
            
        }
        
        public function get_menu_edit($id){
            $sql = "SELECT * FROM `menu` where menu_id =".$id." ORDER BY `menu`.`menu_parrent`,`menu`.`menu_sort` ASC";
            //$sql = "SELECT count(*) cnt FROM `e_doc_journal_files` WHERE `jf_journal`=".$did;
           
            $query = $this->db->query($sql);		
            return $query->result_array();
            
        }

        public function menu_insert($id,$parrent,$name,$sort,$icon,$url,$priv){
            $sql = "INSERT INTO `menu`(`menu_id`, `menu_parrent`, `menu_name`, `menu_icon`, `menu_sort`, `menu_url`, `menu_priv`) VALUES (null,".$parrent.",\"".$name."\",".$sort.",\"".$icon."\",\"".$url."\",".$priv.");";
            echo $sql;
            $query = $this->db->query($sql);		
            return 1;
            
        }
        public function menu_edit($id,$parrent,$name,$sort,$icon,$url,$priv){
            $sql = "UPDATE `menu` SET `menu_parrent`=\"".$parrent."\",`menu_name`=\"".$name."\",`menu_icon`=\"".$icon."\",`menu_sort`=".$sort.",`menu_url`=\"".$url."\",`menu_priv`=".$priv." WHERE `menu_id`=".$id;
            echo $sql;
            $query = $this->db->query($sql);		
            return 1;
            
        }
}

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
class Librarians_model extends CI_Model  {
    
    //put your code here
         public function __construct()
        {
            $this->load->library('session');
            $this->load->database();
        }


        public function get_librarian($filter) {
            $sql = "SELECT * FROM `librarys`,`users`,`department`,`privilege` WHERE ".$filter." `librarys`.library_id=user_libr AND `user_dep`=dep_id and user_priv=priv_id and (user_id=".$_SESSION['user_id']." or `user_priv`< (select user_priv from users where user_id=".$_SESSION['user_id'].")) order by user_name";
            
            $query = $this->db->query($sql);		
            return $query->result_array();

        }
        
        public function check_librarian() {
            $sql = "SELECT * FROM `librarys` where library_id not in (SELECT user_libr FROM `users` )";
            $query = $this->db->query($sql);		
            $row = $query->result_array();
            if (isset($row))
            {   
                $res="";
                foreach ($row as $menu){
                    $sql1 = "INSERT INTO `users`(`user_id`, `user_login`, `user_passw`, `user_name`, `user_priv`, `user_fname`, `user_email`, `user_libr`, `user_dep`) VALUES"
                            . " (null,'0123456789','md5(654321)','Бібліотекар',1,'".$menu['library_sity']."','','".$menu['library_id']."',8)";
                    $query1 = $this->db->query($sql1);
                }
            }    
        }
        
        public function get_librarian_id($id) {
            $sql = "SELECT * FROM `users` WHERE `user_id`=".$id;
           
            $query = $this->db->query($sql);		
            return $query->result_array();

        }
        
        function user_doc($cond){
            $sql ="select * from users, department where user_dep=dep_id and dep_report ".$cond  ;
            echo $sql;
            $query = $this->db->query($sql);		
            return $query->result_array();
        }
        
        public function librarian_insert($user_id,$user_name,$user_fname,$user_libr,$user_login,$user_email,$user_priv,$user_dep) {
            $sql="INSERT INTO `users`(`user_id`, `user_login`, `user_name`, `user_priv`, `user_fname`, `user_email`, `user_libr`, `user_passw`, `user_dep`) VALUES (NULL,'".$user_login."','".$user_name."',$user_priv,'".$user_fname."','".$user_email."','".$user_libr."','',".$user_dep.")";
            echo $sql;
            $query = $this->db->query($sql);		
            return 1;
        }
        
        public function librarian_edit($user_id,$user_name,$user_fname,$user_libr,$user_login,$user_email,$user_priv,$user_dep) {
            $sql="UPDATE `users` SET `user_login`='".$user_login."',`user_name`='".$user_name."',`user_priv`='".$user_priv."',`user_fname`='".$user_fname."',`user_email`='".$user_email."',`user_libr`='".$user_libr."',`user_dep`='".$user_dep."' WHERE `user_id`=".$user_id;

            echo $sql;
            $query = $this->db->query($sql);		
            return 1;
            
        }
        
        public function librarian_privilege($user_id) {
            $sql="SELECT `user_priv` FROM `users` WHERE `user_id`=".$user_id;
            $query = $this->db->query($sql);
            $row = $query->row_array();
           
            return $row['user_priv'];
            
        }
}

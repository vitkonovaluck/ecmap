<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Librarians extends CI_Controller {

    function __construct()
	{
		parent::__construct();
                $this->load->library('session');
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('url');
                $this->load->model('menu_model');
                $this->load->model('librarians_model');
                $this->load->model('librarys_model');
                $this->load->model('login_model');
      	}
        
    public function index()
	{
           // unset($_SESSION['user_id']);
            if(isset($_SESSION['user_id'])){
                $data= array(); 
                $d_menus=array();
                $data['menu_main']=$this->menu_model->get_menu_main();
                $data['librarians']=$this->librarians_model->check_librarian();
                $data['librarians']=$this->librarians_model->get_librarian('');
                
                //print_r(print_r($datas));
                $this->load->view('common/title');
		$this->load->view('common/header',$data);
		$this->load->view('common/javascript',$data);
		$this->load->view('directorys/librarian',$data);
		$this->load->view('common/footer');
            }else{
                //$this->load->view('common/title');
		$this->load->view('pages/login');
		//$this->load->view('common/footer');
            }
	}

        public function add()
	{
           // unset($_SESSION['user_id']);
            if(isset($_SESSION['user_id'])){
                $data= array(); 
                
                $data['menu_main']=$this->menu_model->get_menu_main();
                $data['librarys']=$this->librarys_model->get_library('');
                $data['departament']=$this->librarys_model->get_departament();
                $data['privilege']=$this->login_model->get_privilege();

                $d_user['user_id']=0; 
                $d_user['user_login']=''; 
                $d_user['user_name']=''; 
                $d_user['user_priv']=0; 
                $d_user['user_fname']=''; 
                $d_user['user_email']=''; 
                $d_user['user_libr']='1'; 
                $d_user['user_priv']='1'; 
                $d_user['user_dep']='1'; 
                 
                $data['readonly']="";

                $data['user_datas']=$d_user;
                $this->load->view('common/title');
		$this->load->view('common/header',$data);
		$this->load->view('common/javascript',$data);
		$this->load->view('directorys/librarian_edit',$data);
		$this->load->view('common/footer');
            }else{
                //$this->load->view('common/title');
		$this->load->view('pages/login');
		//$this->load->view('common/footer');
            }
	}

        public function edit()
	{
           // unset($_SESSION['user_id']);
            if(isset($_SESSION['user_id'])){
                if(isset($_GET['id'])){
                    $data= array(); 

                    $data['menu_main']=$this->menu_model->get_menu_main();
                    $data['librarys']=$this->librarys_model->get_library('');
                    $librarian_data=$this->librarians_model->get_librarian_id($_GET['id']);
                    $data['departament']=$this->librarys_model->get_departament();
                    $data['privilege']=$this->login_model->get_privilege();

                    foreach($librarian_data as $ld){
                        $d_menus['user_id']=$ld['user_id'];
                        $d_menus['user_name']= str_replace('"', '`', $ld['user_name']);
                        $d_menus['user_fname']= str_replace('"', '`', $ld['user_fname']);
                        $d_menus['user_libr']=$ld['user_libr'];
                        $d_menus['user_login']=$ld['user_login'];
                        $d_menus['user_email']=$ld['user_email'];
                        $d_menus['user_priv']=$ld['user_priv'];
                        $d_menus['user_dep']=$ld['user_dep'];
                        
                    }
                    
                    $data['readonly']="";
                    $data['user_datas']=$d_menus;
                    $this->load->view('common/title');
                    $this->load->view('common/header',$data);
                    $this->load->view('common/javascript',$data);
                    $this->load->view('directorys/librarian_edit',$data);
                    $this->load->view('common/footer');
                }    
            }else{
                //$this->load->view('common/title');
		$this->load->view('pages/login');
		//$this->load->view('common/footer');
            }
	}
        public function del()
	{
           // unset($_SESSION['user_id']);
            if(isset($_SESSION['user_id'])){
                if(isset($_GET['id'])){
                    $data= array(); 

                    $data['menu_main']=$this->menu_model->get_menu_main();
                    $data['librarian_type']=$this->librarians_model->get_librarian_type();
                    $librarian_data=$this->librarians_model->get_librarian_id($_GET['id']);
                    $data['departament']=$this->librarys_model->get_departament();
                    $data['privilege']=$this->login_model->get_privilege();

                    foreach($librarian_data as $ld){
                        $d_menus['user_id']=$ld['user_id'];
                        $d_menus['user_name']= str_replace('"', '`', $ld['user_name']);
                        $d_menus['user_fname']= str_replace('"', '`', $ld['user_fname']);
                        $d_menus['user_libr']=$ld['user_libr'];
                        $d_menus['user_login']=$ld['user_login'];
                        $d_menus['user_email']=$ld['user_email'];
                        $d_menus['user_priv']=$ld['user_priv'];
                        $d_menus['user_dep']=$ld['user_dep'];
                    }
                    $data['readonly']="readonly";
                    $data['librarian_datas']=$d_menus;
                    $this->load->view('common/title');
                    $this->load->view('common/header',$data);
                    $this->load->view('common/javascript',$data);
                    $this->load->view('directorys/librarian_edit',$data);
                    $this->load->view('common/footer');
                }    
            }else{
                //$this->load->view('common/title');
		$this->load->view('pages/login');
		//$this->load->view('common/footer');
            }
	}
        
            public function save()
	{
           // unset($_SESSION['user_id']);
            if(isset($_SESSION['user_id'])){
              //  print_r($_POST);
                if (isset($_POST['user_id'])){
                        $user_id=$_POST['user_id'];
                        $user_name= str_replace('"', '`', $_POST['user_name']);
                        $user_fname= str_replace('"', '`', $_POST['user_fname']);
                        $user_libr=$_POST['user_libr'];
                        $user_login=$_POST['user_login'];
                        $user_email=$_POST['user_email'];
                        $user_priv=$_POST['user_priv'];
                        $user_dep=$_POST['user_dep'];
                        
                   if($_POST['user_id']==0){
                        $res=$this->librarians_model->librarian_insert($user_id,$user_name,$user_fname,$user_libr,$user_login,$user_email,$user_priv,$user_dep);
                        echo 'Дані додано';
                    }else{
                        $res=$this->librarians_model->librarian_edit($user_id,$user_name,$user_fname,$user_libr,$user_login,$user_email,$user_priv,$user_dep);
                        echo 'Дані оновлено';
                    }
                }
            }else{
                //$this->load->view('common/title');
		$this->load->view('pages/login');
		//$this->load->view('common/footer');
            }
            header("Location: ".base_url()."Librarians"); exit;
	}

}

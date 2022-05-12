<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Librarys extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('url');
                $this->load->model('menu_model');
                $this->load->model('librarys_model');
      	}
        
    public function index()
	{
           // unset($_SESSION['user_id']);
            if(isset($_SESSION['user_id'])){
                $data= array(); 
                $d_menus=array();
                $data['menu_main']=$this->menu_model->get_menu_main();
                $data['librarys']=$this->librarys_model->get_library();
                
                //print_r(print_r($datas));
                $this->load->view('common/title');
		$this->load->view('common/header',$data);
		$this->load->view('common/javascript',$data);
		$this->load->view('directorys/library',$data);
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
                $data['library_type']=$this->librarys_model->get_library_type();
                
                $d_menus['library_id']=0;
                $d_menus['library_name']='';
                $d_menus['library_type']=2;
                $d_menus['library_sity_type']='';
                $d_menus['library_sity']='';
                $d_menus['library_address']='';
                
                $data['readonly']="";

                $data['library_datas']=$d_menus;
                $this->load->view('common/title');
		$this->load->view('common/header',$data);
		$this->load->view('common/javascript',$data);
		$this->load->view('directorys/library_edit',$data);
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
                    $data['library_type']=$this->librarys_model->get_library_type();
                    $library_data=$this->librarys_model->get_library_id($_GET['id']);


                    foreach($library_data as $ld){
                        $d_menus['library_id']=$ld['library_id'];
                        $d_menus['library_name']= str_replace('"', '`', $ld['library_name']);
                        $d_menus['library_type']=$ld['liibrary_type'];
                        $d_menus['library_sity_type']=$ld['library_sity_type'];
                        $d_menus['library_sity']=$ld['library_sity'];
                        $d_menus['library_address']=$ld['library_address'];
                    }
                    
                    $data['readonly']="";
                    $data['library_datas']=$d_menus;
                    $this->load->view('common/title');
                    $this->load->view('common/header',$data);
                    $this->load->view('common/javascript',$data);
                    $this->load->view('directorys/library_edit',$data);
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
                    $data['library_type']=$this->librarys_model->get_library_type();
                    $library_data=$this->librarys_model->get_library_id($_GET['id']);


                    foreach($library_data as $ld){
                        $d_menus['library_id']=$ld['library_id'];
                        $d_menus['library_name']= str_replace('"', '`', $ld['library_name']);
                        $d_menus['library_type']=$ld['liibrary_type'];
                        $d_menus['library_sity_type']=$ld['library_sity_type'];
                        $d_menus['library_sity']=$ld['library_sity'];
                        $d_menus['library_address']=$ld['library_address'];
                    }
                    $data['readonly']="readonly";
                    $data['library_datas']=$d_menus;
                    $this->load->view('common/title');
                    $this->load->view('common/header',$data);
                    $this->load->view('common/javascript',$data);
                    $this->load->view('directorys/library_edit',$data);
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
                print_r($_POST);
                if (isset($_POST['library_id'])){
                	$library_id=$_POST['library_id'];
                        $library_name=$_POST['library_name'];
                        $library_type=$_POST['library_type'];
                        $library_sity_type=$_POST['library_sity_type'];
                        $library_sity=$_POST['library_sity'];
                        $library_address=$_POST['library_address'];
                        
                    if($_POST['library_id']==0){
                        $res=$this->librarys_model->library_insert($library_id,$library_name,$library_type,$library_sity_type,$library_sity,$library_address);
                        echo 'Дані додано';
                    }else{
                        $res=$this->librarys_model->library_edit($library_id,$library_name,$library_type,$library_sity_type,$library_sity,$library_address);
                        echo 'Дані оновлено';
                    }
                }
            }else{
                //$this->load->view('common/title');
		$this->load->view('pages/login');
		//$this->load->view('common/footer');
            }
            header("Location: ".base_url()."Librarys"); exit;
	}

}

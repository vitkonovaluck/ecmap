<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('url');
                $this->load->model('menu_model');
      	}
        
    public function index()
	{
           // unset($_SESSION['user_id']);
            if(isset($_SESSION['user_id'])){
                $data= array(); 
                $d_menus=array();
                $data['menu_main']=$this->menu_model->get_menu_main();
                $data['menu_datas']=$this->menu_model->get_menu();
                
                //print_r(print_r($datas));
                $this->load->view('common/title');
		$this->load->view('common/header',$data);
		$this->load->view('common/javascript',$data);
		$this->load->view('directorys/menu',$data);
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
                $data['menu_datas']=$this->menu_model->get_menu();
                
                $d_menus['menu_id']=0;
                $d_menus['menu_parrent']=0;
                $d_menus['menu_name']='';
                $d_menus['menu_sort']='';
                $d_menus['menu_url']='';
                $d_menus['menu_priv']='';

                $data['menu_datas']=$d_menus;
                $this->load->view('common/title');
		$this->load->view('common/header',$data);
		$this->load->view('common/javascript',$data);
		$this->load->view('directorys/menu_edit',$data);
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
                $data= array(); 
                
                $data['menu_main']=$this->menu_model->get_menu_main();
                $data['menu_all']=$this->menu_model->get_menu();
                $menu_datas=$this->menu_model->get_menu_edit($_GET['id']);
                foreach($menu_datas as $md){
                    $d_menus['menu_id']=$md['menu_id'];
                    $d_menus['menu_parrent']=$md['menu_parrent'];
                    $d_menus['menu_name']=$md['menu_name'];
                    $d_menus['menu_sort']=$md['menu_sort'];
                    $d_menus['menu_url']=$md['menu_url'];
                    $d_menus['menu_priv']=$md['menu_priv'];
                }
                
                $data['menu_datas']=$d_menus;
                $this->load->view('common/title');
		$this->load->view('common/header',$data);
		$this->load->view('common/javascript',$data);
		$this->load->view('directorys/menu_edit',$data);
		$this->load->view('common/footer');
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
                
                if (isset($_POST['menu_id'])){
                	$menu_id=$_POST['menu_id'];
                        $menu_parrent=$_POST['menu_parrent'];
                        $menu_name=$_POST['menu_name'];
                        $menu_sort=$_POST['menu_sort'];
                        $menu_icon=$_POST['menu_icon'];
                        $menu_url =$_POST['menu_url'];
                        $menu_priv=$_POST['menu_priv'];
                        echo $_POST['menu_id'];
                    if($_POST['menu_id']==0){
                        $res=$this->menu_model->menu_insert($menu_id,$menu_parrent,$menu_name,$menu_sort,$menu_icon,$menu_url,$menu_priv);
                        echo 'Дані додано';
                    }else{
                        $res=$this->menu_model->menu_edit($menu_id,$menu_parrent,$menu_name,$menu_sort,$menu_icon,$menu_url,$menu_priv);
                        echo 'Дані оновлено';
                    }
                }
            }else{
                //$this->load->view('common/title');
		$this->load->view('pages/login');
		//$this->load->view('common/footer');
            }
            header("Location: ".base_url()."Menu"); exit;
	}

}

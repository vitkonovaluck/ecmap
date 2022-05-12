<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documents extends CI_Controller {

    public $CI = NULL;
    
    function __construct()
	{
		parent::__construct();
                $this->CI = & get_instance();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->database();
                $this->load->model('journal_model');
                $this->load->model('document_model');
                $this->load->model('menu_model');
                $this->load->model('librarians_model');
		$this->load->helper('url');
	}

	public function index()
	{
            if(!isset($_SESSION['sw'])){
            $_SESSION['sw']=1366;
            $_SESSION['sh']=768; 
            }
            if(isset($_COOKIE['sw'])) {$_SESSION['sw']=$_COOKIE['sw'];}
            if(isset($_COOKIE['sh'])) {$_SESSION['sh']=$_COOKIE['sh'];}
            if(isset($_SESSION['user_id'])){
                $max_wi=1485;
                if($_SESSION['sw']>$max_wi){
                    $koof=1;
                }elseif($_SESSION['sw']>($max_wi/2)){
                    $koof=2;                    
                }elseif($_SESSION['sw']>($max_wi/3)){
                    $koof=3;                    
                }else{
                    $koof=4;
                    
                }
                if(isset($_GET['id'])){
                    $data['hgth']=$_SESSION['sh']-$koof*42-56-45;
                    $data['readonly_doc']="";
                    $data['menu_main']=$this->menu_model->get_menu_main();
                    $data['librarians']=$this->librarians_model->get_librarian('');
                    //Визначаємо документ
                    ////Загрузка даннихъ документа /////////////////
                    $doc_title=$this->journal_model->get_journal(' and journal_id =  '.$_GET['id']);
                    foreach($doc_title as $doc_t){
                        $dt_id = $doc_t['document_id'];
                        $data['doc_data']=$this->document_model->get_doc_data($doc_t['journal_id']);
                    }
                    $data['doc_title']=$doc_title;
                    
                    $data['formula_validat']= $this->document_model->formula_validat($dt_id);
                    
                    ///////////////////////////////////////////////
                    ///Структура документу////
                    $doc_group= $this->document_model->get_doc_group($dt_id);
                    $data['doc_group']= $doc_group;
                    $doc_sect=array();
                    foreach ($doc_group as $doc_gr){
                        $doc_section= $this->document_model->get_doc_section($doc_gr['id']);
                        $doc_sect[$doc_gr['id']]=$doc_section;
                        foreach ($doc_section as $doc_sct){
                            $doc_fields=$this->document_model->get_doc_fields($doc_gr['id'],$doc_sct['id']);
                            $doc_field[$doc_sct['id']]=$doc_fields;
                        }
                    }
                    $doc_datas= $this->document_model->get_doc_data($_GET['id']);
                    $doc_data=array();
                    foreach ($doc_datas as $ddata) {
                        $doc_data[$ddata['dd_fieldsid']] = $ddata['dd_values'];
                    }
                    $data['doc_sect']= $doc_sect;
                    $data['doc_field']= $doc_field;
                    $data['doc_data']= $doc_data;
                    ////////////////////////////////////////////////
           
                    $this->load->view('common/title');
                    $this->load->view('common/header',$data);
                    $this->load->view('common/javascript',$data);

                    $this->load->view('document/javascript',$data);

                    $this->load->view('document/main',$data);
                    $this->load->view('common/footer');
                }else{
                    header ('Location:'.base_url());  // перенаправление на нужную страницу
                    exit();
                }
           }else {
		$this->load->view('pages/login');
                           
            
           }    
			
	}

        
        public function save_doc()
        {  
            
            if(isset($_POST['datas'])){
                $datas = explode("&", $_POST['datas']);
                for($i=0;$i<count($datas);$i++){ 
                    $dat = explode("=", $datas[$i]);
                    //echo $_GET['id'].":".$dat[0]."=".$dat[1]."<br>";
                    $this->document_model->put_doc_data($_GET['id'],$dat);
                }
                //echo '<br><h1>'.$_POST['datas'].'</h1><br>';    
            }elseif(isset($_GET['datas'])){
                $datas = explode("&", $_GET[1]);
                for($i=0;$i<count($datas);$i++){ 
                    $dat = explode("=", $datas[$i]);
                    $this->document_model->put_doc_data($_GET['id'],$dat);
                }
                echo '<br><h1>'.$_GET['id'].'</h1><br>'; 
             }else{ 
               echo '<br><h1>NO1</h1><br>';    
           } 
        }
               
        public function create()
	{
            if(isset($_SESSION['user_id']) && ($_SESSION['user_priv']>1)){
                $data['menu_main']=$this->menu_model->get_menu_main();
                $data['docs']=$this->document_model->get_documents();
                
                //Визначаємо документ
                $this->load->view('common/title');
		$this->load->view('common/header',$data);
		$this->load->view('common/javascript',$data);
                
                $this->load->view('document/javascript',$data);
		
		$this->load->view('document/create',$data);
		$this->load->view('common/footer');
           }else {
		$this->load->view('pages/login');
               
           }    
	
        }
        
        public function create_doc()
	{
            if(isset($_SESSION['user_id']) && ($_SESSION['user_priv']>1)){
                
                if(isset($_POST['doc_create'])){
                    $period_id = $this->document_model->get_period($_POST['periods']);
                    
                    $librarians =  $this->librarians_model->get_librarian(' dep_id '.$this->document_model->get_document_dep_report($_POST['document']).' and ');
                    //$this->db->query("TRUNCATE journal");
                    foreach($librarians as $libr){
                        
                        if($this->document_model->check_document($period_id,$_POST['document'],$libr['user_id'],$libr['library_id'],$libr['user_dep']) == 0){
                            echo '<br>створити документ для бібліотеки '.$libr['library_name'];
                            $this->document_model->add_document($period_id,$_POST['document'],$libr['user_id'],$libr['library_id'],$libr['user_dep'],$_POST['prim']);
                        }
                    }
                  
                    echo $period_id;
                    header("Location: ".base_url()); exit;
                }   
           }else {
		$this->load->view('pages/login');
               
           }    
	
        }
        
        
        public function title_doc()
	{
            if(isset($_SESSION['user_id'])){
                if(isset($_GET['id'])){
                    $data['doc_title']=$this->journal_model->get_journal(' and journal_id =  '.$_GET['id']);
                    //echo print_r($doc_title);
                    $this->load->view('document/title_doc',$data);
                }
           }else {
		$this->load->view('pages/login');
               
           }    
	
        }    
    
        public function send_doc()
	{
            if(isset($_SESSION['user_id'])){
                if(isset($_GET['id'])){
                    return $this->document_model->send_doc($_GET['id']);
        
                }
            }    
        }
        
        public function back_doc()
	{
            if(isset($_SESSION['user_id'])){
                if(isset($_GET['id'])){
                    return $this->document_model->back_doc($_GET['id']);
        
                }
            }    
        }
        
        public function accept_doc()
	{
            if(isset($_SESSION['user_id'])){
                if(isset($_GET['id'])){
                    return $this->document_model->accept_doc($_GET['id']);
        
                }
            }    
        }
        
        public function user_privilege($uid) {
            if(isset($_SESSION['user_id'])){
                
                    return $this->librarians_model->librarian_privilege($uid);
        
            }
        }
}

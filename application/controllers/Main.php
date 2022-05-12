<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('url');
                $this->load->model('journal_model');
                $this->load->model('document_model');
                $this->load->model('librarians_model');
                $this->load->model('librarys_model');
                $this->load->model('period_model');
                $this->load->model('menu_model');
	}

	public function index()
	{
           // unset($_SESSION['user_id']);
            if(isset($_SESSION['user_id'])){
                $data= array(); 
                $filter="";
                
                if(!isset($_SESSION['fltr_doc'])){$_SESSION['fltr_doc']=0;}
                if(!isset($_SESSION['fltr_period'])){$_SESSION['fltr_period']=0;}
                if(!isset($_SESSION['fltr_libr'])){$_SESSION['fltr_libr']=0;}
                if(!isset($_SESSION['fltr_status'])){$_SESSION['fltr_status']=0;}  
                
                if(isset($_GET['fltr_doc'])){
                    $_SESSION['fltr_doc']=$_GET['fltr_doc'];
                }    
                if(isset($_POST['filter'])){
                       $_SESSION['fltr_doc']=$_POST['fltr_doc'];
                       $_SESSION['fltr_period']=$_POST['fltr_period'];
                       $_SESSION['fltr_libr']=$_POST['fltr_libr'];
                       $_SESSION['fltr_status']=$_POST['fltr_status'];
                    
                }
                if(isset($_POST['filters'])){
                    $_SESSION['fltr_doc']=0;
                    $_SESSION['fltr_period']=0;
                    $_SESSION['fltr_libr']=0;
                    $_SESSION['fltr_status']=0;
                
                }
                
                    if($_SESSION['fltr_doc']>0){
                       $filter.=" and journal_doc in (".$_SESSION['fltr_doc'].")";
                    }
                    if($_SESSION['fltr_period']>0){
                       $filter.=" and journal_period in (".$_SESSION['fltr_period'].")";
                    }
                    if($_SESSION['fltr_libr']>0){
                       $filter.=" and journal_library in (".$_SESSION['fltr_libr'].")";
                    }
                    if($_SESSION['fltr_status']>0){
                       $filter.=" and journal_status in (".$_SESSION['fltr_status'].")";
                    }
                $data['menu_main']=$this->menu_model->get_menu_main();
                $librarians =$this->librarians_model->get_librarian('');
                $libr_fl="0";
                foreach ($librarians as $libr){
                    $libr_fl.=",".$libr['library_id'];
                }
                
                $filter.=" and journal_library in (".$libr_fl.")";
                $data['librarians_doc']=$librarians;
                
                
                $data['document_doc'] =$this->document_model->get_documents();
                $data['library_doc'] =$this->librarys_model->get_library(' and library_id in('.$libr_fl.')');
                $data['period_doc'] =$this->period_model->get_period();
                $data['status_doc'] =$this->document_model->get_doc_status();
                
                
                $data['journal_doc']=$this->journal_model->get_journal($filter);
                
                $this->load->view('common/title');
		$this->load->view('common/javascript',$data);
                $this->load->view('common/header',$data);
		$this->load->view('common/main',$data);
		$this->load->view('common/footer');
            }else{
                //$this->load->view('common/title');
		$this->load->view('pages/login');
		//$this->load->view('common/footer');
            }
	}
}

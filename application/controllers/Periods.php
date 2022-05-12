<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periods extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('url');
	}

	public function index()
	{
	   //unset($_SESSION['period']);
	   if(!isset($_SESSION['period'])){
	 		$_SESSION['period']=date("Y-m-d");
	 		$_SESSION['periods']=date('Y-m-01', strtotime('-60 days'));
	 	}

                $data['period1']=$_SESSION['periods'];
                $data['period2']=$_SESSION['period'];


                $this->load->view('common/title');
		$this->load->view('pages/periods',$data);
		
	}
        public function changes()
        {  
            if(isset($_POST['period'])){
                if($_POST['period']==2){
           //         echo $_POST['date1']." ".$_POST['date1'];
	 		$_SESSION['periods']=$_POST['date1'];
	 		$_SESSION['period']=$_POST['date2'];                    
                }
            }
            
            $burl = base_url();
            header ('Location: ../../index.php');  // перенаправление на нужную страницу
            exit();
        }
}

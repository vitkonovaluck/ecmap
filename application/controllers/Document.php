<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->database();
                $this->load->model('journal_model');
                $this->load->model('document_model');
                $this->load->model('client_model');
                $this->load->model('login_model');
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
		$this->load->view('common/header',$data);
		$this->load->view('common/javascript',$data);
                
                   $this->load->view('document/javascript',$data);
		
//		$this->load->view('common/main',$data);
		$this->load->view('common/footer');
			
	}

        public function act()
        {  
            $data['doc'] = 1;
            if(isset($_GET['id'])){
                $data['d_clients']=$this->client_model->all_clients();
                if($_GET['id'] == 0){
                   $data['d_id']=0; 
                   $data['d_numb']=$this->document_model->new_doc($data['doc']);
                   $data['d_date']=date('Y-m-d');
                   $data['d_client']=0;
                   $data['d_dogovir']=0;
                   $data['d_dogovirs']=0;
                   $data['d_sum']=0;
                   $data['d_prim']="";
                    
                }else{
                   $sdoc= $this->document_model->sel_doc($_GET['id']);
                   foreach($sdoc as $doc){
                       if(strlen($doc['journal_numb'])==0){
                           $numb=1;
                       }else{
                        $numb = $doc['journal_numb'];}
                        $data['d_id']=$doc['journal_id'];
                        $data['d_numb']=$numb;
                        $data['d_date']=$doc['journal_date'];
                        $data['d_client']=$doc['journal_client'];
                        $data['d_sum']=$doc['jurnal_sum'];
                        $data['d_prim']=$doc['journal_note'];
                        $data['d_dogovir']=$this->document_model->dogovir_by_doc($doc['journal_id']);
                        $data['d_dogovirs']=$this->document_model->all_dogovir_clients($doc['journal_client']);
                   
                   } 
                }
                if(!isset($_GET['dialog'])){
                    $this->load->view('common/title');
                  //  $this->load->view('common/header',$data);
                }
                $this->load->view('document/javascript',$data);
		$this->load->view('document/act',$data);
		//$*this->load->view('common/footer');
            }else{
             header ('Location: ../../index.php');  // перенаправление на нужную страницу
             exit();   
            }
        }
        
        public function act_copy()
        {  
            $data['doc'] = 1;
            if(isset($_GET['id'])){
                $data['d_clients']=$this->client_model->all_clients();
                if($_GET['id'] == 0){
                   $data['d_id']=0; 
                   $data['d_numb']=$this->document_model->new_doc($data['doc']);
                   $data['d_date']=date('Y-m-d');
                   $data['d_client']=0;
                   $data['d_sum']=0;
                   $data['d_prim']="";
                   $data['d_dogovir']=0;
                   $data['d_dogovirs']=0;
                    
                }else{
                   $sdoc= $this->document_model->sel_doc($_GET['id']);
                   foreach($sdoc as $doc){
                       if(strlen($doc['journal_numb']) == 0){
                           $numb=1;
                       }else{$numb = $doc['journal_numb'];}
                        $data['d_id']=0;
                        $data['d_numb']=$this->document_model->new_doc($data['doc']);
                        $data['d_date']=date('Y-m-d');
                        $data['d_client']=$doc['journal_client'];
                        $data['d_sum']=$doc['jurnal_sum'];
                        $data['d_prim']=$doc['journal_note'];
                        $data['d_dogovir']=$this->document_model->dogovir_by_doc($doc['journal_id']);
                        $data['d_dogovirs']=$this->document_model->all_dogovir_clients($doc['journal_client']);
                  } 
                }
                if(!isset($_GET['dialog'])){
                    $this->load->view('common/title');
                  //  $this->load->view('common/header',$data);
                }
                $this->load->view('document/javascript',$data);
		$this->load->view('document/act',$data);
		//$this->load->view('common/footer');
            }else{
             header ('Location: ../../index.php');  // перенаправление на нужную страницу
             exit();   
            }
        }
        
        public function count()
        {  
            $data['doc'] = 2;
            if(isset($_GET['id'])){
                $data['d_clients']=$this->client_model->all_clients();
                if($_GET['id'] == 0){
                   $data['d_id']=0; 
                   $data['d_numb']=$this->document_model->new_doc($data['doc']);
                   $data['d_date']=date('Y-m-d');
                   $data['d_client']=0;
                   $data['d_sum']=0;
                   $data['d_prim']="";
                   $data['d_dogovir']=0;
                   $data['d_dogovirs']=0;
                    
                }else{
                   $sdoc= $this->document_model->sel_doc($_GET['id']);
                   foreach($sdoc as $doc){
                       if(strlen($doc['journal_numb'])==0){
                           $numb=1;
                       }else{$numb = $doc['journal_numb'];}
                        $data['d_id']=$doc['journal_id'];
                        $data['d_numb']=$numb;
                        $data['d_date']=$doc['journal_date'];
                        $data['d_client']=$doc['journal_client'];
                        $data['d_sum']=$doc['jurnal_sum'];
                        $data['d_prim']=$doc['journal_note'];
                        $data['d_dogovir']=0;
                        $data['d_dogovirs']=0;
                   } 
                }
                if(!isset($_GET['dialog'])){
                    $this->load->view('common/title');
                  //  $this->load->view('common/header',$data);
                }
                $this->load->view('document/javascript',$data);
		$this->load->view('document/count',$data);
		//$this->load->view('common/footer');
            }else{
             header ('Location: ../../index.php');  // перенаправление на нужную страницу
             exit();   
            }
        }
        
        public function count_copy()
        {  
            $data['doc'] = 2;
            if(isset($_GET['id'])){
                $data['d_clients']=$this->client_model->all_clients();
                if($_GET['id'] == 0){
                   $data['d_id']=0; 
                   $data['d_numb']=$this->document_model->new_doc($data['doc']);
                   $data['d_date']=date('Y-m-d');
                   $data['d_client']=0;
                   $data['d_sum']=0;
                   $data['d_prim']="";
                   $data['d_dogovir']=0;
                   $data['d_dogovirs']=0;
                    
                }else{
                   $sdoc= $this->document_model->sel_doc($_GET['id']);
                   foreach($sdoc as $doc){
                       if(strlen($doc['journal_numb']) == 0){
                           $numb=1;
                       }else{$numb = $doc['journal_numb'];}
                        $data['d_id']=0;
                        $data['d_numb']=$this->document_model->new_doc($data['doc']);
                        $data['d_date']=date('Y-m-d');
                        $data['d_client']=$doc['journal_client'];
                        $data['d_sum']=$doc['jurnal_sum'];
                        $data['d_prim']=$doc['journal_note'];
                        $data['d_dogovir']=0;
                        $data['d_dogovirs']=0;
                   
                   } 
                }
                if(!isset($_GET['dialog'])){
                    $this->load->view('common/title');
                  //  $this->load->view('common/header',$data);
                }
                $this->load->view('document/javascript',$data);
		$this->load->view('document/count',$data);
		//$this->load->view('common/footer');
            }else{
             header ('Location: ../../index.php');  // перенаправление на нужную страницу
             exit();   
            }
        }
        
        public function dogov()
        {  
            $data['doc'] = 4;
            if(isset($_GET['id'])){
                $data['d_clients']=$this->client_model->all_clients();
                if($_GET['id'] == 0){
                   $data['d_id']=0; 
                   $data['d_numb']=$this->document_model->new_doc($data['doc']);
                   $data['d_date']=date('Y-m-d');
                   $data['d_client']=0;
                   $data['d_sum']=0;
                   $data['d_prim']="";
                   $data['d_dogovir']=0;
                   $data['d_dogovirs']=0;
                    
                }else{
                   $sdoc= $this->document_model->sel_doc($_GET['id']);
                   foreach($sdoc as $doc){
                       if(strlen($doc['journal_numb'])==0){
                           $numb=1;
                       }else{$numb = $doc['journal_numb'];}
                        $data['d_id']=$doc['journal_id'];
                        $data['d_numb']=$numb;
                        $data['d_date']=$doc['journal_date'];
                        $data['d_client']=$doc['journal_client'];
                        $data['d_sum']=$doc['jurnal_sum'];
                        $data['d_prim']=$doc['journal_note'];
                        $data['d_dogovir']=0;
                        $data['d_dogovirs']=0;
                   } 
                }
                if(!isset($_GET['dialog'])){
                    $this->load->view('common/title');
                  //  $this->load->view('common/header',$data);
                }
                $this->load->view('document/javascript',$data);
		$this->load->view('document/dogov',$data);
		//$this->load->view('common/footer');
            }else{
             header ('Location: ../../index.php');  // перенаправление на нужную страницу
             exit();   
            }
        }
        
        public function dogov_copy()
        {  
            $data['doc'] = 4;
            if(isset($_GET['id'])){
                $data['d_clients']=$this->client_model->all_clients();
                if($_GET['id'] == 0){
                   $data['d_id']=0; 
                   $data['d_numb']=$this->document_model->new_doc($data['doc']);
                   $data['d_date']=date('Y-m-d');
                   $data['d_client']=0;
                   $data['d_sum']=0;
                   $data['d_prim']="";
                   $data['d_dogovir']=0;
                   $data['d_dogovirs']=0;
                    
                }else{
                   $sdoc= $this->document_model->sel_doc($_GET['id']);
                   foreach($sdoc as $doc){
                       if(strlen($doc['journal_numb']) == 0){
                           $numb=1;
                       }else{$numb = $doc['journal_numb'];}
                        $data['d_id']=0;
                        $data['d_numb']=$this->document_model->new_doc($data['doc']);
                        $data['d_date']=date('Y-m-d');
                        $data['d_client']=$doc['journal_client'];
                        $data['d_sum']=$doc['jurnal_sum'];
                        $data['d_prim']=$doc['journal_note'];
                        $data['d_dogovir']=0;
                        $data['d_dogovirs']=0;
                   } 
                }
                if(!isset($_GET['dialog'])){
                    $this->load->view('common/title');
                  //  $this->load->view('common/header',$data);
                }
                $this->load->view('document/javascript',$data);
		$this->load->view('document/dogov',$data);
		//$this->load->view('common/footer');
            }else{
             header ('Location: ../../index.php');  // перенаправление на нужную страницу
             exit();   
            }
        }
        
        public function nakl()
        {  
            $data['doc'] = 3;
            if(isset($_GET['id'])){
                $data['d_clients']=$this->client_model->all_clients();
                if($_GET['id'] == 0){
                   $data['d_id']=0; 
                   $data['d_numb']=$this->document_model->new_doc($data['doc']);
                   $data['d_date']=date('Y-m-d');
                   $data['d_client']=0;
                   $data['d_sum']=0;
                   $data['d_prim']="";
                   $data['d_dogovir']=0;
                   $data['d_dogovirs']=0;
                     
                }else{
                   $sdoc= $this->document_model->sel_doc($_GET['id']);
                   foreach($sdoc as $doc){
                       if(strlen($doc['journal_numb'])==0){
                           $numb=1;
                       }else{$numb = $doc['journal_numb'];}
                        $data['d_id']=$doc['journal_id'];
                        $data['d_numb']=$numb;
                        $data['d_date']=$doc['journal_date'];
                        $data['d_client']=$doc['journal_client'];
                        $data['d_sum']=$doc['jurnal_sum'];
                        $data['d_prim']=$doc['journal_note'];
                   $data['d_dogovir']=0;
                   $data['d_dogovirs']=0;
                   } 
                }
                if(!isset($_GET['dialog'])){
                    $this->load->view('common/title');
                  //  $this->load->view('common/header',$data);
                }
                $this->load->view('document/javascript',$data);
		$this->load->view('document/nakl',$data);
		//$this->load->view('common/footer');
            }else{
             header ('Location: ../../index.php');  // перенаправление на нужную страницу
             exit();   
            }
        }
        
        public function nakl_copy()
        {  
            $data['doc'] = 3;
            if(isset($_GET['id'])){
                $data['d_clients']=$this->client_model->all_clients();
                if($_GET['id'] == 0){
                   $data['d_id']=0; 
                   $data['d_numb']=$this->document_model->new_doc($data['doc']);
                   $data['d_date']=date('Y-m-d');
                   $data['d_client']=0;
                   $data['d_sum']=0;
                   $data['d_prim']="";
                   $data['d_dogovir']=0;
                   $data['d_dogovirs']=0;
                    
                }else{
                   $sdoc= $this->document_model->sel_doc($_GET['id']);
                   foreach($sdoc as $doc){
                       if(strlen($doc['journal_numb']) == 0){
                           $numb=1;
                       }else{$numb = $doc['journal_numb'];}
                        $data['d_id']=0;
                        $data['d_numb']=$this->document_model->new_doc($data['doc']);
                        $data['d_date']=date('Y-m-d');
                        $data['d_client']=$doc['journal_client'];
                        $data['d_sum']=$doc['jurnal_sum'];
                        $data['d_prim']=$doc['journal_note'];
                   $data['d_dogovir']=0;
                   $data['d_dogovirs']=0;
                   } 
                }
                if(!isset($_GET['dialog'])){
                    $this->load->view('common/title');
                  //  $this->load->view('common/header',$data);
                }
                $this->load->view('document/javascript',$data);
		$this->load->view('document/nakl',$data);
		//$this->load->view('common/footer');
            }else{
             header ('Location: ../../index.php');  // перенаправление на нужную страницу
             exit();   
            }
        }        
        
        public function save_doc()
        {  
           if(isset($_POST['doc_type'])){
               $numb = ltrim(str_replace("ФП-0" , "" , $_POST['doc_numb']),'0');
               $doc_sum= str_replace("'","", $_POST['doc_sum']);
               $year = date("Y",strtotime($_POST['doc_date']));
               
                if ($_POST['doc_id'] > 0){
                    $cur_stat = $this->document_model->status_doc_id($_POST['doc_id']);
                    $max_stat = $this->document_model->status_doc_max($_POST['doc_id']);
                    $doc_id = $_POST['doc_id'];
                    if($cur_stat <= $max_stat){
                        $sdoc = $this->document_model->upd_doc($_POST['doc_id'],$numb,$_POST['doc_date'],$_POST['doc_client'],$doc_sum,$_POST['doc_note']);
                    }
                }else{               
               //insert
                    $chdoc = $this->document_model->check_doc($_POST['doc_type'],$numb,$year);
                    if($chdoc == 0){
                        $sdoc = $this->document_model->ins_doc($_POST['doc_type'],$numb,$_POST['doc_date'],$_POST['doc_client'],$doc_sum);
                        $doc_id = $sdoc;
                        $sdoc = $this->document_model->upd_doc($sdoc,$numb,$_POST['doc_date'],$_POST['doc_client'],$doc_sum,$_POST['doc_note']);
                    }
                }
                $sdoc = $this->document_model->upd_dogov_client($doc_id,$_POST['doc_dogov']);
                
           }
            $burl = base_url();
            header ('Location: ../../index.php');  // перенаправление на нужную страницу
            exit();
        }
               
        public function change_status()
        {  
           if(isset($_GET['id'])){
               $sdoc = $this->document_model->info_doc($_GET['id']);      
               $data['doc_id']=$_GET['id'];
               foreach($sdoc as $doc){
                   $data['doc_name']=$doc['doc_name']." № <b>".$doc['journal_numb']."</b> від <b>".$doc['journal_date']."</b>";
                   $data['old_stat']=$doc['status_name'];
                   $stat=$doc['status_id'];
               }
               $data['old_stat_id']=$stat;
               $data['new_stat_id']=$stat+1;
               $data['new_stat'] = $this->document_model->status_doc_name($data['new_stat_id']);
                if(!isset($_GET['dialog'])){
                    $this->load->view('common/title');
                  //  $this->load->view('common/header',$data);
                }
                $this->load->view('common/javascript',$data);
		$this->load->view('pages/status',$data);
           }
            //header ('Location: ../../index.php');  // перенаправление на нужную страницу
            //exit();
        }
        
        public function change_client()
        {  
           if(isset($_POST['id'])){
               $id = $_POST['id'];
           }else if(isset($_GET['id'])){
               $id = $_GET['id'];
           }else{
                $id = 0;
           }
           if ($id >0){
               
                $data['d_dogovirs']=$this->document_model->all_dogovir_clients($id);
                $this->load->view('pages/dogovirs',$data);
                  
           }
            //header ('Location: ../../index.php');  // перенаправление на нужную страницу
            //exit();
        }
        
        public function changes_status()
        {  
           if(isset($_POST['doc_id'])){
                $user = $this->login_model->admin_check($_POST['passw']);
                
                if($user == 1){
                    $d = $this->document_model->status_update($_POST['doc_id'],$_POST['doc_os'],$_POST['doc_ns']);
                }
           }
            header ('Location: ../../index.php');  // перенаправление на нужную страницу
            //exit();
        }
        
        public function prints()
        {  
           if(isset($_GET['id'])){
               $data['photo'] = $this->document_model->doc_photo($_GET['id']);      
               $data['path']  = base_url()."../uploads/";

               if(!isset($_GET['dialog'])){
                    $this->load->view('common/title');
                  //  $this->load->view('common/header',$data);
                }
		$this->load->view('pages/print',$data);
           }
            //header ('Location: ../../index.php');  // перенаправление на нужную страницу
            //exit();
        }

        public function dogovora()
        {  
           if(isset($_GET['id'])){
                $data['dog_name'] = $this->document_model->name_doc($_GET['id']);      
              
                $d_rows = $this->document_model->docs_by_dogovir($_GET['id']);      
                $docs=array();
                foreach($d_rows as $doc){
                    $docs['doc_id'] = $doc['doc_id'];
                    $docs['doc_name'] = $this->document_model->name_doc($doc['doc_id']);
                }
                $data['d_dogovirs']= $docs;
                if(!isset($_GET['dialog'])){
                    $this->load->view('common/title');
                  //  $this->load->view('common/header',$data);
                }
		$this->load->view('pages/dogovora',$data);
           }
            //header ('Location: ../../index.php');  // перенаправление на нужную страницу
            //exit();
        }
        
        
}

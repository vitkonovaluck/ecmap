<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->database();
                $this->load->model('journal_model');
                $this->load->model('document_model');
                $this->load->model('period_model');
                $this->load->model('reports_model');
                $this->load->model('menu_model');
                $this->load->model('librarys_model');
		$this->load->helper('url');
	}

	public function index()
	{
	
	}
        
        public function nk()
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
                $data['hgth']=$_SESSION['sh']-$koof*42-56-45-337;
                $data['menu_main']=$this->menu_model->get_menu_main();
                $data['doc_status']=$this->document_model->get_doc_status();
                $data['type_libr']=$this->librarys_model->get_library_type();
                $data['librarys']=$this->librarys_model->get_library('');
                
                $data['period']=$this->period_model->get_period_by_doc(1);
                
                if(isset($_POST['do_repa'])){
                   
                    $filter=' AND 1=1';
                    //$data['period']=$this->journal_model->get_doc_by_rep();
                    if($_POST['status'] > 0){$filter .= ' and journal_status = '.$_POST['status'];}
                    if($_POST['type_libr'] > 0){$filter .= ' and journal_library in(select library_id from librarys where liibrary_type = '.$_POST['type_libr'].')';}
                    if($_POST['library'] > 0){$filter .= ' and journal_library = '.$_POST['library'];}
                    if($_POST['period'] > 0){$filter .= ' and journal_period = '.$_POST['period'];}
                    
                    $data['filter'] = 'status='.$_POST['status'].'$type_libr='.$_POST['type_libr'].'&library='.$_POST['library'].'&period='.$_POST['period'];
                    
                    $docs=$this->journal_model->get_journal($filter);
                    $libr_cnt=$this->librarys_model->get_library_count('');
                    
                    $did = "-1";
                    foreach ($docs as $doc){
                        $did.=','.$doc['journal_id'];                            
                    }
                                        
                    $data['stts']= 'Зформовано дані по '.  count($docs).' бібліотекам із '.$libr_cnt.'.' ;
                    $rep_title=$this->reports_model->get_title(1);
                    $data['rep_title']=$rep_title;
                    
                    $table_head1=array();
                    $table_head2=array();
                    $table_head3=array();
                    $table_col=array();
                    $rep_sum=array();
                    $rep_data=array();
                    foreach ($rep_title as $rept){
                        
                        $rep_fields=$this->reports_model->get_fields($rept['id']);
                        $cnt = count($rep_fields);
                        $table_cols=array();
                        $table_cols2=array();
                        for($j=1;$j<=$cnt;$j++){
                            $rep_sec = $this->reports_model->get_sections1($rept['id'],$j);
                            if(count($rep_sec) > 0 ){
                                foreach($rep_sec as $rs){
                                    $table_cols[$j]['name']   =$rs['name'];
                                    $table_cols[$j]['rowspan']=$rs['rowspan'];
                                    $table_cols[$j]['colspan']=$rs['colspan'];
                                    $table_cols[$j]['css']    =$rs['css'];
                                    $table_cols[$j]['style']  =$rs['style'];    
                                    $k=1;
                                    
                                    $rep_sec1 = $this->reports_model->get_sections2($rept['id'],$rs['id']);
                                    if(count($rep_sec1) > 0 ){
                                        foreach($rep_sec1 as $rs1){
                                            $table_cols2[$k]['name']   =$rs1['name'];
                                            $table_cols2[$k]['rowspan']=$rs1['rowspan'];
                                            $table_cols2[$k]['colspan']=$rs1['colspan'];
                                            $table_cols2[$k]['css']    =$rs1['css'];
                                            $table_cols2[$k]['style']  =$rs1['style'];    
                                            $k++;
                                        }    
                                    }
                                }    
                            }else{
                                $rep_fb=$this->reports_model->get_fields_by($rept['id'],$j);
                                foreach($rep_fb as $rfb){
                                    if(strlen($rfb['hksectionid']) == 0 ){
                                        $table_cols[$j]['name']   =$rfb['name'];
                                        $table_cols[$j]['rowspan']=3;
                                        $table_cols[$j]['colspan']=1;
                                        $table_cols[$j]['css']    =$rfb['css'];
                                        $table_cols[$j]['style']  =$rfb['style'];    
                                    }
                                }
                            }    
                        }
                        
                        $table_head1[$rept['id']]=$table_cols;
                        
                        $table_head2[$rept['id']]=$table_cols2;
                        
                        $j=1;
                        
                        $rep_fb=$this->reports_model->get_fields_by2($rept['id'],$j);
                        $table_cols3=array();
                        foreach($rep_fb as $rfb){
                            
                                $table_cols3[$j]['name']   =$rfb['name'];
                                $table_cols3[$j]['rowspan']=1;
                                $table_cols3[$j]['colspan']=1;
                                $table_cols3[$j]['css']    =$rfb['css'];
                                $table_cols3[$j]['style']  =$rfb['style'];    
                                $j++;
                        }    
                        $table_head3[$rept['id']]=$table_cols3;
                        for($j=1;$j<=$cnt;$j++){
                        $rep_sum[$rept['id']][$j]=$this->reports_model->get_fields_sum($rept['id'],$j,$did);
                        }
                        if(isset($_POST['detal'])){
                            $k = 0;
                            foreach ($docs as $dc){
                                $rep_data[$rept['id']][$k][0]=$dc['library_name'];
                                for($j=1;$j<=$cnt;$j++){
                                   $rep_data[$rept['id']][$k][$j]=$this->reports_model->get_fields_data($rept['id'],$j,$dc['journal_id']);
                                }
                                $k++;
                            }    
                        }
                        $table_col[$rept['id']] =$cnt; 
                    }
                    $data['rep_fields']=$rep_fields;
                    $data['table_head1']=$table_head1;
                    $data['table_head2']=$table_head2;
                    $data['table_head3']=$table_head3;
                    //$data['table_cols']=$table_cols;
                    $data['table_col']=$table_col;
                    $data['rep_sum']=$rep_sum;
                    $data['rep_data']=$rep_data;
                    
                }
                
                $this->load->view('common/title');
                $this->load->view('common/header',$data);
                $this->load->view('common/javascript',$data);

                $this->load->view('reports/javascript',$data);

                $this->load->view('reports/nk_header',$data);
                if(isset($_POST['do_repa'])){
                    $this->load->view('reports/nk_main',$data);
                }else{
                    $this->load->view('reports/null_report',$data);
                }
                $this->load->view('common/footer');
            
           }else {
		$this->load->view('pages/login');
                           
            
           }    
			
	
	}

       
        
        
}

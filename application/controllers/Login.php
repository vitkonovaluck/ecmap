<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('url');
                $this->load->model('login_model');
      	}

	public function index()
	{
            if(isset($_POST['login'])){
                $log=$this->login_model->login($_POST['login'],$_POST['pass']);
                if(isset($_COOKIE['sw'])) { $_SESSION['sw']=$_COOKIE['sw'];}
                if(isset($_COOKIE['sh'])) { $_SESSION['sh']=$_COOKIE['sh'];}
                if(count($log) == 1){
                    foreach($log as $lgn):
                        $_SESSION['user_id']=$lgn['user_id'];
                        $_SESSION['user_name']=$lgn['user_name'];
                        $_SESSION['user_priv']=$lgn['user_priv'];
                    endforeach;        
                    header ('Location: ../index.php');  // перенаправление на нужную страницу
                    exit();
                } else {
                    $this->load->view('pages/login');
                }
            }
	}
      
        public function js_login()
	{
            
            if(isset($_GET['login'])){
                $log=$this->login_model->login($_GET['login'],$_GET['pass']);
                if(count($log) == 1){
                    foreach($log as $lgn):
                        $_SESSION['user_id']=$lgn['user_id'];
                        $_SESSION['user_name']=$lgn['user_name'];
                        $_SESSION['user_priv']=$lgn['user_priv'];
                    endforeach;        
                    echo $_SESSION['user_id']; // перенаправление на нужную страницу
                    exit();
                } else {
                    echo 0;
                }
            }
	}
        
        public function app()
	{
            if(isset($_GET['login'])){
                $log=$this->login_model->login($_GET['login'],$_GET['pass']);
                if(count($log) == 1){
                    foreach($log as $lgn):
                        $_SESSION['user_id']=$lgn['user_id'];
                        $_SESSION['user_name']=$lgn['user_name'];                          
                    endforeach;  
                    echo $_SESSION['user_id'];
                } else {
                    echo '0';  
                }
            }
	}
                
        public function uname()
	{
            if(isset($_GET['login'])){
               $log=$this->login_model->user($_GET['login']);
                if(count($log) == 1){
                    foreach($log as $lgn):
                        $_SESSION['user_id']=$lgn['user_id'];
                        $_SESSION['user_name']=$lgn['user_name'];                          
                    endforeach;  
                    echo $_GET['login'].":".$_SESSION['user_id'];
                } else {
                    echo '0';  
                }
            }
	}
        
        public function logout()
        {  
            unset($_SESSION['user_id']);
            unset($_SESSION['period']);
            header ('Location: ../../index.php');  // перенаправление на нужную страницу
            exit();
        }
         
        public function fogot()
        {  
           
            $this->load->view('pages/login_fogot');
           
        }
        
        public function fogot1()
        {  
            if(isset($_POST['email'])){
                $usr= $this->login_model->user($this->login_model->user_id($_POST['email']));
                if(count($usr) == 1){
                $data['usr']=$usr;
                $this->load->view('pages/login_fogot1',$data);
                }else{
                    $data['message']='Користувача з таким номером не знайдено!';
                 $this->load->view('pages/login_fogot',$data);   
                }
            }
           
        }
        
        
        public function fogot2()
        {  
          
         $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	    
            if(isset($_POST['user_id'])){            
                $usr= $this->login_model->user($this->input->post('user_id'));
                foreach ($usr as $user){
                    $phone = $user['user_login'];
                    $email = $user['user_email'];
                    $fname = $user['user_fname'];
                }
                if(isset($_POST['phone'])){
                //Viber token 4e423094ba67da9b-5e9f2ea55b422dff-42fa02035d9e1319
                    echo "Вибрано телефон ".$_POST['phone'];
                 
                }elseif(isset($_POST['email'])){
                    $this->load->config('email');
                    $this->load->library('email');

                    $from = $this->config->item('smtp_user');
                    
                    $subject = 'New password до ЕСОРБ';
                    $passw= substr(str_shuffle($chars), 0, 6);
                    $message = 'Доброго дня '.$fname.'! Ваш новий пароль:'.$passw;

                    $this->email->set_newline("\r\n");
                    $this->email->set_header('charset','utf8');
                    
                    $this->email->from($from);
                    $this->email->to($email);
                    $this->email->subject($subject);
                    $this->email->message($message);

                    if ($this->email->send()) {
                        $data['message'] = 'Вам відправлено новий пароль.<br> Ви можете увійти у систему.';
                        $uu=$this->login_model->set_password($this->input->post('user_id'),$passw);
                         $this->load->view('pages/login',$data);   
                    } else {
                        $data['message'] = 'Щось пішло не так!<br> Зверніться до адміністратора системи.';
                         $this->load->view('pages/login_fogot',$data);   
                            //show_error($this->email->print_debugger());
                    }
                }else{
                    echo "не вибрано нічого";
                }
            }
        }

        public function set_passw()
        {  
            if(isset($_SESSION['user_id'])){
                $uu=$this->login_model->set_password($this->input->get('id'),$this->input->get('txt')); 
                echo 1;
            } else {
                echo 0;
            }
        }

}

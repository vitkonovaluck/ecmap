<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Screen extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
        }

        public function index()
        {
            if( isset($_POST['width']) && isset($_POST['height']) ){
                $_SESSION['sw']	=	$_POST['width'] ;
                $_SESSION['sh']	=	$_POST['height'] ;
            }
        }
	
}

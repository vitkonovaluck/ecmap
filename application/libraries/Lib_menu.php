<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lib_menu {
    function __construct()
	{
		//parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('url');
                $this->load->model('menu_model');
      	}

    function get_menu_data($id)
    {
        return $id;   
    }
    
    public function get_menu_main()
    {
        get_menu_data(0);
    }
}

/* End of file Someclass.php */
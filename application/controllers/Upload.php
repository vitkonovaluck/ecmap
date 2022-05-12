<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload  extends CI_Controller {
    //put your code here

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
                $this->load->model('document_model');
        }

        public function index()
        {
            if(isset($_GET['id'])){
                $data['error'] = '';
                $data['doc_id'] = $_GET['id'];
                $data['doc_name'] = $this->document_model->name_doc($_GET['id']);
                $this->load->view('upload/form', $data);
            }
        }

        public function do_upload()
        {
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png|pdf';
                $config['max_size']             = 10000000;
                $config['max_width']            = 5000;
                $config['max_height']           = 5000;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                         $data['error'] = $this->upload->display_errors();
                         $data['doc_id'] = $_POST['doc_id'];
                         $data['doc_name'] = $this->document_model->name_doc($_POST['doc_id']);

                         $this->load->view('upload/form', $data); 
                }
                else
                {
                 
                        $upl_files =  $this->upload->data();
                        //$upl_files['full_path'];
                        $data['doc_id'] = $_POST['doc_id'];
                        $data['upload_data'] =  $this->upload->data();
                         
                        $sdoc= $this->document_model->doc_photo_ins($_POST['doc_id'],$upl_files['file_name']);
         
                        //$this->load->view('upload/success', $data);
                        header ('Location: ../../index.php');  // перенаправление на нужную страницу
         
                }
        }
}

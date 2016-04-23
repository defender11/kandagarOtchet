<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Show_controller extends CI_Controller {



    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $this->load->view('admin_main_view');
    }
    public function page_add_service ()
    {
        $this->load->model('admin_model');
        $allInfo['mainInfo'] = $this->admin_model->select_all_info();
        $allInfo['officeInfo'] = $this->admin_model->select_office();
        $allInfo['serviceInfo'] = $this->admin_model->select_service();
        $allInfo['selectJoinInfo'] = $this->admin_model->select_all_service_join();
        $allInfo['selectCash'] = $this->admin_model->select_all_cash();
//        echo "<pre>";
//        var_dump($allInfo);
//        echo "</pre>";
        $this->load->view('admin_view', $allInfo);
    }

    public function add_service ()
    {
        $this->load->model('admin_model');
        $this->admin_model->add_service();
    }
}

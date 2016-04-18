<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_controller extends CI_Controller {

    public function page_add_service ()
    {
        $this->load->model('admin_model');
        $allInfo['mainInfo'] = $this->admin_model->select_all_info();
        $allInfo['officeInfo'] = $this->admin_model->select_office();
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

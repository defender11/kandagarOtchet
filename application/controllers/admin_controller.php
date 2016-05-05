<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->session->userdata('auth') == 'yes') {
            $this->load->model('admin_model');
            $allInfo['selectUser'] = $this->admin_model->select_user();
            $allInfo['select_all_user_status'] = $this->admin_model->select_all_user_status();
            $this->load->view('admin_main_view', $allInfo);
        } else {
            $this->logout();
        }

    }
    public function page_add_service ()
    {
        if ($this->session->userdata('auth') == 'yes') {
            $this->load->model('admin_model');
            $allInfo['mainInfo'] = $this->admin_model->select_all_info();
            $allInfo['officeInfo'] = $this->admin_model->select_office();
            $allInfo['serviceInfo'] = $this->admin_model->select_service();
            $allInfo['selectJoinInfo'] = $this->admin_model->select_all_service_join();
            $allInfo['selectCash'] = $this->admin_model->select_all_cash();
            $allInfo['selectStatus'] = $this->admin_model->select_all_status();
            $allInfo['selectUser'] = $this->admin_model->select_user();
            $allInfo['select_all_user_status'] = $this->admin_model->select_all_user_status();
            $this->load->view('admin_view', $allInfo);
        } else {
            $this->logout();
        }
    }

    public function page_admin_agreement ()
    {
        $this->load->model('admin_model');
        $this->load->view('');
    }

//    -------------------------------------------------------------------------
    public function logout()
    {
        $this->session->set_userdata('auth', 'no');
        redirect('login');
        echo "You don`t have permission";
        exit();
    }

    public function add_service ()
    {
        if ($this->session->userdata('auth') == 'yes') {
            $this->load->model('admin_model');
            if ($this->admin_model->add_service() == true) {
                redirect("page_admin_add_service");
            }
        } else {
            $this->logout();
        }
    }

    public function delete_service()
    {
        header("Content-Type:text/plain");
        $this->load->model('admin_model');
        if ($this->admin_model->delete_service() == 'ok'){
            return 'ok';
        }
    }

    public function show_statistic() {
        header('Content-Type: application/json');

        $this->load->model('admin_model');
        $data = $this->admin_model->show_statistic();

        echo json_encode($data, JSON_FORCE_OBJECT);
    }

    public function set_success_stat()
    {
        header("Content-Type:text/plain");

        $this->load->model('admin_model');
        $this->admin_model->set_success_stat();
    }
}

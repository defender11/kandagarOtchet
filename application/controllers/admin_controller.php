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
            $allInfo['selectJoinInfo'] = $this->admin_model->select_all_payment_join();
            $allInfo['selectCash'] = $this->admin_model->select_all_cash();
            $allInfo['selectStatus'] = $this->admin_model->select_all_status();
            $allInfo['selectUser'] = $this->admin_model->select_user();
            $allInfo['select_all_user_status'] = $this->admin_model->select_all_user_status();
            $this->load->view('admin_view', $allInfo);
        } else {
            $this->logout();
        }
    }

    public function page_admin_list_service ()
    {
        if ($this->session->userdata('auth') == 'yes') {
            $this->load->model('admin_model');
            $allInfo['serviceInfo'] = $this->admin_model->select_service();
            $allInfo['selectUser'] = $this->admin_model->select_user();
            $allInfo['select_all_user_status'] = $this->admin_model->select_all_user_status();
            $this->load->view('admin_list_service_view', $allInfo);
        } else {
            $this->logout();
        }
    }

    public function page_admin_future ()
    {
        if ($this->session->userdata('auth') == 'yes') {
            $threeYear = 100;
            @$crntYear = $this->strip_trim($_POST['year_future']);
            @$crntMonth = $this->strip_trim($_POST['month_future']);
            @$joinCrntMY = $crntYear . "-" . $crntMonth;

//          Добавить расчитанные на странице 3 месяца в массив
//          ----------------
            for ($i = 0; $i < 3; $i++) {
                @$year["year".$i] = $this->strip_trim($_POST["year_f".$i.""]);
            }
//          ----------------
            $this->load->model('admin_model');
            $allInfo['futureData'] = $this->admin_model->select_all_payment_future();
//            ---------------------
//            Расчет прогнозирование
//            ---------------------

            foreach ($allInfo['futureData'] as $k => $val) {
                if (!empty($val["month_period_id"])) {
                    @$yearItem = substr($val['stat_month'], 0, 4);
                    @$monthItem = substr($val['stat_month'], 5, 2);

                    @$monthItem1 = substr($val['stat_month'], 0, 7);
//                    echo $k."<br />";

                    if (!empty($crntMonth)) {
                        for ($i = $crntMonth; $i < $threeYear; $i += intval($val["month_period_id"])) {

                            $date = new DateTime($monthItem1);
                            $date->modify("+" . intval($val["month_period_id"]) . " month");
                            $monthItem1 = $date->format('Y-m'); // 2013-06-17

                            $m1 = str_replace("-", "", $monthItem1);
                            $m2 = str_replace("-", "", $joinCrntMY);

                            if ($m1 == $m2) {
//                                echo $m1 . " == " . $m2 . "<br />";
                                $allInfo['futureData'][$k]['new_months'][] = $monthItem1 . "-01";
                                break;
                            } else {
//                                echo $m1 ." != ". $m2."<br />";
                                continue;
                            }
//                            echo "-----------<br />";
                        }
                        continue;
                    } else {
                        echo "";
                    }
                } else {
                    echo "";
                }
            }
//            ---------------------
//            $this->output->enable_profiler(TRUE);
            $this->load->view('admin_future', $allInfo);
        } else {
            $this->logout();
        }
    }

    public function page_admin_agreement ()
    {
        if ($this->session->userdata('auth') == 'yes') {
            $this->load->model('admin_model');
            $allInfo['mainInfo'] = $this->admin_model->select_all_info();
            $allInfo['officeInfo'] = $this->admin_model->select_office();
            $allInfo['serviceInfoName'] = $this->admin_model->select_service_main();
            $allInfo['serviceInfoAbout'] = $this->admin_model->select_service_about();
            $allInfo['selectCash'] = $this->admin_model->select_all_cash();
            $allInfo['selectStatus'] = $this->admin_model->select_all_status();
            $allInfo['selectJoinInfo'] = $this->admin_model->select_all_agreement_join();
            $this->load->view('admin_agreement', $allInfo);
        } else {
            $this->logout();
        }
    }

//    -------------------------------------------------------------------------

    public function logout()
    {
        $this->session->set_userdata('auth', 'no');
        redirect('login');
        echo "You don`t have permission";
        exit();
    }

    public function future_payment ()
    {
        if ($this->session->userdata('auth') == 'yes') {
            header('Content-Type: application/json');
            $this->load->model('admin_model');
            $data = $this->admin_model->select_all_payment_future();
            echo json_encode($data, JSON_FORCE_OBJECT);
        } else {
            $this->logout();
        }
    }

    public function add_service ()
    {
        if ($this->session->userdata('auth') == 'yes') {
            $this->load->model('admin_model');
            if ($this->admin_model->add_service() == true) {
                redirect("page_admin_agreement");
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

    public function strip_trim ($value)
    {
        return trim(strip_tags($value));
    }

    public function update_agreement () {
        header("Content-Type:text/plain");

        $this->load->model('admin_model');
        $this->admin_model->update_agreement();
    }
}

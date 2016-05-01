<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends CI_Controller {

    public $newdata = array();

    public function __construct()
    {
        parent::__construct();
        
        $this->session->set_userdata('auth', 'no');
    }

    public function strip_trim ($value)
    {
        return trim(strip_tags($value));
    }

    public function logout()
    {
        $this->session->set_userdata('auth', 'no');
        redirect('login');
        echo "You don`t have permission";
        exit();
    }

    public function index()
    {
        $this->load->view('login_view');
    }

    public function check_login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $this->load->model('login_model');

            if (isset($_POST['check_login_btn'])) {

                $this->newdata = array(
                            'userlogin'  => $this->strip_trim($_POST['login']),
                            'userpasswd'  => md5($this->strip_trim($_POST['passwd']))."A@35ko!"
                );

                $putUserInfo['userInfo'] = $this->login_model->select_user($this->newdata['userlogin'], $this->newdata['userpasswd']);

                if ($this->newdata['userlogin'] === @$putUserInfo['userInfo'][0]['user_login'] AND
                    $this->newdata['userpasswd'] === @$putUserInfo['userInfo'][0]['user_passwd']) {


                    $this->newdata = array(
                        'user_id'  => $putUserInfo['userInfo'][0]['user_id'],
                        'user_login'  => $putUserInfo['userInfo'][0]['user_login'],
                        'user_passwd'  => $putUserInfo['userInfo'][0]['user_passwd'],
                        'user_access' => $putUserInfo['userInfo'][0]['user_access'],
                        'user_access_name' => $putUserInfo['userInfo'][0]['user_access_name'],
                        'auth' => 'yes'
                    );
                    $this->session->set_userdata($this->newdata);
                    redirect('/');

                } else {
                    $this->logout();
                }
            } else {
                $this->logout();
            }
        } else {
            $this->logout();
        }
    }
}

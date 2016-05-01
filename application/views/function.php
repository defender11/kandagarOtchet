<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

function setClassForShowStatusTable($data){
    switch ($data) {
        case 1:
            echo "good";
            break;
        case 2:
            echo "recieved";
            break;
        case 3:
            echo "progress";
            break;
        case 4:
            echo "archive";
            break;
        case 5:
            echo "bad";
            break;
    }
};

$userId = $this->session->userdata('user_id');
$userLogin = $this->session->userdata('user_login');
$userPasswd = $this->session->userdata('user_passwd');
$userAccess = $this->session->userdata('user_access');
$userAccessName = $this->session->userdata('user_access_name');
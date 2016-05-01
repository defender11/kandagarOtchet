<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function select_user($login, $passw)
    {
        return $this->db->query("SELECT * FROM users
                    JOIN user_access
                    ON users.user_access = user_access.user_access_id
                    WHERE users.user_login = '".$login."' AND users.user_passwd = '".$passw."'")->result_array();
    }
}
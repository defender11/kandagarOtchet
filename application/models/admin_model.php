<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

//    public $currentMonth = ;
    public $service_main = "SELECT service_id, service_name FROM service GROUP BY service_name";
    public $service_about = "SELECT service_id, service_about FROM service GROUP BY service_about";

    public $main = "SELECT * FROM main";
    public $cash = "SELECT * FROM cash";
    public $service = "SELECT * FROM service";
    public $status = "SELECT * FROM status";

    public $user = "SELECT * FROM users
                    JOIN user_access
                    ON users.user_access = user_access.user_access_id";

    public $users_status = "SELECT * FROM user_access";

    public $select_office = "SELECT * FROM office RIGHT JOIN month_period ON office_id = month_period_id LIMIT 0, 50 ";

    public $join_table_all = "SELECT  m.main_id,
                                    a.agreement_id,
                                    a.agreement_name,
                                    srv.service_name,
                                    srv.service_about,
                                    off.office_name,
                                    m.date_start,
                                    m.date_recieved,
                                    m.month_period_id,
                                    mp.month_count_name,
                                    s.stat_month,
                                    s.stat_summ,
                                    c.cash_country,
                                    s.stat_payment,
                                    st.status_name,
                                    st.status_id,
                                    s.stat_id,
                                    usr.user_login,
                                    usr.user_passwd,
                                    usr.user_access,
                                    usra.user_access_name

                                FROM statistic s

                                JOIN main m
                                ON s.main_id = m.main_id

                                JOIN month_period mp
                                ON  m.month_period_id = mp.month_period_id

                                JOIN office off
                                ON off.office_id = m.office_id

                                JOIN cash c
                                ON c.cash_id = m.cash_id

                                JOIN service srv
                                ON srv.service_id = m.service_id

                                JOIN status st
                                ON st.status_id = s.status_id

                                JOIN agreement a
                                ON a.agreement_id = m.agreement_id

                                JOIN users usr
                                ON m.user_id = usr.user_id

                                JOIN user_access usra
                                ON usr.user_access = usra.user_access_id";

    public function __construct()
    {
        parent::__construct();
    }

    public function strip_trim ($value)
    {
        return trim(strip_tags($value));
    }

    public function select_service_main()
    {
        return $this->db->query($this->service_main)->result_array();
    }

    public function select_service_about()
    {
        return $this->db->query($this->service_about)->result_array();
    }

    public function select_all_cash()
    {
        return  $this->db->query($this->cash)->result_array();
    }
    public function select_all_status()
    {
        return  $this->db->query($this->status)->result_array();
    }

    public function select_all_info()
    {
        return  $this->db->query($this->main)->result_array();
    }

    public function select_user()
    {
        return $this->db->query($this->user)->result_array();
    }

    public function select_all_user_status()
    {
        return $this->db->query($this->users_status)->result_array();
    }

    public function select_service()
    {
        return  $this->db->query($this->service)->result_array();
    }

//    ----------------------------------------

    public function select_all_agreement_join()
    {
        return  $this->db->query($this->join_table_all. "
                                WHERE a.status_id <> 4
                                ORDER BY m.main_id ASC")->result_array();
    }

    public function select_all_payment_join()
    {
        return $this->db->query($this->join_table_all. "
                                WHERE (s.stat_month LIKE '%-".date('m')."-%' OR s.stat_month < '".date('Y-m')."')  AND (st.status_id <> 4 AND st.status_id <> 1 AND a.status_id <> 4 )
                                ")->result_array();
    }

    public function select_all_payment_future()
    {

        @$ym = $this->strip_trim($_POST['year_future'])."-".$this->strip_trim($_POST['month_future']);
        $row = $this->db->query($this->join_table_all. "
                                WHERE  s.stat_month < '".$ym."' OR s.stat_month = '".$ym."'")->result_array();
        $row[0]['selectData'] = $ym;
        return $row;
    }

//        Выберим Все оффисы и период оплаты
    public function select_office()
    {
        return $this->db->query($this->select_office)->result_array();
    }

    public function add_service()
    {
        $query2 = array();

        $temp = array(
            'service_name' => $this->strip_trim($_POST['service_name']),
            'service_about' => $this->strip_trim($_POST['service_about']),
            'office_id' => $this->strip_trim($_POST['office_id']),
            'date_start' => $this->strip_trim($_POST['date_start']),
            'month_period' => $this->strip_trim($_POST['month_period']),
            'summ' => $this->strip_trim($_POST['summ']),
            'cash_id' => $this->strip_trim($_POST['cash_id']),
            'service_name_add' => @$this->strip_trim($_POST['service_name_add']),
            'service_about_add' => @$this->strip_trim($_POST['service_about_add']),
            'agreement_about' => $this->strip_trim($_POST['agreement_about']),
            'stat_payment' => $this->strip_trim($_POST['stat_payment']),
            'user_id' => $this->strip_trim($_POST['user_id'])
        );


//        Проверка на добовления месяца
//        $dt1 = str_replace("-", "", $this->strip_trim($_POST['date_start']));
//        $dt2 = str_replace("-", "", $this->strip_trim($_POST['date_period']));
//
//        if ($dt1 < $dt2) {
            $date = new DateTime($temp['date_start']);
            $date->modify("+".$temp['month_period']." month");
            $temp['date_recieved'] = $date->format('Y-m-d'); // 2013-06-17
//        } else if ($dt1 == $dt2) {
//            $temp['date_recieved'] = $this->strip_trim($_POST['date_period']); // 2013-06-17
//        }
//        Конец Проверки на добовления месяца
//--------------------------------------------------------------------------
//        Проверка на добовление услуги, если такая услуга уже есть
        $s_name = explode("/", $temp['service_name']);
        $s_about = explode("/", $temp['service_about']);
//        echo $s_name[0]; // 1, 2, 3, 4, 5 6 7
//        echo $s_name[1]; // Интернет Аренда Вычислительных Мощностей  Телефон IP Телефония Хостинг Сервера IP Телефония Телефон

//        echo $s_about[0]; // 1, 2, 3, 4, 5 6 7
//        echo $s_about[1]; // Интернет Аренда Вычислительных Мощностей  Телефон IP Телефония Хостинг Сервера IP Телефония Телефон

//        Проверка ajax на совпадение сервисы выбранные пользователем с сервисами которые уже есть, сравнение жесткое.
//        ....
//        $testing = $this->db->query($this->service)->result_array();

//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

        $checkServRes = 0;
        if (!empty($_POST['service_name_add']) || !empty($_POST['service_about_add'])) {
            $this->db->query("INSERT INTO service VALUE(NULL, '".$temp['service_name_add']."', '".$temp['service_about_add']."') ");
            $query2[0]['service_id'] = $this->db->insert_id();
        } else {
            $checkServ = $this->db->query("SELECT * FROM service")->result_array();

            foreach ($checkServ as $checkS) {
                if ($checkS['service_name'] == $s_name[1] && $checkS['service_about'] == $s_about[1]) {
                    $query2[0]['service_id'] = $checkS['service_id'];
                    $checkServRes = 1;
                } else {
                    continue;
                }
            }

            if ($checkServRes == 0) {
                $this->db->query("INSERT INTO service VALUE(NULL, '" . $s_name[1] . "', '" . $s_about[1] . "') ");
                $query2[0]['service_id'] = $this->db->insert_id();
            }
        }

//        Конец Проверки на добовление услуги, если такая услуга уже есть
//--------------------------------------------------------------------------
//        Вставляем в таблицу agreement № Договора и возврощяем ID
//        if ($temp['agreement_about_add'] == "") {
            $this->db->query("INSERT INTO `agreement` VALUES(NULL, '".$temp['agreement_about']."', 3)");
            $query_agreement = $this->db->insert_id();
//        } else {
//            $this->db->query("INSERT INTO `agreement` VALUES(NULL, '".$temp['agreement_about_add']."')");
//            $query_agreement = $this->db->insert_id();
//        }
//--------------------------------------------------------------------------
//  Вставляем данные в main таблицу
        $q3 = "INSERT INTO `main`(
                                  main_id,
                                  service_id,
                                  office_id,
                                  date_start,
                                  date_recieved,
                                  month_period_id,
                                  cash_id,
                                  agreement_id,
                                  user_id )
                VALUE (NULL,
                       ".intval($query2[0]['service_id']).",
                       ".$temp['office_id'].",
                       '".$temp['date_start']."',
                       '".$temp['date_recieved']."',
                       ".$temp['month_period'].",
                       ".$temp['cash_id'].",
                       ".$query_agreement.",
                       ".$_POST['user_id'].")";

        $query3 = $this->db->query($q3);
        $main_id = $this->db->insert_id();

        $insert_into_statistic = "INSERT INTO `statistic` (
                                                            stat_id,
                                                            stat_month,
                                                            stat_summ,
                                                            stat_payment,
                                                            status_id,
                                                            main_id)
                                  VALUES (NULL,
                                          '".$temp['date_recieved']."',
                                          '".$temp['summ']."',
                                          '".$temp['stat_payment']."',
                                          3,
                                          '".$main_id."'
                                  )";
        $this->db->query($insert_into_statistic);
        return true;
    }

    public function delete_service()
    {
        $id_service = intval($this->strip_trim($_POST['id_service']));
        $agreement = intval($this->strip_trim($_POST['agreement']));

        $this->db->query("DELETE FROM `kandagar_it_otchet`.`statistic` WHERE `statistic`.`main_id` = ".$id_service);
        $this->db->query("DELETE FROM `kandagar_it_otchet`.`agreement` WHERE `agreement`.`agreement_id` = ".$agreement);
        $this->db->query("DELETE FROM `kandagar_it_otchet`.`main` WHERE `main`.`main_id` = ".$id_service);

        return 'ok';
    }

    public function update_agreement()
    {
        $id = $_POST['service_id'];

        $data = array(
            'service_name' => $this->strip_trim($_POST['service_name']),
            'service_about' => $this->strip_trim($_POST['service_about'])
        );
        $this->db->query("UPDATE service SET service_name = '". $data['service_name'] ."', service_about = '". $data['service_about']."' WHERE service_id =". $id);
    }

    public function show_statistic()
    {
        $id_service = intval($this->strip_trim($_POST['id_service']));
        $agreement = intval($this->strip_trim($_POST['agreement']));

        $row = $this->db->query("SELECT * FROM `statistic` WHERE main_id =".$id_service);
        return $row->result_array();
    }

    public function set_success_stat()
    {
        $stat_id = intval($this->strip_trim($_POST['stat_id']));
        $main_id = intval($this->strip_trim($_POST['main_id']));
        $month_period = intval($this->strip_trim($_POST['month_period']));
        $current_month = $this->strip_trim($_POST['stat_month']);

        $date = new DateTime($current_month);
        $date->modify("+".$month_period." month");
        $new_current_month = $date->format('Y-m-d'); // 2013-06-17

        $this->db->query("UPDATE statistic SET status_id = 1 WHERE stat_id = ".$stat_id);
        $this->db->query("INSERT INTO statistic(stat_id, stat_month, status_id, main_id) VALUES(null, '".$new_current_month."', 3, ".$main_id.")");
    }
}
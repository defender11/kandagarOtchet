<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public $main = "SELECT * FROM main";
    public $service = "SELECT * FROM service";
    public $select_office = "SELECT * FROM office RIGHT JOIN month_period ON office_id = month_period_id LIMIT 0, 50 ";

    public $select_join = "SELECT *
                            FROM main
                            JOIN month_period
                            ON main.month_period_id = month_period.month_period_id
                            JOIN office
                            ON main.office_id = office.office_id
                            JOIN service
                            ON main.service_id = service.service_id
                            JOIN status
                            ON main.status_id = status.status_id";


    public function __construct()
    {
        parent::__construct();
    }

    public function select_all_info()
    {
        return  $this->db->query($this->main)->result_array();
    }

    public function select_service()
    {
        return  $this->db->query($this->service)->result_array();
    }

    public function select_all_service_join()
    {
        return  $this->db->query($this->select_join)->result_array();
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
            'service_name' => $_POST['service_name'],
            'service_about' => $_POST['service_about'],
            'office_id' => $_POST['office_id'],
            'date_start' => $_POST['date_start'],
            'date_period' => $_POST['date_period'],
            'month_period' => $_POST['month_period'],
            'summ' => $_POST['summ'],
            'service_name_add' => @$_POST['service_name_add'],
            'service_about_add' => @$_POST['service_about_add']
        );

        $s_name = explode("/", $temp['service_name']);
        $s_about = explode("/", $temp['service_about']);
        echo $s_name[0]; // 1, 2, 3, 4, 5 6 7
        echo $s_name[1]; // Интернет Аренда Вычислительных Мощностей  Телефон IP Телефония Хостинг Сервера IP Телефония Телефон

        echo $s_about[0]; // 1, 2, 3, 4, 5 6 7
        echo $s_about[1]; // Интернет Аренда Вычислительных Мощностей  Телефон IP Телефония Хостинг Сервера IP Телефония Телефон

//        Проверка ajax на совпадение сервисы выбранные пользователем с сервисами которые уже есть, сравнение жесткое.
//        $testing = $this->db->query($this->service)->result_array();

        if ($s_name[0] != $s_about[0]) {

            $this->db->query("INSERT INTO service VALUE(NULL, '".$s_name[1]."', '".$s_about[1]."') ");
            $query2 = $this->db->query("SELECT service_id FROM service ORDER BY service_id DESC LIMIT 1")->result_array();

        } else if (!empty($_POST['service_name_add']) || !empty($_POST['service_about_add'])) {

            $this->db->query("INSERT INTO service VALUE(NULL, '".$temp['service_name_add']."', '".$temp['service_about_add']."') ");
            $query2 = $this->db->query("SELECT service_id FROM service ORDER BY service_id DESC LIMIT 1")->result_array();

        } else {
            $query2[0]['service_id'] =  $s_name[0];
        }

//        $date = "2016-04-30";// разграничителями могут быть slash, dot или hyphen
//        list ($year, $month, $day ) = explode ('-', $date);
//        echo "Month: $month; Day: $day; Year: $year<br>\n";
//
//        $newMonth = $month + $temp['month_period'];
//        if ($newMonth >= 1 && $newMonth <= 9) {
//            $newDatePeriod = $year . "-0" . $newMonth . "-" . $day;
//        } else {
//            $newDatePeriod = $year . "-" . $newMonth . "-" . $day;
//        }


//        После вставки названия сервиса в таблицу service, нужно сделать запрос в эту же таблицу и найти последнюю
//        вставку, полученные данные вставить в таблицу main

        $q3 = "INSERT INTO `kandagar_it_otchet`.`main`(
                                                        main_id,
                                                        service_id,
                                                        office_id,
                                                        date_start,
                                                        date_recieved,
                                                        date_period,
                                                        month_period_id,
                                                        status_id,
                                                        sum )
                VALUE (NULL,
                       ".intval($query2[0]['service_id']).",
                       ".$temp['office_id'].",
                       '".$temp['date_start']."',
                       '".$temp['date_start']."',
                       '".$temp['date_period']."',
                       ".$temp['month_period'].",
                       3,
                       ".intval($temp['summ']).")";
//        echo "<pre>";
//        var_dump($query2);
//        echo "</pre>";
//
//        echo "<pre>";
//        var_dump($q3);
//        echo "</pre>";

        $query3 = $this->db->query($q3);
    }

}

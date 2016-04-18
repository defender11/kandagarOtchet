<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_model extends CI_Model {

    public function select_all_info()
    {
        $q = "SELECT * FROM main";
        return  $this->db->query($q)->result_array();
    }


//        Выберим Все оффисы и период оплаты
    public function select_office()
    {
        $q = "SELECT * FROM office RIGHT JOIN month_period ON office_id = month_period_id LIMIT 0, 50 ";
        return $this->db->query($q)->result_array();
    }

    public function add_service()
    {
        $temp = array(
            'service_name' => $_POST['service_name'],
            'service_about' => $_POST['service_about'],
            'office_id' => $_POST['office_id'],
            'date_start' => $_POST['date_start'],
            'date_period' => $_POST['date_period'],
            'month_period' => $_POST['month_period'],
            'summ' => $_POST['summ']
        );

        $q = "INSERT INTO service VALUE (NULL, '".$temp['service_name']."', '".$temp['service_about']."')";
        $query = $this->db->query($q);

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
        $q2 = "SELECT service_id FROM service ORDER BY service_id DESC LIMIT 1";
        $query2 = $this->db->query($q2)->row_array();


        $q3 = "INSERT INTO `kandagar_it_otchet`.`main`(
                                                        main_id,
                                                        service_id,
                                                        office_id,
                                                        date_start,
                                                        date_recieved,
                                                        date_period,
                                                        month_period_id,
                                                        pay,
                                                        receive,
                                                        archive,
                                                        sum )
                VALUE (NULL,
                       ".intval($query2["service_id"]).",
                       ".$temp['office_id'].",
                       '".$temp['date_start']."',
                       '".$temp['date_start']."',
                       '".$temp['date_period']."',
                       ".$temp['month_period'].",
                       0,
                       0,
                       0,
                       ".$temp['summ']."
                       )";
        var_dump($q3);
        $query3 = $this->db->query($q3);
    }

}

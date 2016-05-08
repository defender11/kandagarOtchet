/**
 * Created by Administrator on 4/21/2016.
 */
$(function () {
    var $path = 'http://kandagarotchet/';
    var $path_no_routes = 'http://kandagarotchet/index.php/';

    $('.service_block_add_new_field_btn').on('click', function() {
        $('.service_block_add_new_field').removeClass('dspNone').addClass('dspBlock');
        $('.service_block_add_field').addClass('dspNone');
        $(this).addClass('dspNone');
    });
//--------------------------------
    $('.service_block_drop_new_field_btn').on('click', function() {
        $('.service_block_add_new_field').removeClass('dspBlock').addClass('dspNone');
        $('.service_block_add_field').addClass('dspBlock').removeClass('dspNone');
        $('.service_block_add_new_field_btn').addClass('dspBlock').removeClass('dspNone');
    });
//--------------------------------
    $(document).on('click', '.tbl_list_setting', function () {
       var $this = $(this);

        $this.find('.close_setting').css({'display' : 'block'});
        $this.find('.row_setting').css({'display' : 'block'});
    });
//--------------------------------
    $(document).on('click', '.show_status', function () {
       var $this = $(this);
        $this.next().toggleClass('dspBlock');
    });
//--------------------------------
    $(document).on('click', '.close_setting', function() {
       $(this).next().fadeOut('fast');
        $('.status_service').removeClass('dspBlock');
        $('.statistic_box').fadeOut('fast');
        $('.statistic_list li:not(:nth-child(1))').remove();
        $(this).fadeOut('fast');
    });
//--------------------------------
    $(document).on('click', '.btn_delete_service', function () {
       var $this = $(this);
        var id_service = $this.data('id_service');
        var agreement = $this.data('agreement');

        if (confirm("Удалить на всегда ?"))
        {
            $.ajax({
                data: "id_service=" + id_service + "&agreement=" + agreement,
                type: "POST",
                url: $path+"delete_service",
                dataType: 'text',
                success: function (data) {
                    $('.row_setting').fadeOut('fast');
                    $('.close_setting').fadeOut('fast');
                    $this.closest('tr').fadeOut('fast').remove();
                }
            });
        }
        return false;
    });
//--------------------------------
    function close_setting_on_status() {
        $('.row_setting').fadeOut('fast');
        $('.status_service').removeClass('dspBlock');
        $('.close_setting').fadeOut('fast');
    }

    $(document).on('click', '.status_service_btn', function () {
        var $this = $(this);
        var status_service = $this.data('status_service');
        var agreement = $this.closest('.table_tr').data('agreement');
        var main_id = $this.closest('.table_tr').data('main_id');
        var month_period = $this.closest('.table_tr').data('month_period');
        var stat_id = $this.closest('.table_tr').data('stat_id');
        var current_month = $this.closest('.table_tr').find('.date_recieved').text();

        switch (parseInt(status_service)) {
            case 1:
                //Статус оплачено
                console.log(status_service);
                $.ajax({
                    data: "stat_id="+ stat_id + "&main_id=" + main_id + "&stat_month=" + current_month + "&month_period=" + month_period,
                    url: $path + "set_success_stat",
                    dataType: "text",
                    type: "POST",
                    success: function(data) {
                        console.log(data);
                        close_setting_on_status();
                        $this.closest('.table_tr').removeClass().addClass('table_tr good');
                    }
                });
                break;
            case 2:
                //Статус получено
                console.log(status_service);
                close_setting_on_status();
                $this.closest('.table_tr').removeClass().addClass('table_tr recieved');
                break;
            case 3:
                //Статус В процессе
                console.log(status_service);
                close_setting_on_status();
                $this.closest('.table_tr').removeClass().addClass('table_tr progress');
                break;
            case 4:
                //Статус В архиве
                console.log(status_service);
                close_setting_on_status();
                $this.closest('.table_tr').removeClass().addClass('table_tr archive');
                break;
            case 5:
                //Статус просроченно
                console.log(status_service);
                close_setting_on_status();
                $this.closest('.table_tr').removeClass().addClass('table_tr bad');
                break;
            default:
        }


    })
// --------------------------------
//    SYSTEM FUTURE
//    $(document).on('click', '.btn_future_payament', function () {
//       var $this = $(this);
//        var year = $('#year_future option:selected').val();
//        var month = $('#month_future option:selected').val();
//
//        console.log(year + "-" + month);
//
//        $.ajax({
//            data: "year_future=" + year + "&month_future=" + month,
//            type: "POST",
//            url: $path_no_routes + "admin_controller/future_payment",
//            dataType: "JSON",
//            success: function (data) {
//                console.log(data);
//
//
//
//
//
//
//
//                //{"0":
//                //    {"main_id":"40",
//                //        "agreement_id":"43",
//                //        "agreement_name":"999\/6.2",
//                //        "service_name":"Караван телеком",
//                //        "service_about":"Интернет",
//                //        "office_name":"ТК Кандагар-Крым",
//                //        "date_start":"2016-04-18",
//                //        "date_recieved":"2016-05-18",
//                //        "month_period_id":"1",
//                //        "month_count_name":"Месяц",
//                //        "stat_month":"2016-05-18",
//                //        "stat_summ":"0",
//                //        "cash_country":"руб.",
//                //        "stat_payment":"",
//                //        "status_name":"В процессе",
//                //        "status_id":"3",
//                //        "stat_id":"66",
//                //        "user_login":"test",
//                //        "user_passwd":"098f6bcd4621d373cade4e832627b4f6A@35ko!",
//                //        "user_access":"2",
//                //        "user_access_name":"Proffi"
//                //    }
//                //}
//
//            }
//        })
//
//        return false;
    });


//    END SYSTEM FUTURE
// --------------------------------
// --------------------------------
    $(document).on('click', '.show_static', function () {
        var $this = $(this);
        var id_service = $this.closest('.row_setting').data('id_service');
        var agreement = $this.closest('.row_setting').data('agreement');

        $.ajax({
            data: "id_service=" + id_service + "&agreement=" + agreement,
            type: "POST",
            url: $path + "show_statistic",
            dataType: "JSON",
            success: function (data) {
                console.log(data);

                $this.closest('.row_setting').prev().fadeOut('fast');
                $this.closest('.row_setting').fadeOut('fast');
                $this.closest('.admin_list_service').next().find('.close_setting').fadeIn('fast');
                $('.statistic_list, .statistic_box').css({'display' : 'block'});

                $.each(data, function (inx, el) {

                    var $dataStat = el.stat_month + "' '" + el.stat_payment + "' " + el.stat_summ + "</li>";
                    switch (parseInt(el.status_id)) {
                        case 1:
                            $(".statistic_list").append("<li class='good'>'" + $dataStat);
                            break;
                        case 2:
                            $(".statistic_list").append("<li class='recieved'>'" + $dataStat);
                            break;
                        case 3:
                            $(".statistic_list").append("<li class='progress'>'" + $dataStat);
                            break;
                        case 4:
                            $(".statistic_list").append("<li class='archive'>'" + $dataStat);
                            break;
                        case 5:
                            $(".statistic_list").append("<li class='bad'>'" + $dataStat);
                            break;
                        default:
                    }
                });
            }
        });
    });
});
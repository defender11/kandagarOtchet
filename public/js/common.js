/**
 * Created by Administrator on 4/21/2016.
 */
//---------------------------------
function checkTimeZero (data) {
    if  (data > 0 && data < 10) {
        return "0" + data;
    } else if (data == 0) {
        return "00";
    } else {
        return data;
    }
}

var time = function () {
    var date = new Date();
    var elTime = document.getElementById('crntTime');
    elTime.innerHTML = checkTimeZero(date.getHours()) + ":" + checkTimeZero(date.getMinutes()) + ":" + checkTimeZero(date.getSeconds());
};
// час в текущей временной зоне
setInterval(time, 1000);
//---------------------------------

$(document).ready(function () {
    var $path = 'http://kandagarotchet/';
    var $path_no_routes = 'http://kandagarotchet/index.php/';

    $('.menu, .login_start').css('height', +innerHeight + 'px');

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
        $('.row_setting').removeClass('dspNone');
    });
//--------------------------------
    $(document).on('click', '.show_status', function () {
       var $this = $(this);
        $('.status_service').toggleClass('dspBlock');
    });
//--------------------------------
    $(document).on('click', '.close_setting', function() {
       $(this).next().fadeOut('fast');
        $('.status_service').removeClass('dspBlock');
        $('.statistic_box').fadeOut('fast');
        $('.form_change_service').removeClass('dspBlock');
        $('.form_change_service').fadeOut('fast');
        $('.row_setting').addClass('dspNone');
        $('.recieve_form').addClass('dspNone');
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
        //$('.recieve_form').fadeOut('fast');
        $('.close_setting').fadeOut('fast');

    }
    //--------------------------------
    function close_setting_on_status_change() {
        $('.row_setting').fadeOut('fast');
        $('.status_service').removeClass('dspBlock');
    }

    $(document).on('click', '.status_service_btn', function () {
        var $this = $(this);

        var stat_payment = $this.closest('.table_tr').find('.stat_payment').text();
        var stat_summ = $this.closest('.table_tr').find('.stat_summ').text();

        var status_service = $this.data('status_service');
        var agreement = $this.closest('.table_tr').data('agreement');
        var main_id = $this.closest('.table_tr').data('main_id');
        var month_period = $this.closest('.table_tr').data('month_period');
        var stat_id = $this.closest('.table_tr').data('stat_id');
        var current_month = $this.closest('.table_tr').find('.date_recieved').text();

        console.log(stat_summ);

        switch (parseInt(status_service)) {
            case 1:
                //Статус оплачено
                console.log(status_service);
                $.ajax({
                    data: "stat_id="+ stat_id + "&main_id=" + main_id + "&stat_month=" + current_month + "&month_period=" + month_period + "&status_service=" + status_service,
                    url: $path + "set_stat",
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
                $('.recieve_form').removeClass('dspNone').css({'display' : 'block'});
                $('.recieve_form').prev().removeClass('dspNone').css({'display' : 'block'});
                $('.recieve_form > form ').removeClass('dspNone').css({'display' : 'block'});
                $('.recieve_form > form ').attr({"data-item_id": main_id, "data-status_service": status_service, "data-stat_id": stat_id});
                $('#payment_recieve').val( stat_payment );
                $('#summ_recieve').val( stat_summ );

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
                $.ajax({
                    data: "stat_id="+ stat_id + "&main_id=" + main_id + "&stat_month=" + current_month + "&month_period=" + month_period + "&status_service=" + status_service,
                    url: $path + "set_stat",
                    dataType: "text",
                    type: "POST",
                    success: function(data) {
                        console.log(data);
                        close_setting_on_status();
                        $this.closest('.table_tr').removeClass().addClass('table_tr bad');
                    }
                });
                break;
            default:
        }
    });

    $(document).on('click', '.recieve_form > .close_setting', function () {
       $(this).css({'display' : 'none'});
    });

    $(document).on('click', '.btn_requsit', function (){
        var $this = $(this);
        var $thisClst = $(this).closest('.recieve_form');

        var main_id = $thisClst.find('form').data('item_id');
        var stat_id = $thisClst.find('form').data('stat_id');
        var status_service = $thisClst.find('form').data('status_service');
        var stat_summ = $thisClst.find('#summ_recieve').val();
        var stat_payment = $thisClst.find('#payment_recieve').val();

        console.log("main_id: " + main_id);
        console.log("status_service: " + status_service);
        console.log("stat_summ: " + stat_summ);
        console.log("stat_payment: " + stat_payment);

        //Номер счета и сумма
        $.ajax({
            data: "main_id=" + main_id + "&stat_id=" + stat_id + "&status_service=" + status_service + "&stat_summ=" + stat_summ + "&stat_payment=" + stat_payment,
            url: $path + "set_stat",
            dataType: "text",
            type: "POST",
            success: function(data) {
                console.log(data);
                //$this.closest('.table_tr').removeClass().addClass('table_tr recieved');
            }
        });

        return false;
    });
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
//    });


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

//    Страница правки поставщиков

    $(document).on('click', '.btn_edit', function() {
        var $this = $(this);

        $('.form_change_service').removeClass('dspNone');
        $('.form_change_service').addClass('dspBlock');
        $('.close_setting').fadeIn('fast');

        var sId = $this.closest('.schange').data('sid');
        var sName = $this.closest('.schange').find('.sName').text();
        var sAbout = $this.closest('.schange').find('.sAbout').text();

        $('.form_change_service').attr('data-service-id', sId);
        $('#service_name').attr('value', sName).val(sName);
        $('#service_about').attr('value', sAbout).val(sAbout);

    });

    $(document).on('click', '.btn_change_service', function() {
       var $this = $(this);

        var sId = $this.closest('.form_change_service').data('service-id');
        var sName = $this.closest('.form_change_service').find('#service_name').val();
        var sAbout = $this.closest('.form_change_service').find('#service_about').val();

        $.ajax({
            data: "service_id=" + sId + "&service_name=" + sName + "&service_about=" + sAbout,
            type: "POST",
            url: $path + "update_agreement",
            dataType: "text",
            beforeSend: function() {
                $(".btn_change_service:after").html("<i class='fa fa-spinner fa-pulse fa-fw margin-bottom'></i>");
            },
            success: function (data) {
                console.log(data);
                $this.text('Изменить');
                    $("." + sId + " .sName").text(sName);
                    $("." + sId + " .sAbout").text(sAbout);
                $("." + sId).css({"background" : "#F9E400"}).animate({
                    backgroundColor: "#fff"
                }, 1500);
                $('.form_change_service').removeClass('dspBlock');
                $('.form_change_service').addClass('dspNone');
                $('.close_setting').fadeOut('fast');
            },
            error: function (data) {
                console.log(data);
                $this.text('Ошибка, Повторите');
                $("." + sId).css({"background" : "#F83F3F"}).animate({
                    backgroundColor: "#fff"
                }, 1500);
            }

        })
    });

    $(document).on('click', '.btn_close', function() {
       $(this).closest('.form-close').addClass('dspNone');
        $('.close_setting').fadeOut('fast');
    });

    $(document).on('click', '.btn_del', function (e) {
        var $this = $(this);

        var sId = $this.closest('.schange').data('sid');
        var sName = $this.closest('.schange').find('.sName').text();
        var sAbout = $this.closest('.schange').find('.sAbout').text();

        $.ajax({
            data: "service_id=" + sId + "&service_name=" + encodeURIComponent(sName) + "&service_about=" +  encodeURIComponent(sAbout),
            type: "POST",
            url: $path_no_routes + "admin_controller/select_all_agreement_join_by_name",
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('.wait_load').remove();
                $this.removeClass("dspNone");

                if (data.jsResult == "true") {
                    console.log('data load.');
                } else {
                    console.log('data not load.');
                }
            },
            error: function () {
                $('.wait_load').remove();
            }

        });
        return false;
    });

    // ------------------BUILD

    $(document).on('click', '.btn_box_build_run', function () {
        var $this = $(this);

        var bId = $this.closest('.build_box_row').data('bid');
        var bTrigger = $this.data('build_trigger');

        $this.closest('.build_box_row').append("<span class='btn btn_box_build_back' data-build_trigger='4'>Отменить</span>");
        $this.closest('.build_box_row').addClass('good').removeClass('recieved');
        $this.remove();

        $.ajax({
            data: "build_id=" + bId + "&build_trigger=" + bTrigger,
            type: "POST",
            url: $path + "admin_controller/build_log_change",
            dataType: "json",
            success: function (data) {
                console.log(data);
            },
            error: function () {
            }

        });
        return false;
    });

    $(document).on('click', '.btn_box_build_del', function () {
        var $this = $(this);

        var bId = $this.closest('.build_box_row').data('bid');
        var bTrigger = $this.data('build_trigger');

        $this.closest('.build_box_row').fadeOut('fast').remove();

        $.ajax({
            data: "build_id=" + bId + "&build_trigger=" + bTrigger,
            type: "POST",
            url: $path + "admin_controller/build_log_change",
            dataType: "json",
            success: function (data) {
                console.log(data);

            },
            error: function () {
            }

        });
        return false;
    });

    $(document).on('click', '.btn_box_build_back', function () {
        var $this = $(this);

        var bId = $this.closest('.build_box_row').data('bid');
        var bTrigger = $this.data('build_trigger');

        $this.closest('.build_box_row').addClass('recieved').removeClass('good');
        $this.closest('.build_box_row').append("<span class='btn btn_box_build_run' data-build_trigger='2'>Выполнил</span>");
        $this.remove();

        $.ajax({
            data: "build_id=" + bId + "&build_trigger=" + bTrigger,
            type: "POST",
            url: $path + "admin_controller/build_log_change",
            dataType: "json",
            success: function (data) {
                console.log(data);
            },
            error: function () {
            }

        });
        return false;
    });

});
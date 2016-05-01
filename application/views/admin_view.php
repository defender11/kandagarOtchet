<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include 'function.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Main</title>
    <link rel="stylesheet" href="../../public/css/style.css?v=1.0">
    <link rel="stylesheet" href="../../public/css/jquery-ui.css?v=1.0">
    <link rel="stylesheet" href="../../public/css/jquery-ui.structure.min.css?v=1.0">
    <link rel="stylesheet" href="../../public/css/jquery-ui.theme.min.css?v=1.0">

    <script src="http://code.jquery.com/jquery-1.9.0.js"></script>
    <script src="../../public/js/jquery-ui.min.js"></script>
    <script src="../../public/js/common.js?v=1.0"></script>
    <script>
        $(function() {
            $( "#datepicker_start" ).datepicker({
                numberOfMonths: 2,
                showButtonPanel: true,
                showOn: "button",
                buttonImage: "../../public/img/calendar.gif",
                buttonImageOnly: true,
                buttonText: "Select date",
                dateFormat: "yy-mm-dd",
                minDate: -20
            });

            $( "#datepicker_period" ).datepicker({
                numberOfMonths: 4,
                showButtonPanel: true,
                showOn: "button",
                buttonImage: "../../public/img/calendar.gif",
                buttonImageOnly: true,
                buttonText: "Select date",
                dateFormat: "yy-mm-dd",
                minDate: -20
            });

        });
    </script>
</head>
<body>
<?php
include 'admin_menu.php';
?>

<div class="conteiner">
    <form action="http://kandagarotchet/index.php/admin_controller/add_service" method="post">
        <fieldset>
            <legend>Услуги</legend>

            <div class="service_block_add_field">
                <input type="text" name="user_id" value="<?php echo $userId; ?>" hidden>
                <input type="text" name="user_login" value="<?php echo $userLogin; ?>" hidden>
                <input type="text" name="user_access" value="<?php echo $userAccess; ?>" hidden>

                <label for="service_name">Имя услуги</label>
                <select name="service_name" id="service_name">
                    <?php foreach ($serviceInfo as $value_service) : ?>
                        <option
                            value="<?php echo $value_service['service_id'] . "/" . $value_service['service_name']; ?>"><?php echo $value_service['service_name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="service_about">Сфера деятельности</label>
                <select name="service_about" id="service_about">
                    <?php foreach ($serviceInfo as $value_service) : ?>
                        <option
                            value="<?php echo $value_service['service_id'] . "/" . $value_service['service_about']; ?>"><?php echo $value_service['service_about']; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="agreement">№ договора</label>
                <input type="text" id="agreement" placeholder="№ договора" name="agreement_about" required>
            </div>
            <!--            ------------------------------------------------------------------>
            <p class="service_block_add_new_field_btn ">+ Добавить новую услугу.</p>

            <!--            Этот код добавить в JS, если нету данной услуги в перечне то можно ее добавить с помощью кнопки-->
            <div class="service_block_add_new_field dspNone">
                <label for="service_name_add">Имя услуги</label>
                <input id="service_name_add" type="text" name="service_name_add">
                <label for="service_about_add">Подробнее об услуге.</label>
                <input id="service_about_add" type="text" name="service_about_add">
                <label for="agreement_add">№ договора</label>
                <input type="text" id="agreement_add" name="agreement_about_add" placeholder="№ договора">
                <span class="service_block_drop_new_field_btn ">Отмена</span>
            </div>
            <!--            ------------------------------------------------------------------>
        </fieldset>
        <fieldset>
            <legend>Офисс</legend>
            <label for="office_name">Название офиса</label>
            <br />
            <select name="office_id" id="office_name">
                <?php foreach($officeInfo as $value_office) : ?>
                    <?php if (!(is_null($value_office['office_id']) || is_null($value_office['office_name']))) { ?>
                        <option value="<?php echo $value_office['office_id']; ?>"><?php echo $value_office['office_name']; ?></option>
                    <?php } else { continue; } ?>
                <?php endforeach; ?>
            </select>
            <br />
            <label for="datepicker_start">Начало услуги.</label>
            <br />
            <input type="text" id="datepicker_start" value="<?php echo date("Y-m-d") ?>" name="date_start">
            <br />
            <label for="datepicker_period">Конец услуги.</label>
            <br />
            <input type="text" id="datepicker_period" value="<?php echo date("Y-m-d") ?>" name="date_period">
            <br />
            <label for="month_period">Периуд оплаты</label>
            <br />
            <select name="month_period" id="month_period">
                <?php foreach($officeInfo as $value_office) : ?>
                    <?php if (!(is_null($value_office['month_period_id']) || is_null($value_office['month_count_name']))) { ?>
                        <option value="<?php echo $value_office['month_period_id']; ?>"><?php echo $value_office['month_count_name']; ?></option>
                    <?php } else { continue; } ?>
                <?php endforeach; ?>
            </select>
            <br />
        </fieldset>
        <fieldset>
            <legend>Цена</legend>
            <label for="payment_namber">Номер счета</label>
            <br />
            <input type="text" id="payment_namber" name="stat_payment" required>
            <br />
            <label for="summ">Сумма за месяц</label>
            <br />
            <input type="text" id="summ" name="summ" required>

            <select name="cash_id" id="cash_id">
                <?php foreach($selectCash as $value_cash) : ?>
                    <?php if (!(is_null($value_cash['cash_country']))) { ?>
                        <option value="<?php echo $value_cash['cash_id']; ?>"><?php echo $value_cash['cash_country']; ?></option>
                    <?php } else { continue; } ?>
                <?php endforeach; ?>
            </select>
        </fieldset>
        <input type="submit" value="Добавить улсугу." class="admin_form_add_service_btn" placeholder="">
    </form>

    <table border="2" class="admin_list_service">
        <caption> Список сервисов. </caption>
        <tr>
            <th>№ договора</th>
            <th>№ счета</th>
            <th>Сервис</th>
            <th>Описание сервиса</th>
            <th>Офис</th>
            <th>Дата начала услуги</th>
            <th>Дата получения</th>
            <th>Дата Окончания</th>
            <th>Периуд услуги</th>
            <th>Сумма</th>
            <th>Валюта</th>
            <th>Статус</th>
        </tr>
        <?php foreach($selectJoinInfo as $valueJoinInfo) :?>
        <tr class="<?php setClassForShowStatusTable($valueJoinInfo['status_id']); ?>">
            <td class="border: 1px solid;"><?php echo $valueJoinInfo['agreement_name'];?></td>
            <td class="border: 1px solid;"><?php echo $valueJoinInfo['stat_payment'];?></td>
            <td class="border: 1px solid;"><?php echo $valueJoinInfo['service_name'];?></td>
            <td class="border: 1px solid;"><?php echo $valueJoinInfo['service_about'];?></td>
            <td class="border: 1px solid;"><?php echo $valueJoinInfo['office_name'];?></td>
            <td class="border: 1px solid;"><?php echo $valueJoinInfo['date_start']?></td>
            <td class="border: 1px solid;"><?php echo $valueJoinInfo['date_recieved']?></td>
            <td class="border: 1px solid;"><?php echo $valueJoinInfo['date_period']?></td>
            <td class="border: 1px solid;"><?php echo $valueJoinInfo['month_count_name'];?></td>
            <td class="border: 1px solid;"><?php echo $valueJoinInfo['stat_summ'];?></td>
            <td class="border: 1px solid;"><?php echo $valueJoinInfo['cash_country']?></td>
            <td class="border: 1px solid;">
                <select name="status_service" id="status_service">
                    <option value="<?php echo $valueJoinInfo['status_id']?>"><?php echo $valueJoinInfo['status_name']?></option>
                    <option>-------------</option>
                    <?php foreach ($selectStatus as $key => $valusStat) : ?>
                        <option value="<?php echo $valusStat['status_id']?>"><?php echo $valusStat['status_name']?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php //echo "<pre>"; var_dump($selectJoinInfo); echo "</pre>";  ?>

</body>
</html>
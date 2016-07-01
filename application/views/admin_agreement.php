<?php
include 'header.php';
include 'admin_menu.php';
?>

<div class="conteiner">
    <form action="http://kandagarotchet/index.php/admin_controller/add_service" method="post" class="agreement_form">
        <fieldset>
            <legend>Договор</legend>

            <label for="datepicker_start">Начало действия договора.</label>
            <br />
            <input type="text" id="datepicker_start" value="<?php echo date("Y-m-d") ?>" name="date_start">
            <br />
            <label for="agreement">№ договора</label>
            <br />
            <input type="text" id="agreement" placeholder="№ договора" name="agreement_about" required>

            <div class="service_block_add_field">
                <input type="text" name="user_id" value="<?php echo $userId; ?>" hidden>
                <input type="text" name="user_login" value="<?php echo $userLogin; ?>" hidden>
                <input type="text" name="user_access" value="<?php echo $userAccess; ?>" hidden>
                <label for="service_name">Поставщик</label>
                <br />
                <select name="service_name" id="service_name">
                    <?php foreach ($serviceInfoName as $value_service) : ?>
                        <option
                            value="<?php echo $value_service['service_id'] . "/" . $value_service['service_name']; ?>"><?php echo $value_service['service_name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <br />
                <label for="service_about">Описание услуги</label>
                <br />
                <select name="service_about" id="service_about">
                    <?php foreach ($serviceInfoAbout as $value_service) : ?>
                        <option
                            value="<?php echo $value_service['service_id'] . "/" . $value_service['service_about']; ?>"><?php echo $value_service['service_about']; ?></option>
                    <?php endforeach; ?>
                </select>
                <br />
            </div>

            <!--            ------------------------------------------------------------------>
            <p class="service_block_add_new_field_btn ">+ Добавить новый договор.</p>

            <!--            Этот код добавить в JS, если нету данной услуги в перечне то можно ее добавить с помощью кнопки-->
            <div class="service_block_add_new_field dspNone">

                <label for="service_name_add">Имя услуги</label>
                <br />
                <input id="service_name_add" type="text" name="service_name_add">
                <br />
                <label for="service_about_add">Подробнее об услуге.</label>
                <br />
                <input id="service_about_add" type="text" name="service_about_add">
                <br />
                <span class="service_block_drop_new_field_btn ">Отмена</span>
            </div>
            <!--            ------------------------------------------------------------------>
        </fieldset>
        <fieldset>
            <legend>Офисс и денежные операции</legend>
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
            <label for="month_period">Период оплаты</label>
            <br />
            <select name="month_period" id="month_period">
                <?php foreach($officeInfo as $value_office) : ?>
                    <?php if (!(is_null($value_office['month_period_id']) || is_null($value_office['month_count_name']))) { ?>
                        <option value="<?php echo $value_office['month_period_id']; ?>"><?php echo $value_office['month_count_name']; ?></option>
                    <?php } else { continue; } ?>
                <?php endforeach; ?>
            </select>
            <br />

            <label for="cash_id">Валюта</label>
            <br />

            <select name="cash_id" id="cash_id">
                <?php foreach($selectCash as $value_cash) : ?>
                    <?php if (!(is_null($value_cash['cash_country']))) { ?>
                        <option value="<?php echo $value_cash['cash_id']; ?>"><?php echo $value_cash['cash_country']; ?></option>
                    <?php } else { continue; } ?>
                <?php endforeach; ?>
            </select>
        </fieldset>
        <fieldset>
            <legend>Счет</legend>
            <label for="payment_namber">Номер счета</label>
            <br />

            <input type="text" id="payment_namber" name="stat_payment" >
            <br />

            <label for="summ">Сумма за месяц</label>
            <br />
            <input type="text" id="summ" name="summ" >
        </fieldset>
        <div class="clear"></div>
        <input type="submit" value="Добавить договор." class="admin_form_add_service_btn" placeholder="">
    </form>

    <table border="0" class="admin_list_service" cellpadding="0" cellspacing="0">
        <caption> Список договоров. </caption>
        <tr>
            <th>№ Договора</th>
            <th>Поставщик</th>
            <th>Описание услуги</th>
            <th>Офис</th>
            <th>Дата начала договора</th>
            <th>Периодичность оплаты</th>
            <th>Статус</th>
            <th></th>
        </tr>
        <?php foreach($selectJoinInfo as $valueJoinInfo) :?>
            <tr class="table_tr <?php setClassForShowStatusTable($valueJoinInfo['status_id']); ?>"
                data-agreement="<?php echo $valueJoinInfo['agreement_id'];?>"
                data-main_id="<?php echo $valueJoinInfo['main_id'];?>"
                data-month_period="<?php echo $valueJoinInfo['month_period_id'];?>"
                data-stat_id="<?php echo $valueJoinInfo['stat_id'];?>"
            >
                <td class="table_list"><?php echo $valueJoinInfo['agreement_name'];?></td>
                <td class="table_list"><?php echo $valueJoinInfo['service_name'];?></td>
                <td class="table_list"><?php echo $valueJoinInfo['service_about'];?></td>
                <td class="table_list"><?php echo $valueJoinInfo['office_name'];?></td>
                <td class="table_list"><?php echo $valueJoinInfo['date_start']?></td>
                <td class="table_list date_recieved dspNone"><?php echo $valueJoinInfo['date_recieved']?></td>
                <td class="table_list"><?php echo $valueJoinInfo['month_count_name'];?></td>
                <td class="table_list"><?php echo $valueJoinInfo['status_name']?></td>
                <td class="table_list tbl_list_setting">
                    <i class="fa fa-cog"></i>
                    <div class="close_setting"></div>
                    <div class="row_setting" data-id_service='<?php echo $valueJoinInfo['main']; ?>' data-agreement='<?php echo $valueJoinInfo['agreement_id']; ?>' >
                        <p class="show_status"><i class="fa fa-chevron-left"></i> Статус</p>
                        <div class="status_service">
                            <p data-status_service="<?php echo $valueJoinInfo['status_id'] ?>"><i class="fa fa-check"></i><?php echo $valueJoinInfo['status_name'] ?></p>
                            <p>-------------</p>
                            <?php foreach ($selectStatus as $key => $valusStat) : ?>
                                <p class="status_service_btn" data-status_service="<?php echo $valusStat['status_id'] ?>"><?php echo $valusStat['status_name'] ?></p>
                            <?php endforeach; ?>
                        </div>
                        <p class="show_static">Статистика</p>
                        <?php
                        if ($userAccess == 2) {
                            echo '<p>-------------</p>';
                            echo "<p data-id_service='".$valueJoinInfo['main']."' data-agreement='".$valueJoinInfo['agreement_id']."' class='btn_delete_service'>Удалить</p>";
                        }
                        ?>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="statistic_box">
        <div class="close_setting"></div>
        <ul class="statistic_list">
            <li>Статистика оплаты</li>
        </ul>
    </div>
    <div class='recieve_form dspNone'>
        <form action=''>
            <label for="payment_recieve">№ Счета</label>
            <input type="text" id="payment_recieve" required>
            <label for="summ_recieve">Сумма</label>
            <input type="text" id="summ_recieve" required>
            <input type="submit" value="Внести">
        </form>
    </div>
</div>
</body>
</html>
<?php
include 'header.php';
include 'admin_menu.php';
?>

<div class="conteiner">
    <form action="http://kandagarotchet/index.php/admin_controller/page_admin_future" method="post">
        <fieldset>
            <label for="">Месяц: </label>
            <select name="month_future" id="month_future">
                <?php
                $array_month = array(
                    '',
                    'Январь',
                    'Февраль',
                    'Март',
                    'Апрель',
                    'Май',
                    'Июнь',
                    'Июль',
                    'Август',
                    'Сентябрь',
                    'Октябрь',
                    'Ноябрь',
                    'Декабрь'
                );

                foreach ($array_month as $key_month => $value_month) {
                    if ($key_month == '') {
                        continue;
                    } else {
                        if (date('m') < $key_month) {
                            if ($key_month < 10) {
                                echo "<option value='0{$key_month}'>{$value_month}</option>";
                            } else {
                                echo "<option value='{$key_month}'>{$value_month}</option>";
                            }
                        } else {
                            continue;
                        }
                    }
                }
                ?>
            </select>
            <label for="">Год: </label>
            <select name="year_future" id="year_future">
                <?php
                $countYear = 3;
                $currYear = intval(date('Y'));

                for ($i = 0; $i < $countYear; $i++) {
                    echo "<option value='".$currYear."'>".$currYear."</option>";
                    $currYear++;
                }
                ?>
            </select>
            <input type="text" value="" hidden>
            <input type="submit" name="btn_future_payament" class="btn_future_payament" value="Предсказать будущее">
        </fieldset>
    </form>

    <table border="0" class="admin_list_service" cellpadding="0" cellspacing="0">
        <caption> Список счетов на: <?php echo date('Y-m-01'); ?></caption>
        <tr>
            <th>№ счета</th>
            <th>Поставщик</th>
            <th>Описание услуги</th>
            <th>Офис</th>
            <th>Дата получения</th>
            <th>Периодичность оплаты</th>
            <th>Сумма</th>
            <th>Валюта</th>
            <th>Статус</th>
            <th></th>
        </tr>
        <?php if (is_array($selectJoinInfo) && !empty($selectJoinInfo)) :?>
            <?php foreach ($selectJoinInfo as $valueJoinInfo) :?>
                <tr class="table_tr <?php setClassForShowStatusTable($valueJoinInfo['status_id']); ?>"
                    data-agreement="<?php echo $valueJoinInfo['agreement_id']; ?>"
                    data-main_id="<?php echo $valueJoinInfo['main_id']; ?>"
                    data-month_period="<?php echo $valueJoinInfo['month_period_id']; ?>"
                    data-stat_id="<?php echo $valueJoinInfo['stat_id']; ?>"
                >
                    <td class="table_list"><?php echo $valueJoinInfo['stat_payment']; ?></td>
                    <td class="table_list"><?php echo $valueJoinInfo['service_name']; ?></td>
                    <td class="table_list"><?php echo $valueJoinInfo['service_about']; ?></td>
                    <td class="table_list"><?php echo $valueJoinInfo['office_name']; ?></td>
                    <td class="table_list stat_month"><?php echo $valueJoinInfo['stat_month'] ?></td>
                    <td class="table_list"><?php echo $valueJoinInfo['month_count_name']; ?></td>
                    <td class="table_list"><?php echo $valueJoinInfo['stat_summ']; ?></td>
                    <td class="table_list"><?php echo $valueJoinInfo['cash_country'] ?></td>
                    <td class="table_list"><?php echo $valueJoinInfo['status_name'] ?></td>
                    <td class="table_list tbl_list_setting">
                        <i class="fa fa-cog"></i>
                        <div class="close_setting"></div>
                        <div class="row_setting" data-id_service='<?php echo $valueJoinInfo['main']; ?>'
                             data-agreement='<?php echo $valueJoinInfo['agreement_id']; ?>'>
                            <p class="show_status"><i class="fa fa-chevron-left"></i> Статус</p>
                            <div class="status_service">
                                <p data-status_service="<?php echo $valueJoinInfo['status_id'] ?>"><i
                                        class="fa fa-check"></i><?php echo $valueJoinInfo['status_name'] ?></p>
                                <p>-------------</p>
                                <?php foreach ($selectStatus as $key => $valusStat) : ?>
                                    <p class="status_service_btn"
                                       data-status_service="<?php echo $valusStat['status_id'] ?>"><?php echo $valusStat['status_name'] ?></p>
                                <?php endforeach; ?>
                            </div>
                            <p class="show_static">Статистика</p>
                            <p class="show_agreement">Договор</p>
                            <?php
                            if ($userAccess == 2) {
                                echo '<p>-------------</p>';
                                echo "<p data-id_service='" . $valueJoinInfo['main_id'] . "' data-agreement='" . $valueJoinInfo['agreement_id'] . "' class='btn_delete_service'>Удалить</p>";
                            }
                            ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; else:?>
            <tr class="table_tr">
                <td class="table_list" colspan="10">Нет счетов.</td>
            </tr>
        <?php endif; ?>
    </table>
    <!--  -----------------------------------------------------------------------------------  -->
    <!--  -----------------------------------------------------------------------------------  -->
    <!--  -----------------------------------------------------------------------------------  -->
    <div class="statistic_box">
        <div class="close_setting"></div>
        <ul class="statistic_list">
            <li>Статистика оплаты</li>
        </ul>
    </div>
    <!--  -----------------------------------------------------------------------------------  -->
    <!--  -----------------------------------------------------------------------------------  -->
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
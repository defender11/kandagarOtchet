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
                            if ($key_month < 10) {
                                echo "<option value='0{$key_month}'>{$value_month}</option>";
                            } else {
                                echo "<option value='{$key_month}'>{$value_month}</option>";
                            }
                    }
                }
                ?>
            </select>
            <label for="">Год: </label>
            <select name="year_future"  id="year_future">
                <?php
                $countYear = 3;
                $currYear = intval(date('Y'));

                for ($i = 0; $i < $countYear; $i++) {
                    echo "<option value='".$currYear."'>".$currYear."</option>";
                    $currYear++;
                }
                ?>
            </select>
            <?php
            $countYear = 3;
            $currYear = intval(date('Y'));

            for ($i = 0; $i < $countYear; $i++) {
                echo "<input type='text' name='year_f".$i."' value='".$currYear."' hidden/>";
                $currYear++;
            }

            ?>
            <input type="submit" name="btn_future_payament" class="btn_future_payament" value="Предсказать будущее">
        </fieldset>
    </form>

    <table border="0" class="admin_list_service" cellpadding="0" cellspacing="0">
        <caption>
            <?php
                if ($futureData[0]['selectData'] == "-" || $futureData[0]['selectData'] == "--30") {
                    echo "Список счетов пуст. Выберите дату!";
                } else {
                    echo "Список счетов на: " .$futureData[0]['selectData'];
                }
            ?>
        </caption>
        <tr>
            <th>Поставщик</th>
            <th>Описание услуги</th>
            <th>Офис</th>
            <th>Дата получения</th>
            <th>Периодичность оплаты</th>
            <th>Сумма</th>
            <th>Валюта</th>
            <th>Статус</th>
        </tr>
        <?php if (is_array($futureData) && !empty($futureData)) : ?>
            <?php foreach ($futureData as $valueJoinInfo) : ?>
                <?php if (!empty($valueJoinInfo['new_months'][0])) : ?>
                    <tr class="table_tr <?php setClassForShowStatusTable($valueJoinInfo['status_id']); ?>"
                        data-agreement="<?php echo $valueJoinInfo['agreement_id']; ?>"
                        data-main_id="<?php echo $valueJoinInfo['main_id']; ?>"
                        data-month_period="<?php echo $valueJoinInfo['month_period_id']; ?>"
                        data-stat_id="<?php echo $valueJoinInfo['stat_id']; ?>"
                    >
                        <td class="table_list"><?php echo $valueJoinInfo['service_name']; ?></td>
                        <td class="table_list"><?php echo $valueJoinInfo['service_about']; ?></td>
                        <td class="table_list"><?php echo $valueJoinInfo['office_name']; ?></td>
                        <td class="table_list stat_month"><?php echo $valueJoinInfo['new_months'][0] ?></td>
                        <td class="table_list"><?php echo $valueJoinInfo['month_count_name']; ?></td>
                        <td class="table_list"><?php echo $valueJoinInfo['stat_summ']; ?></td>
                        <td class="table_list"><?php echo $valueJoinInfo['cash_country'] ?></td>
                        <td class="table_list"><?php echo $valueJoinInfo['status_name'] ?></td>
                    </tr>
                <?php endif; ?>
        <?php
            endforeach;
        else: ?>
            <tr class="table_tr">
                <td class="table_list" colspan="10">Нет счетов.</td>
            </tr>
        <?php endif; ?>
        </tr>
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
<?php include 'footer.php'; ?>
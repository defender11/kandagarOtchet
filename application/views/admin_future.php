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
            <input type="text" value="" hidden>
            <input type="submit" name="btn_future_payament" class="btn_future_payament" value="Предсказать будущее">
        </fieldset>
    </form>

    <table border="0" class="admin_list_service" cellpadding="0" cellspacing="0">
        <caption>
            <?php
                if ($futureData['selectData'] == "-") {
                    echo "Список счетов пуст. Выберите дату!";
                } else {
                    echo "Список счетов на: " .$futureData['selectData']. "-01";
                }
            ?>
        </caption>
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
        <tr>
            <td>

            </td>
        </tr>
    </table>
    <?php echo "<pre>"; var_dump($futureData); echo "</pre>";  ?>
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
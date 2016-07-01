<?php
include 'header.php';
include 'admin_menu.php';
?>

<div class="conteiner">
    <form action="" method="post">
        <fieldset>
            <label for="">Месяц: </label>
            <select name="" id="">
                <option value="01">Январь</option>
                <option value="02">Февраль</option>
                <option value="03">Март</option>
                <option value="04">Апрель</option>
                <option value="05">Май</option>
                <option value="06">Июнь</option>
                <option value="07">Июль</option>
                <option value="08">Август</option>
                <option value="09">Сентябрь</option>
                <option value="10">Октябрь</option>
                <option value="11">Ноябрь</option>
                <option value="12">Декабрь</option>
            </select>
            <label for="">Год: </label>
            <select name="" id="">
                <?php
                $countYear = 3;
                $currYear = intval(date('Y'));

                for ($i = 0; $i < $countYear; $i++) {
                    echo "<option value='".$currYear."'>".$currYear."</option>";
                    $currYear++;
                }
                ?>
            </select>
            <input type="submit" value="Предсказать будущее">
        </fieldset>
    </form>

    <table border="0" class="admin_list_service" cellpadding="0" cellspacing="0">
        <caption> Список сервисов на: <?php echo date('Y-m'); ?></caption>
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

        <?php foreach($selectJoinInfo as $valueJoinInfo) :?>
        <tr class="table_tr <?php setClassForShowStatusTable($valueJoinInfo['status_id']); ?>"
            data-agreement="<?php echo $valueJoinInfo['agreement_id'];?>"
            data-main_id="<?php echo $valueJoinInfo['main_id'];?>"
            data-month_period="<?php echo $valueJoinInfo['month_period_id'];?>"
            data-stat_id="<?php echo $valueJoinInfo['stat_id'];?>"
        >
            <td class="table_list"><?php echo $valueJoinInfo['stat_payment'];?></td>
            <td class="table_list"><?php echo $valueJoinInfo['service_name'];?></td>
            <td class="table_list"><?php echo $valueJoinInfo['service_about'];?></td>
            <td class="table_list"><?php echo $valueJoinInfo['office_name'];?></td>
            <td class="table_list date_recieved"><?php echo $valueJoinInfo['date_recieved']?></td>
            <td class="table_list"><?php echo $valueJoinInfo['month_count_name'];?></td>
            <td class="table_list"><?php echo $valueJoinInfo['stat_summ'];?></td>
            <td class="table_list"><?php echo $valueJoinInfo['cash_country']?></td>
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
                    <p class="show_agreement">Договор</p>
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
<div class="menu">
    <div class="user_info">
        <p>
            <strong>Пользователь:</strong> <span class='user_login'><u><?php echo $userLogin; ?></u></span>
        </p>
        <p>
            <strong>Уровень доступа:</strong> <span class='user_access'><u><?php echo $userAccessName; ?></u></span>
        </p>
        <p>
            <strong>Сегодня:</strong> <u><?php echo date('Y-m-d'); ?></u>
        </p>
    </div>
    <div class="menu_box">
        <ul class="menu_box_">
            <li><a href="<?php echo base_url(); ?>page_admin">Главная</a></li>
            <li><a href="<?php echo base_url(); ?>page_admin_agreement">Договора</a></li>
            <li><a href="<?php echo base_url(); ?>page_admin_add_service">Счета</a></li>
            <li><a href="<?php echo base_url(); ?>page_admin_add_service">Список поставщиков</a></li>
            <li><a href="<?php echo base_url(); ?>page_admin_future">Будущие счета</a></li>
            <li><a href="<?php echo base_url(); ?>logout">Выход</a></li>
        </ul>
    </div>
    <div class="clear"></div>


</div>
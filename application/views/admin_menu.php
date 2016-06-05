<div class="menu">
    <div class="user_info">
        <p>
            Пользователь: <span class='user_login'><?php echo $userLogin; ?></span>
            Уровень доступа: <span class='user_access'><?php echo $userAccessName; ?></span>
        </p>
    </div>
    <div class="menu_box">
        <ul class="menu_box_">
            <li><a href="<?php echo base_url(); ?>page_admin">Главная</a></li>
            <li><a href="<?php echo base_url(); ?>page_admin_agreement">Договора</a></li>
            <li><a href="<?php echo base_url(); ?>page_admin_add_service">Счета</a></li>
            <li><a href="<?php echo base_url(); ?>logout">Выход</a></li>
        </ul>
    </div>
    <div class="clear"></div>


</div>
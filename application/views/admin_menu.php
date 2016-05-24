<div class="menu">
    <div class="user_info">
        <p>
            <strong><i class="fa fa-user" aria-hidden="true"></i>:</strong> <span class='user_login'><u><?php echo $userLogin; ?></u></span>
        </p>
        <p>
            <strong><i class="fa fa-users" aria-hidden="true"></i>:</strong> <span class='user_access'><u><?php echo $userAccessName; ?></u></span>
        </p>
        <p>
            <strong><i class="fa fa-calendar" aria-hidden="true"></i>:</strong> <u><?php echo date('Y-m-d'); ?></u>
        </p>
        <p>
            <strong><i class="fa fa-clock-o" aria-hidden="true"></i>:</strong> <u><span id="crntTime"><i class="fa fa-spinner fa-pulse fa-fw margin-bottom"></i></span></u>
        </p>
    </div>
    <div class="menu_box">
        <ul class="menu_box_">
            <li><a href="<?php echo base_url(); ?>page_admin">Главная</a></li>
            <li><a href="<?php echo base_url(); ?>page_admin_agreement">Договора</a></li>
            <li><a href="<?php echo base_url(); ?>page_admin_add_service">Счета</a></li>
            <li><a href="<?php echo base_url(); ?>page_admin_list_service">Список поставщиков</a></li>
            <li><a href="<?php echo base_url(); ?>page_admin_future">Будущие счета</a></li>
            <li><a href="<?php echo base_url(); ?>logout">Выход</a></li>
        </ul>
    </div>

    <div class="clear"></div>
<!--    --><?//=$this->benchmark->memory_usage();?>
<!--    --><?//=$this->benchmark->elapsed_time();?>

</div>
<?php
include 'header.php';
include 'admin_menu.php';
?>
<div class="conteiner">
    <h1 style="text-align: center;">Главная страница.</h1>
    <?php if (!empty($build_log)) : ?>
        <p><h5>Рабочий процесс. <span class="recieved">Впроцессе</span>   <span class="good">Выполнил</span></h5></p>
    <?php else : ?>
        <p><h4>Нет рабочего процесса! Надо работать!</h4></p>
    <?php endif; ?>
    <!-- Поправить добавление счета и суммы -->
        <?php if ($this->session->userdata('user_access') == "3") :?>
            <div class="build_box">
                <ul>
                    <?php foreach ($build_log as $build_item) : ?>
                        <?php if ($build_item['build_stat'] == 0) : ?>
                            <li class="build_box_row recieved" data-bid="<?php echo $build_item['build_id']; ?>">
                                <p><h6 class="build_box_user_info">Пользователь: <?php echo $build_item['build_user']; ?>,
                                    Время: <?php echo $build_item['build_date']; ?>,
                                    version: <?php echo $build_item['build_ver']; ?></h6></p>
                                <p>
                                    <h4 class="build_box_about"><?php echo $build_item['build_about']; ?> </h4>
                                    <span class="btn btn_box_build_run" data-build_trigger="2">Выполнил</span> <span class="btn btn_box_build_del" data-build_trigger="3">Удалить</span>
                                </p>

                            </li>
                        <?php else : ?>
                            <li class="build_box_row good" data-bid="<?php echo $build_item['build_id']; ?>">
                                <p><h6 class="build_box_user_info">Пользователь: <?php echo $build_item['build_user']; ?>,
                                    Время: <?php echo $build_item['build_date']; ?>,
                                    version: <?php echo $build_item['build_ver']; ?></h6></p>
                                <p>
                                    <h4 class="build_box_about"><?php echo $build_item['build_about']; ?> </h4>
                                    <span class="btn btn_box_build_back" data-build_trigger="4">Отменить</span> <span class="btn btn_box_build_del" data-build_trigger="3">Удалить</span>
                                </p>

                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
            <form action="<?php echo base_url(); ?>build_log_change" method="post">
                <fieldset>
                    <legend>Добавить изменение.</legend>
                    <p><strong><i class="fa fa-user" aria-hidden="true"></i>:</strong> <span class='user_login'><u><?php echo $this->session->userdata('user_login'); ?></u></span>, <strong><i class="fa fa-calendar" aria-hidden="true"></i>:</strong> <u><?php echo date('Y-m-d'); ?></u>, <strong><i class="fa fa-code-fork" aria-hidden="true"></i>: <?php echo @$build_item['build_ver']; ?></strong></p>
                    <input type="text" name="build_id" value="<?php echo @$build_item['build_id']; ?>" hidden>
                    <input type="text" name="build_user" value="<?php echo $this->session->userdata('user_login'); ?>" hidden>
                    <p><input type="text" name="build_ver" required value="<?php echo @$build_item['build_ver']; ?>" style="color: rgb(150,150,150); padding: 5px;"></p>
                    <p><textarea name="build_about" id="" cols="110" rows="1" required style="color: rgb(87, 87, 87); padding: 5px;"></textarea></p>
                    <input type="submit" name="btn_add_log" class="btn">
                </fieldset>
            </form>
        <?php else : ?>
            <div class="build_box">
                <ul>
                    <?php foreach ($build_log as $build_item) : ?>
                        <?php if ($build_item['build_stat'] == 0) : ?>
                            <li class="build_box_row recieved">
                                <p><h6 class="build_box_user_info">Пользователь: <?php echo $build_item['build_user']; ?>,
                                    Время: <?php echo $build_item['build_date']; ?>,
                                    version: <?php echo $build_item['build_ver']; ?></h6></p>
                                <p><h4 class="build_box_about"><?php echo $build_item['build_about']; ?> </h4></p>
                            </li>
                        <?php else : ?>
                            <li class="build_box_row good">
                                <p><h6 class="build_box_user_info">Пользователь: <?php echo $build_item['build_user']; ?>,
                                    Время: <?php echo $build_item['build_date']; ?>,
                                    version: <?php echo $build_item['build_ver']; ?></h6></p>
                                <p><h4 class="build_box_about"><?php echo $build_item['build_about']; ?> </h4></p>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
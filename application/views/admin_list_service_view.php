<?php
include 'header.php';
include 'admin_menu.php';
?>

<div class="conteiner">

    <table border="0" class="admin_list_service" cellpadding="0" cellspacing="0">
        <tr>
            <td class="table_list" colspan="10" style="background: rgb(251, 236, 236) none repeat scroll 0% 0%;">* Удаляя поставщиков, удалаються так же договора и все счета которые привязаны к договору.</td>
        </tr>
        <caption> Список поставщиков.</caption>

        <tr>
            <th>Поставщик</th>
            <th>Описание услуги</th>
            <th></th>
        </tr>
        <?php if (is_array($serviceInfo) && !empty($serviceInfo)) :?>
            <?php foreach ($serviceInfo as $sInfo) :?>
                <tr class="table_tr schange <?php echo $sInfo['service_id']; ?>" data-sid="<?php echo $sInfo['service_id']; ?>">
                    <td class="table_list sName"><?php echo $sInfo['service_name']; ?></td>
                    <td class="table_list sAbout"><?php echo $sInfo['service_about']; ?></td>

                    <td class="table_list tbl_list_setting ">
                        <p><i class="fa fa-pencil-square-o btn_edit" aria-hidden="true"></i>
                            <?php if ($userAccess == 2 || $userAccess == 3) : ?>
                                <i class="fa fa-trash-o btn_del" aria-hidden="true"></i>
                            <?php endif; ?>
                        </p>
                    </td>

                </tr>
            <?php endforeach; else:?>
            <tr class="table_tr">
                <td class="table_list" colspan="10">Нет счетов.</td>
            </tr>
        <?php endif; ?>
    </table>
    <!--  -----------------------------------------------------------------------------------  -->
    <div class="close_setting"></div>
    <div class='form_change_service dspNone form-close' data-service-id="">
        <span class="btn_close "><i class="fa fa-times" aria-hidden="true"></i></span>
        <label for="service_name">Имя поставщика</label>
        <p><input type="text" name="service_name" id="service_name" required></p>
        <label for="service_about">Описание услуги</label>
        <p><textarea name="service_about" id="service_about" cols="30" rows="10"></textarea></p>
        <p class="btn_change_service btn">Изменить</p>
    </div>
</div>
<?php include 'footer.php'; ?>
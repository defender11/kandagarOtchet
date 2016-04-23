<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Main</title>
    <link rel="stylesheet" href="../../public/css/style.css?v=1.0">
    <link rel="stylesheet" href="../../public/css/jquery-ui.css?v=1.0">
    <link rel="stylesheet" href="../../public/css/jquery-ui.structure.min.css?v=1.0">
    <link rel="stylesheet" href="../../public/css/jquery-ui.theme.min.css?v=1.0">

    <script src="http://code.jquery.com/jquery-1.9.0.js"></script>
    <script src="../../public/js/jquery-ui.min.js"></script>
    <script src="../../public/js/common.js?v=1.0"></script>
    <script>
        $(function() {
            $( "#datepicker_start" ).datepicker({
                numberOfMonths: 2,
                showButtonPanel: true,
                showOn: "button",
                buttonImage: "../../public/img/calendar.gif",
                buttonImageOnly: true,
                buttonText: "Select date",
                dateFormat: "yy-mm-dd",
                minDate: -20
            });

            $( "#datepicker_period" ).datepicker({
                numberOfMonths: 4,
                showButtonPanel: true,
                showOn: "button",
                buttonImage: "../../public/img/calendar.gif",
                buttonImageOnly: true,
                buttonText: "Select date",
                dateFormat: "yy-mm-dd",
                minDate: -20
            });

        });
    </script>
</head>
<body>
<?php include 'admin_menu.php'; ?>
<div class="container">
    <table border="1" class="admin_list_service">
        <caption> Список сервисов. </caption>
        <tr>
            <th>Сервис</th>
            <th>Описание сервиса</th>
            <th>Офис</th>
            <th>Дата получения</th>
            <th>Дата Окончания</th>
            <th>Статус</th>
            <th>Сумма</th>
            <th>Валюта</th>
        </tr>
        <?php foreach($selectJoinInfo as $valueJoinInfo) :?>
            <tr>
                <td class="border: 1px solid;"><?php echo $valueJoinInfo['service_name'];?></td>
                <td class="border: 1px solid;"><?php echo $valueJoinInfo['service_about']?></td>
                <td class="border: 1px solid;"><?php echo $valueJoinInfo['office_name']?></td>
                <td class="border: 1px solid;"><?php echo $valueJoinInfo['date_recieved']?></td>
                <td class="border: 1px solid;"><?php echo $valueJoinInfo['date_period']?></td>
                <td class="border: 1px solid;"><?php echo $valueJoinInfo['status_name']?></td>
                <td class="border: 1px solid;"><?php echo $valueJoinInfo['sum']?></td>
                <td class="border: 1px solid;"><?php echo $valueJoinInfo['cash_country']?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>



</body>
</html>
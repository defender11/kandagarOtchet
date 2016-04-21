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
    <script>
        $(function() {
            $( "#datepicker_start" ).datepicker({
                numberOfMonths: 2,
                showButtonPanel: true,
                showOn: "button",
                buttonImage: "../../public/img/calendar.gif",
                buttonImageOnly: true,
                buttonText: "Select date",
                dateFormat: "yy-mm-dd"
            });
            $( "#datepicker_period" ).datepicker({
                numberOfMonths: 4,
                showButtonPanel: true,
                showOn: "button",
                buttonImage: "../../public/img/calendar.gif",
                buttonImageOnly: true,
                buttonText: "Select date",
                dateFormat: "yy-mm-dd"
            });

        });
    </script>
</head>
<body>
<?php include 'admin_menu.php'; ?>
<div class="container">
    <form action="http://kandagarotchet/index.php/admin_controller/add_service" method="post">
        <fieldset>
            <legend>Услуги</legend>
            <label for="service_name">Имя услуги</label>
            <select name="service_name" id="service_name">
                <?php foreach($serviceInfo as $value_service) : ?>
                <option value="<?php echo $value_service['service_id']; ?>"><?php echo $value_service['service_name']; ?></option>
                <?php endforeach; ?>
            </select>
            <label for="service_about">Сфера деятельности</label>
            <select name="service_about" id="service_about">
                <?php foreach($serviceInfo as $value_service) : ?>
                    <option value="<?php echo $value_service['service_id']; ?>"><?php echo $value_service['service_about']; ?></option>
                <?php endforeach; ?>
            </select>

            <!--            ------------------------------------------------------------------>
            <p style="color: blue; text-decoration: underline; cursor: pointer;">+ Добавить новую услугу.</p>

            <!--            Этот код добавить в JS, если нету данной услуги в перечне то можно ее добавить с помощью кнопки-->
            <!--            <label for="service_name">Имя услуги</label>-->
            <!--            <input id="service_name" type="text" name="service_name">-->
            <!--            <label for="service_about">Подробнее об услуге.</label>-->
            <!--            <input id="service_about" type="text" name="service_about">-->
            <!--            ------------------------------------------------------------------>
        </fieldset>
        <fieldset>
            <legend>Офисс</legend>
            <label for="office_name">Название офиса</label>
            <br />
            <select name="office_id" id="office_name">
                <?php foreach($officeInfo as $value_office) : ?>
                    <?php if (!(is_null($value_office['office_id']) || is_null($value_office['office_name']))) { ?>
                        <option value="<?php echo $value_office['office_id']; ?>"><?php echo $value_office['office_name']; ?></option>
                    <?php } else { continue; } ?>
                <?php endforeach; ?>
            </select>
            <br />
            <label for="datepicker_start">Начало услуги.</label>
            <br />
            <input type="text" id="datepicker_start" value="<?php echo date("Y-m-d") ?>" name="date_start">
            <br />
            <label for="datepicker_period">Конец услуги.</label>
            <br />
            <input type="text" id="datepicker_period" value="<?php echo date("Y-m". 1 ."-d") ?>" name="date_period">
            <br />
            <label for="month_period">Периуд оплаты</label>
            <br />
            <select name="month_period" id="month_period">
                <?php foreach($officeInfo as $value_office) : ?>
                    <?php if (!(is_null($value_office['month_period_id']) || is_null($value_office['month_count_name']))) { ?>
                        <option value="<?php echo $value_office['month_period_id']; ?>"><?php echo $value_office['month_count_name']; ?></option>
                    <?php } else { continue; } ?>
                <?php endforeach; ?>
            </select>
            <br />
        </fieldset>
        <fieldset>
            <legend>Цена</legend>
            <label for="summ">Сумма за месяц</label>
            <br />
            <input type="text" id="summ" name="summ">
        </fieldset>
        <input type="submit" value="Добавить" placeholder="Добавить">
    </form>

    <div class="list_service">
        <ul>
            <li>Список услуг.</li>
<!--            --><?php //foreach() :?>
            <li><a href="#"></a></li>
<!--            --><?//php?>
        </ul>
    </div>
</div>



</body>
</html>
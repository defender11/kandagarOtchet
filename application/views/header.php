<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include 'function.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Main</title>
    <link rel="stylesheet" href="../../public/css/style.css?v=1.0">
    <link rel="stylesheet" href="../../public/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../public/css/jquery-ui.css">
    <link rel="stylesheet" href="../../public/css/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="../../public/css/jquery-ui.theme.min.css">

    <script src="http://code.jquery.com/jquery-1.9.0.js"></script>
    <script src="../../public/js/jquery-ui.min.js"></script>
    <script src="../../public/js/common.js?v=1.1"></script>
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
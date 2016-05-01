<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include 'function.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="../../public/css/style.css?v=1.0">

    <script src="http://code.jquery.com/jquery-1.9.0.js"></script>
    <script src="../../public/js/common.js?v=1.0"></script>

</head>
<body>

<div class="conteiner">
    <form action="http://kandagarotchet/login_check" method="post">
        <fieldset>
            <legend>Авторизация</legend>
            <input type="text" placeholder="Логин" name="login">
            <input type="text" placeholder="Пароль" name="passwd">
            <input type="submit" value="Вход" name="check_login_btn">
        </fieldset>
    </form>
</div>
<?php //echo "<pre>"; var_dump($selectJoinInfo); echo "</pre>";  ?>

</body>
</html>
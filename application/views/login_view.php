<?php
include 'header.php';
?>
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
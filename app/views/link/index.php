<input type="submit" value="Войти" id="log" name="log" onclick="document.location='user/login'">
<input type="submit" value="Зарегистрироваться" id="reg" name="reg" onclick="document.location='user/registration'">
<form action="/" method="post" id="form">
    <input placeholder="Введите ссылку, которую нужно сократить" id="link" name="link">
    <input type="submit" value="Сократить" id="cut" name="cut" disabled>
</form>
<?php if (isset($data)) {
    echo '<br><input id="short_link" name="short_link" value="http://' . $_SERVER['SERVER_NAME'] . '/' . $data . '" disabled>' . PHP_EOL;
} ?>
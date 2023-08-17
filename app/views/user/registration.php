<form action="/user/registration" method="post">
    <p>E-mail<samp style="color:red">*</samp></p><input type="email" id="email" name="email" required>
    <p>Пароль<samp style="color:red">*</samp></p><input type="password" id="pass" name="pass" required>
    <p><input type="submit" value="Зарегистрироваться" id="reg" name="reg"></p>
    <input type="submit" value="На главную" id="back" name="back" onclick="document.location='/'">
</form>
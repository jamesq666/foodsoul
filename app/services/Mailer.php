<?php

Class Mailer
{
    public static function sendEmail($email, $hash)
    {
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "To: <$email>\r\n";
        $headers .= "From: <mail@example.com>\r\n";

        $message = '
                <html>
                <head>
                <title>Подтвердите Email</title>
                </head>
                <body>
                <p>Что бы подтвердить Email, перейдите по <a href="/user/confirm/?hash=' . $hash . '">ссылке</a></p>
                </body>
                </html>
                ';

        return mail($email, "Подтвердите Email на сайте", $message, $headers);
    }
}

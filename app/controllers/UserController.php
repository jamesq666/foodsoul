<?php

class UserController extends Controller
{
    /**
     * @return void
     */
    public function actionLogin()
    {
        if (!empty($_POST)) {
            if (isset($_POST['email']) && isset($_POST['pass'])) {
                $user = new User();
                $row = $user->findByMail($_POST['email']);

                if ($row) {
                    if (password_verify($_POST['pass'], $row['password'])) {
                        return $this->view->render('user/_template.php', 'layouts/template.php', 'Вы успешно авторизованы');
                    } else {
                        return $this->view->render('user/_template.php', 'layouts/template.php', 'Введен неверный пароль');
                    }
                } else {
                    return $this->view->render('user/_template.php', 'layouts/template.php', 'Не верно введен e-mail или пароль');
                }
            }
        }

        return $this->view->render('user/login.php', 'layouts/template.php');
    }

    /**
     * @return void
     */
    public function actionRegistration()
    {
        if (!empty($_POST)) {
            if (isset($_POST['email']) && isset($_POST['pass'])) {
                $user = new User();
                $row = $user->findByMail($_POST['email']);

                if (!$row) {
                    $user->email = $_POST['email'];
                    $user->password = password_hash($_POST['pass'], PASSWORD_DEFAULT);
                    $user->hash = md5($user->email . time());

                    if ($user->save()) {
                        $send = Mailer::sendEmail($user->email, $user->hash);

                        if ($send) {
                            return $this->view->render('user/_template.php', 'layouts/template.php', 'Регистрация прошла успешно');
                        } else {
                            return $this->view->render('user/_template.php', 'layouts/template.php', 'Что-то пошло не так');
                        }
                    } else {
                        return $this->view->render('user/_template.php', 'layouts/template.php', 'Что-то пошло не так');
                    }
                } else {
                    return $this->view->render('user/_template.php', 'layouts/template.php', 'Такой пользователь уже зарегистрирован');
                }
            }
        }

        return $this->view->render('user/registration.php', 'layouts/template.php');
    }

    /**
     * @return void
     */
    public function actionConfirm()
    {
        if (isset($_GET['hash'])) {
            $user = new User();
            $row = $user->findByHash($_GET['hash']);

            if ($row) {
                if ($row['email_confirmed'] == '0') {
                    if ($user->setConfirmEmail($row['id'])) {
                        return $this->view->render('user/_template.php', 'layouts/template.php', 'E-mail подтвержден');
                    } else {
                        return $this->view->render('user/_template.php', 'layouts/template.php', 'E-mail не подтвержден');
                    }
                } else {
                    return $this->view->render('user/_template.php', 'layouts/template.php', 'E-mail уже подтвержден');
                }
            } else {
                return $this->view->render('user/_template.php', 'layouts/template.php', 'Пользователь не найден');
            }
        }
    }
}

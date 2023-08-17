<?php

class LinkController extends Controller
{
    /**
     * @return void|null
     */
    public function actionIndex()
    {
        $link = new Link();

        if (!empty($_POST)) {
            if (isset($_POST['link'])) {
                $link->link = $_POST['link'];
                $shortLink = $link->getShortLink($_POST['link']);

                if (!$shortLink) {
                    $shortLink = $link->createShortLink();
                    $link->link = $_POST['link'];
                    $link->shortLink = $shortLink;
                    if (!$link->save()) {
                        return $this->view->render('link/_template.php', 'layouts/template.php', 'Что-то пошло не так');
                    }
                }

                return $this->view->render('link/index.php', 'layouts/template.php', $shortLink);
            }
        }

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($routes[1])) {
            $link = $link->getLink($routes[1]);

            if ($link) {
                header('Location: https://' . $link);
            }
        }

        return $this->view->render('link/index.php', 'layouts/template.php');
    }
}

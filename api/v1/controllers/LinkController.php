<?php

class LinkController extends Controller
{
    /**
     * @return void
     */
    public function actionIndex()
    {
        if (!empty($_GET['url'])) {
            $link = new Link();
            $shortLink = $link->getShortLink($_GET['url']);

            if ($shortLink) {
                $this->response(200, "Link Found", $shortLink);
            } else {
                $shortLink = $link->createShortLink();
                $link->link = $_GET['url'];
                $link->shortLink = $shortLink;

                if ($link->save()) {
                    $this->response(200, "Link Create", $shortLink);
                }
            }
        } else {
            $this->response(400, "Invalid Request", NULL);
        }
    }

    /**
     * @param $status
     * @param $statusMessage
     * @param $data
     * @return void
     */
    function response($status, $statusMessage, $data)
    {
        header("HTTP/1.1 " . $status);
        header("Content-Type:application/json");

        $response['status'] = $status;
        $response['status_message'] = $statusMessage;
        $response['data'] = $data;

        $jsonResponse = json_encode($response);

        echo $jsonResponse;
    }
}

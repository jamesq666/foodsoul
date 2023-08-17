<?php

class View
{
    /**
     * @param $content
     * @param $template
     * @param $data
     * @return void
     */
    function render($content, $template, $data = null)
    {
        include 'app/views/' . $template;
    }
}

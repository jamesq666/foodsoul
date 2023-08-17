<?php

class Link extends Model
{
    public $id;
    public $link;
    public $shortLink;
    public $created_at;

    /**
     * @return false|PDOStatement|null
     */
    public function save()
    {
        return db::run("INSERT INTO `short_links` (`link`, `short_link`) VALUES (?, ?)", [$this->link, $this->shortLink]);
    }

    /**
     * @return mixed|void
     */
    public function getShortLink($link)
    {
        $row = db::run("SELECT `short_link` FROM `short_links` WHERE `link` = ?", [$link])->fetch();

        return $row['short_link'];
    }

    /**
     * @return mixed|void
     */
    public function getLink($short_link)
    {
        $row = db::run("SELECT `link` FROM `short_links` WHERE `short_link` = ?", [$short_link])->fetch();

        return $row['link'];
    }

    /**
     * @return string
     */
    public function createShortLink()
    {
        return mb_substr(uniqid(md5(rand()), true), 0, 5);
    }
}

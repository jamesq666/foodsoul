<?php

class User extends Model
{
    public $id;
    public $email;
    public $password;
    public $hash;
    public $email_confirmed;
    public $created_at;

    /**
     * @return false|PDOStatement|null
     */
    public function save()
    {
        return db::run("INSERT INTO `user` (`email`, `password`, `hash`) VALUES (?, ?, ?)", [$this->email, $this->password, $this->hash]);
    }

    /**
     * @return mixed|void
     */
    public function findByMail($email)
    {
        return db::run("SELECT * FROM `user` WHERE `email` = ?", [$email])->fetch();
    }

    /**
     * @return mixed|void
     */
    public function findByHash($hash)
    {
        return db::run("SELECT * FROM `user` WHERE `hash` = ?", [$hash])->fetch();
    }

    /**
     * @return false|PDOStatement
     */
    public function setConfirmEmail($id)
    {
        return db::run("UPDATE `user` SET `email_confirmed` = 1 WHERE `id` = ?", [$id]);
    }
}

<?php

namespace Masterclass\Model;

use Masterclass\Dbal\AbstractDb;

class User
{
    /**
     * @var AbstractDb
     */
    protected $db;
    public function __construct(AbstractDb $db) {
        $this->db = $db;
    }

    /**
     * @param $username
     * @return mixed
     */
    public function checkUsername($username)
    {
        $check_sql = 'SELECT * FROM user WHERE username = ?';
        return $this->db->fetchAll($check_sql, [$username]);
    }

    /**
     * @param $username
     * @param $email
     * @param $password
     * @return string
     */
    public function createUser($username, $email, $password)
    {
        $sql = 'INSERT INTO user (username, email, password) VALUES (?, ?, ?)';
        $this->db->execute($sql, array(
            $username,
            $email,
            md5($username . $password)
        ));

        return $this->db->lastInsertId();
    }

    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function updatePassword($username, $password)
    {
        $sql = 'UPDATE user SET password = ? WHERE username = ?';
        // THIS IS NOT SECURE.
        $this->db->execute($sql, array(
            md5($username . $password),
            $username,
        ));
        // THIS IS NOT SECURE.
        return true;
    }

    public function getUserInfo($username)
    {
        $dsql = 'SELECT * FROM user WHERE username = ?';
        return $this->db->fetchOne($dsql, [$username]);
    }

    public function validateUser($username, $password)
    {
        $password = md5($username . $password); // THIS IS NOT SECURE. DO NOT USE IN PRODUCTION.
        $sql = 'SELECT * FROM user WHERE username = ? AND password = ? LIMIT 1';
        return $this->db->fetchOne($sql, [$username, $password]);
    }

}
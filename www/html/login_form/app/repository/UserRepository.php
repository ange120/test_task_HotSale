<?php

namespace App\repository;
use App\models\User;

class UserRepository extends Repository
{
    /**
     * @param string $email
     * @return false|User
     */
    public function findUserByEmail(string $email)
    {
        $result = array_search($email, array_column($this->database, 'email'));

        if (!$result) {
            return false;
        }

        $userInfo = $this->database[$result];

        return new User (
            (int)$userInfo['id'],
            $userInfo['first_name'],
            $userInfo['last_name'],
            $userInfo['email'],
            $userInfo['password'],
        );

    }

    /**
     * @param array $data
     * @return false|User
     */
    public function createUser(array $data)
    {
        $lastUser = end($this->database);
        $id = $lastUser['id'] + 1;
        $data['password'] = md5($data['retry_password']);

        $save = [
            "$id",
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['password'],
        ];

        if ($this->saveInfoDB($save) === false) {
            return false;
        }
        return new User (
            $id,
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['password'],
        );
    }

    /**
     * @return array|null
     */
    public function getAllUsersList()
    {
        return $this->database;
    }

}

<?php

namespace App\controllers;
use App\repository\UserRepository;


class BaseInfoController extends AppController
{
    /**
     * Check login user
     */
    private function checkLogin()
    {
        if (!$_SESSION) {
            $this->log->logController($this->getRequest(),__METHOD__, 'Attempt by a user who is not logged in');
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/");
        }
    }

    /**
     * Page info after login
     */
    public function afterLogin()
    {
        $this->checkLogin();

        $userRepository = new UserRepository();

        $this->log->logController($this->getRequest(),__METHOD__, 'Get page afterLogin');

        return $this->render('afterLogin', ['usersList' => $userRepository->getAllUsersList()]);
    }


}
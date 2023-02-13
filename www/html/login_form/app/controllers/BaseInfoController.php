<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/UserRepository.php';

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
            header("Location: {$url}/info");
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
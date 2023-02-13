<?php
session_start();

require_once 'AppController.php';
require_once __DIR__ . '/../repository/ErrorCodes.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class SecurityController extends AppController
{

    /**
     * Function to log in user
     */
    public function loginUser()
    {
        $data = $this->PostDataJson();

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return $this->returnInfo( ErrorCodes::EMAIL_NOT_VALIDATION) ;
        }
        $this->log->logController($this->getRequest(),__METHOD__, 'New log_in: '.$data['email']);

        $userRepository = new UserRepository();

        $user = $userRepository->findUserByEmail($data['email']);

        if(!$user){
            $this->log->logController($this->getRequest(),__METHOD__, ErrorCodes::EMAIL_NOT_EXIST['messages']);
            return $this->returnInfo( ErrorCodes::EMAIL_NOT_EXIST) ;
        }

        if ($user->getPassword() !== md5($data['password'])) {
            $this->log->logController($this->getRequest(),__METHOD__, ErrorCodes::WRONG_PASSWORD['messages']);
            return $this->returnInfo( ErrorCodes::WRONG_PASSWORD) ;
        }

        $_SESSION['user'] = $user->getId();

        $this->log->logController($this->getRequest(),__METHOD__, 'User login '.$user->getId());

        $this->returnInfo(['status'=> 200, 'locationPage' => 'afterLogin']);
    }

    /**
     * Function to registration user
     */
    public function registrationUser ()
    {
        $data =  $this->PostDataJson();


        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return $this->returnInfo( ErrorCodes::EMAIL_NOT_VALIDATION);
        }
        $this->log->logController($this->getRequest(),__METHOD__, 'New registration: '.$data['email']);

        $userRepository = new UserRepository();

        if($userRepository->findUserByEmail($data['email']) !== false){
            $this->log->logController($this->getRequest(),__METHOD__, ErrorCodes::USER_EMAIL_SYSTEM['messages']);
            return $this->returnInfo( ErrorCodes::USER_EMAIL_SYSTEM);
        }

        if($data['password'] !== $data['retry_password']){
            $this->log->logController($this->getRequest(),__METHOD__, ErrorCodes::PASSWORDS_NOT_MATCH['messages']);
            return $this->returnInfo( ErrorCodes::PASSWORDS_NOT_MATCH);
        }

        $user = $userRepository->createUser($data);

        if($user === false){
            $this->log->logController($this->getRequest(),__METHOD__, ErrorCodes::ERROR_SAVE_USER['messages']);
            return $this->returnInfo( ErrorCodes::ERROR_SAVE_USER);
        }

        $this->log->logController($this->getRequest(),__METHOD__, 'Save user: '. $user->getId());

        $_SESSION['user'] = $user->getId();

        $this->returnInfo(['status'=> 200]);
    }

    /**
     * Function to log out user
     */
    public function logOut ()
    {
        session_destroy();
        $this->locateReturn();
    }

    /**
     * User redirection function
     */
    private function locateReturn (string $page = null)
    {
        $url = "http://$_SERVER[HTTP_HOST]";

        if(is_null($page)){
            header("Location: {$url}/");
            exit;
        }
        header("Location: {$url}/{$page}");
        exit;
    }


}

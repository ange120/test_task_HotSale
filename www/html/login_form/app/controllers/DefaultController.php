<?php
namespace App\controllers;


class DefaultController extends AppController {

    /**
     * Page index
     */
    public function index()
    {
        $this->render('info');
    }

    /**
     * Page info
     */
    public function info()
    {
        $this->log->logController($this->getRequest(),__METHOD__, 'Get page info');
        $this->render('info');
    }

    /**
     * Page login
     */
    public function login()
    {
        $this->log->logController($this->getRequest(),__METHOD__, 'Get page login');
        $this->render('login');
    }

    /**
     * Page registration
     */
    public function registration()
    {
        $this->log->logController($this->getRequest(),__METHOD__, 'Get page register');
        $this->render('registration');
    }

    /**
     * Page 404
     */
    public function errorPage()
    {
        $this->log->logController($this->getRequest(),__METHOD__, 'return page 404');
        $this->render('404');
    }

}
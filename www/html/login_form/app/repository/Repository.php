<?php

require_once __DIR__.'../../Config/Database.php';
require_once __DIR__ . '/../service/LogService.php';

class Repository {

    protected $database;
    protected $log;

    /**
     * Get all list users in file db
     */
    public function __construct()
    {
        $this->database = Database::csvToArray(Database::DB_USERS);
        $this->log = new LogService();
    }

    /**
     * @param array $data
     * @return bool
     */
    protected function saveInfoDB(array $data) : bool
    {
       return Database::saveDB(Database::DB_USERS, $data);
    }

}
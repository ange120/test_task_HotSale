<?php
require_once __DIR__.'/../Config/configFile.php';

class LogService
{

    /**
     * @param string $request
     * @param string $method
     * @param string $message
     */
    public static function logController (string $request, string $method, string $message)
    {
        date_default_timezone_set('Europe/Kyiv');

        $infoMessage = date('Y-m-d H:i:s').'; Request:'. $request. '; '.'Method: '.$method.'; Message: '.$message.'.';

        if(!is_dir(LOG_URL)) {
            mkdir(LOG_URL, 0777, true);
        }

        file_put_contents(LOG_URL.'LogFile-'.date('Y-m-d').".log", $infoMessage.PHP_EOL, FILE_APPEND);
    }

    /**
     * @param string $method
     * @param string $message
     */
    public static function logInfo (string $method, string $message)
    {
        date_default_timezone_set('Europe/Kyiv');

        $infoMessage = date('Y-m-d H:i:s').'; '.'Method: '.$method.'; Message: '.$message.'.';

        if(!is_dir(LOG_URL)) {
            mkdir(LOG_URL, 0777, true);
        }

        file_put_contents(LOG_URL.'LogFile-'.date('Y-m-d').".log", $infoMessage.PHP_EOL, FILE_APPEND);
    }

}
<?php
require_once __DIR__ . '/../service/LogService.php';

class Database
{

    const DB_USERS = URL_DB_USERS;

    /**
     * Get users list
     * @param string $file_url
     * @return array
     */
    public static function csvToArray(string $file_url)
    {

        $log = new LogService();

        $csv = [];
        $rowcount = 0;
        if (($handle = fopen($file_url, "r")) !== FALSE) {
            $max_line_length = defined('MAX_LINE_LENGTH') ? MAX_LINE_LENGTH : 10000;
            $header = fgetcsv($handle, $max_line_length);
            $header_colcount = count($header);
            while (($row = fgetcsv($handle, $max_line_length)) !== FALSE) {
                $row_colcount = count($row);
                if ($row_colcount == $header_colcount) {
                    $entry = array_combine($header, $row);
                    $csv[] = $entry;
                } else {
                    $log->logInfo(__METHOD__, "csv_reader: Invalid number of columns at line " . ($rowcount + 2) . " (row " . ($rowcount + 1) . "). Expected=$header_colcount Got=$row_colcount");
                    return null;
                }
                $rowcount++;
            }
            fclose($handle);
        } else {
            $log->logInfo(__METHOD__, "csv_reader: Could not read CSV \"$file_url\"");
            return null;
        }
        return $csv;
    }

    /**
     * Save new user in file
     * @param string $file_url
     * @param array $insertData
     * @return bool
     */
    public static function saveDB(string $file_url, array $insertData) : bool
    {
        try {
            $rows = [];

            $handle = fopen($file_url, "r");
            while (($row = fgetcsv($handle)) !== false) {
                $rows[] = $row;
            }
            fclose($handle);

            array_push($rows, $insertData);

            $fp = fopen($file_url, 'w');

            foreach ($rows as $item) {
                fputcsv($fp, $item);
            }

            fclose($fp);
            return true;

        } catch (Throwable $throwable) {
            LogService::logInfo(__METHOD__, $throwable->getMessage() . " \"$file_url\"");
            return false;
        }

    }


}
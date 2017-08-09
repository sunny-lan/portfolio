<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-04-26
 * Time: 6:24 PM
 * Random utilities
 **/

require_once "paths.php";
require_once "consts.php";

class Util
{
    public static function db_connect()
    {
        // Load configuration as an array. Use the actual location of your configuration file
        $config = parse_ini_file(API_PATH . '/backend/config.ini');
        $connection = new \mysqli('localhost', $config['username'], $config['password'], $config['dbname']);
        // If connection was not successful, handle  the error
        if (isset($connection->connect_error)) {
            // Handle error - notify administrator, log to a file, show an error screen, etc
//            error_log("Failed to connect to database", 0);
            throw new \Exception("Failed to connect to database", Constants::ERR_DB);
        }
        return $connection;
    }

    public static function getUUID(\mysqli $db)
    {
        $result = $db->query("SELECT UUID()");
        if (!$result)
            throw new \Exception("Database query failed", Constants::ERR_DB);
        return $result->fetch_assoc()["UUID()"];
    }

    public static function getLastID(mysqli $db)
    {
        return Util::queryW($db, "SELECT LAST_INSERT_ID()")->fetch_assoc()["LAST_INSERT_ID()"];
    }

    public static function toArray(\mysqli_result $result, $fetch = null)
    {
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            if (isset($fetch) && isset($row[$fetch]))
                $rows[] = $row[$fetch];
            else
                $rows[] = $row;
        }
        return $rows;
    }

    public static function queryW(mysqli $db, $query)
    {
        $result = $db->query($query);
        if (!$result)
            throw new \Exception("Database query failed", Constants::ERR_DB);
        return $result;
    }
}
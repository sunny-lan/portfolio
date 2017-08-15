<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-08-15
 * Time: 4:54 PM
 */

require_once "paths.php";

class AdminSession
{
    public static function checkSession()
    {
        if (!isset($_SESSION))
            session_start();
        return array_key_exists("admin", $_SESSION);
    }

    public static function login($pass)
    {
        $filename = API_PATH . '/backend/admin_pass_hash';
        if (file_exists($filename)) {
            $file = fopen($filename, "r");
            $pass_hash_correct = fread($file, filesize($filename));
            fclose($file);
            error_log(password_hash($pass, PASSWORD_DEFAULT) . " vs " . $pass_hash_correct);
            if (!password_verify($pass, $pass_hash_correct)) {
                return false;
            }
        }
//        session_save_path('/home/sunnylan/sessions');
        if (!isset($_SESSION))
            session_start();
        $_SESSION["admin"] = true;
        return true;
    }

    public static function changePass($pass)
    {
        if (!self::checkSession())
            return false;

        $filename = API_PATH . '/backend/admin_pass_hash';
        $file = fopen($filename, "w");
        fwrite($file, password_hash($pass, PASSWORD_DEFAULT));
        fclose($file);

        return true;
    }

    public static function logout()
    {
        unset($_SESSION["admin"]);
        session_destroy();
    }
}
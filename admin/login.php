<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-08-15
 * Time: 5:12 PM
 */

require_once '../backend/admin.php';

if (!AdminSession::checkSession()) {
    if (!AdminSession::login($_POST["password"])) {
        header("Location: /admin/login.html");
        exit();
    }
}

header('Location: /admin');
<?php
require_once "include.php";
require_once "admin.php";

if(!AdminSession::checkSession()){
    header("Location: /admin/login.html");
    exit();
}
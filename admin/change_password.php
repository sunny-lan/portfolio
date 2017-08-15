<?php
include "../backend/admin_include.php";
if (AdminSession::changePass($_POST["password"])) {
    header("Location: /admin");
    exit();
} else
    echo "Error";
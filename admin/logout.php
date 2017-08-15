<?php
include "../backend/admin_include.php";
AdminSession::logout();
header("Location: /admin/login.html");
exit();
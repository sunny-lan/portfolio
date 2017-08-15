<?php require_once 'backend/include.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sunny Lan</title>
    <link rel="stylesheet" type="text/css" href="/css/index.css">
    <script
            src="http://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
    <script src="/js/index.js"></script>

    <?php
    echo "<script type = 'application/json' id = 'injected-schema'>";
    echo json_encode([
        "articles" => $articleMgr->getSchema()
    ]);
    echo "</script>";
    ?>
</head>

<body>

<div id="info-blocks">
</div>

<div id="bg" class="sidebar">
    <div class="background"></div>
</div>
<div id="nav-bar-wrapper" class="sidebar">
    <div id="nav-bar">
    </div>
</div>

</body>
</html>
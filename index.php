<?php require_once 'backend/include.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sunny Lan</title>
    <link rel="stylesheet" type="text/css" href="/css/index.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">

    <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>

    <script
            src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
            integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
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
    <div class="background parallax"></div>
</div>
<div id="nav-bar-wrapper" class="sidebar">
    <div id="nav-bar">
    </div>
</div>

<div class="down-arrow">
    <!--<span class="text">Scroll down</span>-->
    <div class="material-icons arrow">expand_more</div>
</div>

</body>
</html>
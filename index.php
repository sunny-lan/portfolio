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
    <div id="about-me" class="info-block">
        <div class="background"></div>
        <div class="content top">
            <h1 class="about-header">About me</h1>
            <p class="about-text">
                Man request adapted spirits set pressed. Up to denoting subjects sensible feelings it indulged
                directly. We dwelling elegance do shutters appetite yourself diverted. Our next drew much you with rank.
                Tore many held age old rose than our. She literature sentiments any contrasted. Set aware joy sense
                young now years china shy.
                I am a custy boi.
            </p>
            <a class="github-link">
                <img class="github-icon" src="img/GitHub-Mark.png">
                <span class="github-text">github.com/sunny-lan</span>
            </a>
        </div>
    </div>
</div>

<div class="sidebar background">
    <div class="background"></div>
</div>
<div id="nav-bar-wrapper" class="sidebar">
    <div id="nav-bar">
        <div id="name-block" class="nav-item">
            <span class="greeting-text">Hello,</span>
            <span class="name-text"><span class="prompt">></span> I'm Sunny Lan</span>
        </div>
    </div>
</div>

</body>
</html>
<?php
require_once "../backend/article_mgr.php";
require_once "../backend/util.php";
$articleMgr = new ArticlesMgr(Util::db_connect());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<ul>
    <?php
    $articleIDs = $articleMgr->getArticleIDs();
    foreach ($articleIDs as $id) {

    }
    ?>
</ul>
</body>
</html>
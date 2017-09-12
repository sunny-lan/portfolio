<?php
require_once '../backend/admin_include.php';

header('Location: /admin');

if (key_exists("delete", $_GET))
    if ($_GET["delete"] == 1) {
        $article = $articleMgr->getArticle($_GET["articleID"]);
        $articleMgr->deleteArticle($article);
        return;
    }

if (key_exists("create", $_POST))
    if ($_POST["create"] == 1)
        $_POST["articleID"] = $articleMgr->createArticle();

$article = $articleMgr->getArticle($_POST["articleID"]);
$article->modify($_POST["content"], $_POST["preview"], $_POST["defaultDisplayOrder"], $_POST["navLabel"]);

exit();
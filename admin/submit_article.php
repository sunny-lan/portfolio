<?php require_once '../backend/include.php';
header('Location: /admin');
try {
    if ($_GET["delete"] == 1) {
        $article = $articleMgr->getArticle($_GET["articleID"]);
        $articleMgr->deleteArticle($article);
        return;
    }

    if ($_POST["create"] == 1)
        $_POST["articleID"] = $articleMgr->createArticle();

    $article = $articleMgr->getArticle($_POST["articleID"]);
    $article->modify($_POST["content"], $_POST["preview"], $_POST["defaultDisplayOrder"], $_POST["navLabel"]);
} catch (Exception $ex) {
    echo "Error: $ex";
}
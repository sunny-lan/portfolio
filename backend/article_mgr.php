<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-08-10
 * Time: 10:54 AM
 */

require_once "util.php";
require_once "article.php";

class ArticlesMgr
{
    function __construct(\mysqli $db)
    {
        $this->db = $db;
    }

    function getSchema()
    {
        $articlesIDs = $this->getArticleIDs();
        $res = [];
        foreach ($articlesIDs as $id) {
            $article = new Article($this->db, $id);
            $res[$article->id] = $article->getSchema();
        }
        return $res;
    }

    function getArticleIDs()
    {
        return Util::toArray(Util::queryW($this->db, "SELECT id FROM articles"), "id");
    }

    function createArticle()
    {
        Util::queryW($this->db, "INSERT INTO articles VALUES ()");
        return Util::getLastID($this->db);
    }

    function getArticle($id)
    {
        return new Article($this->db, $id);
    }

    function deleteArticle(Article $article)
    {
        Util::queryW($this->db, " DELETE FROM articles WHERE id='$article->id'");
    }
}
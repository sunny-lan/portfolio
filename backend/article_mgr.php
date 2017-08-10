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

    function createArticle($content, $preview, $defaultDisplayOrder)
    {
        Util::queryW($this->db, "INSERT INTO articles VALUES ()");
        $id = Util::getLastID($this->db);
        $article = new Article($this->db, $id);
        $article->modify($content, $preview, $defaultDisplayOrder);
        return $article;
    }

    function getArticle($id)
    {
        return new Article($this->db, $id);
    }
}
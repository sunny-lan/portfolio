<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-08-10
 * Time: 11:30 AM
 */
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

require_once "$root/backend/article_mgr.php";
require_once "$root/backend/util.php";
$db = Util::db_connect();
$articleMgr = new ArticlesMgr($db);
$articleIDs = $articleMgr->getArticleIDs();
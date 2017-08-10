<?php
/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-08-02
 * Time: 6:08 PM
 */

require_once "util.php";

class Article
{
    function __construct(mysqli $db, $id)
    {
        $this->db = $db;
        $this->id = $id;
    }

    function getNavLabel()
    {
        return Util::queryW($this->db, "SELECT nav_label FROM articles WHERE id='$this->id'")["nav_label"];
    }

    function getContent()
    {
        $filePath = Util::queryW($this->db, "SELECT content_file_path FROM articles WHERE id='$this->id'")->fetch_assoc()["content_file_path"];
        $file = fopen($filePath, "r");
        $str = fread($file, filesize($filePath));
        fclose($file);
        return $str;
    }

    function getPreview()
    {
        $filePath = Util::queryW($this->db, "SELECT preview_file_path FROM articles WHERE id='$this->id'")->fetch_assoc()["preview_file_path"];
        $file = fopen($filePath, "r");
        $str = fread($file, filesize($filePath));
        fclose($file);
        return $str;
    }

    function modify($content, $preview, $defaultDisplayOrder)
    {
        $id = $this->id;
        $file = fopen("$id-content.html", "w");
        fwrite($file, $content);
        fclose($file);
        $file = fopen("$id-preview.html", "w");
        fwrite($file, $preview);
        fclose($file);
        Util::queryW($this->db, "UPDATE articles SET content_file_path='$id-content.html' preview_file_path='$id-preview.html' default_display_order='$defaultDisplayOrder' WHERE id='$id'");
    }

    function getSchema()
    {
        return [
            "preview" => $this->getPreview(),
            "navLabel" => $this->getNavLabel(),
        ];
    }
}
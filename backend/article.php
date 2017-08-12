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
        return Util::queryW($this->db, "SELECT nav_label FROM articles WHERE id='$this->id'")->fetch_assoc()["nav_label"];
    }

    function getContent()
    {
        return Util::queryW($this->db, "SELECT content FROM articles WHERE id='$this->id'")->fetch_assoc()["content"];
    }

    function getPreview()
    {
        return Util::queryW($this->db, "SELECT preview FROM articles WHERE id='$this->id'")->fetch_assoc()["preview"];
    }

    function getDefaultDisplayOrder()
    {
        return Util::queryW($this->db, "SELECT default_display_order FROM articles WHERE id='$this->id'")->fetch_assoc()["default_display_order"];
    }

    function modify($content, $preview, $defaultDisplayOrder, $navLabel)
    {
        $content=$this->db->escape_string($content);
        $preview=$this->db->escape_string($preview);
        $navLabel=$this->db->escape_string($navLabel);
        Util::queryW($this->db, "UPDATE articles SET content='$content', preview='$preview', default_display_order='$defaultDisplayOrder', nav_label='$navLabel' WHERE id='$this->id'");
    }

    function getSchema()
    {
        return [
            "preview" => $this->getPreview(),
            "navLabel" => $this->getNavLabel(),
            "defaultDisplayOrder" => $this->getDefaultDisplayOrder(),
        ];
    }
}
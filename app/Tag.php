<?php

class Tag {

  private $tagId, $tag;

  function __construct($tagId, $tag) {
    $this->tagId = $tagId;
    $this->tag = $tag;
  }


  function getTagId() {
    return $this->tagId;
  }


  function getTag() {
    return $this->tag;
  }


  static function getTagById() {
    $db = new Database(HOST, DATABASE, USER, PASSWORD);
  }


  static function getTagsByQuoteId($quoteId) {
    $db = new Database(HOST, DATABASE, USER, PASSWORD);
    $sql = "SELECT QuoteTag.TagId, Tag.Tag " .
            "FROM QuoteTag " .
            "INNER JOIN Tag " .
            "ON QuoteTag.TagId = Tag.TagId " .
            "WHERE QuoteTag.QuoteId = :id";
    $results = $db->select($sql, array(":id" => $quoteId));
    $tags = array();
    foreach ($results as $result) {
      $tags[] = new Tag($result["TagId"], $result["Tag"]);
    }
    return $tags;
  }


  static function getAllTags() {
    $db = new Database(HOST, DATABASE, USER, PASSWORD);
  }


  static function addTag($tag) {
    $db = new Database(HOST, DATABASE, USER, PASSWORD);
  }


}

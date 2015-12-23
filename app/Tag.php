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


  static function getTagByName($name) {
    $db = new Database(HOST, DATABASE, USER, PASSWORD);
    $result = $db->select("SELECT * FROM Tag WHERE `Tag` = :name", array(":name" => $name));    
    if (!empty($result)) {
      return new Tag($result[0]["TagId"], $result[0]["Tag"]);
    }
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


  static function addTag($tag) {
    $db = new Database(HOST, DATABASE, USER, PASSWORD);
    $tagId = $db->insert('Tag', array("Tag" => $tag));
    return new Tag($tagId, $tag);
  }


  static function parseTags($tagsInString) {
    $tags = explode("#", $tagsInString);
    unset($tags[0]);
    $listOfTagObjects = array();

    foreach ($tags as $tag) {
      $tag = ucfirst($tag);
      $tagObj = self::getTagByName($tag);
      if (!empty($tagObj)) {        
        $listOfTagObjects[] = $tagObj;
      } else {        
        $listOfTagObjects[] = self::addTag($tag);
      }
    }
    return $listOfTagObjects;
  }


}

<?php

class Quote {

  private $quoteId, $quote, $tags, $person;

  function __construct($quoteId, $quote, $tags, $person) {
    $this->quoteId = $quoteId;
    $this->quote = $quote;
    $this->tags = $tags;
    $this->person = $person;
  }


  function getQuoteId() {
    return $this->quoteId;
  }


  function getQuote() {
    return $this->quote;
  }


  function getTags() {
    return $this->tags;
  }


  function getPerson() {
    return $this->person;
  }


  Static function getAllQuotes() {
    $db = new Database(HOST, DATABASE, USER, PASSWORD);
    $results = $db->select("SELECT QuoteId FROM Quote");
    $quotes = array();
    foreach ($results as $result) {
      $quotes[] = self::getQuoteById($result["QuoteId"]);
    }
    return $quotes;
  }


  Static function getQuoteById($id) {
    $db = new Database(HOST, DATABASE, USER, PASSWORD);
    $result = $db->select("SELECT * FROM Quote WHERE QuoteId = :id",
            array(":id" => $id));
    $result = $result[0];
    $quoteId = $result['QuoteId'];
    $quote = $result['Quote'];
    $person = Person::getPersonById($result['PersonId']);
    $tags = Tag::getTagsByQuoteId($id);
    return new Quote($quoteId, $quote, $tags, $person);
  }


  Static function getQuotesearchQuery($searchQuery) {
    $db = new Database(HOST, DATABASE, USER, PASSWORD);
    $searchQuery = "hahah #Apple #Slim #bleh";
    $data = self::parseQuery($searchQuery);
    


    echo "<pre>";
    print_r($data);    
    die();
  }


  private static function parseQuery($searchQuery) {
    $parts = preg_split("/(#[a-z0-9][a-z0-9\\-_]*)/i", 
            $searchQuery, -1, PREG_SPLIT_DELIM_CAPTURE);
    $tags = array();
    foreach ($parts as $id => $part) {
      if (strpos($part, "#") === 0) {
        $tag = Tag::getTagByName(substr($part, 1));
        if (isset($tag)) {
          $tags[] = $tag;
        }
        unset($parts[$id]);
      } else if (strpos($part, " ") === 0) {
        $parts[$id] = substr($parts[$id], 1); //  removes whitespaces 
      }
    }
    $data['tags'] = $tags;
    $data['parts'] = array_filter($parts);
    return $data;
  }


  static function addQuote($quote, $tags, $person) {
    $db = new Database(HOST, DATABASE, USER, PASSWORD);
    $quoteId = $db->insert("Quote", array("Quote" => $quote, 
        "PersonId" => $person->getPersonId()));
    foreach ($tags as $tag) {
      $db->insert("QuoteTag", array("QuoteId" => $quoteId, 
          "TagId" => $tag->getTagId()));
    }
  }


  static function removeQuote($quoteId) {
    $db = new Database(HOST, DATABASE, USER, PASSWORD);
    $db->delete("QuoteTag", "QuoteId = $quoteId", 9999);
    $db->delete("Quote", "QuoteId = $quoteId", 99999);
  }


}

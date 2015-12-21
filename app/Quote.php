<?php

class Quote {

  private $quoteId, $quote, $year, $tags, $person;

  function __construct($quoteId, $quote, $year, $tags, $person) {
    $this->quoteId = $quoteId;
    $this->quote = $quote;
    $this->year = $year;
    $this->tags = $tags;
    $this->person = $person;
  }


  function getQuoteId() {
    return $this->quoteId;
  }


  function getQuote() {
    return $this->quote;
  }


  function getYear() {
    return $this->year;
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
    $result = $db->select("SELECT * FROM Quote WHERE QuoteId = :id", array(":id" => $id));
    $result = $result[0];
    $quoteId = $result['QuoteId'];
    $quote = $result['Quote'];
    $year = $result['Year'];
    $person = Person::getPersonById($result['PersonId']);
    $tags = Tag::getTagsByQuoteId($id);
    return new Quote($quoteId, $quote, $year, $tags, $person);
  }


  static function getQuotesByPerson($person) {
    $db = new Database(HOST, DATABASE, USER, PASSWORD);
  }


  static function getQuotesByTags($tags) {
    $db = new Database(HOST, DATABASE, USER, PASSWORD);
  }


  Static function getQuotesearchQuery($searchQuery) {
    $db = new Database(HOST, DATABASE, USER, PASSWORD);
  }


  static function addQuote($quote) {
    
  }


  static function removeQuote($quote) {
    
  }


}

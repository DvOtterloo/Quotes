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
    $result = $db->select("SELECT * FROM Quote WHERE QuoteId = :id", array(":id" => $id));
    $result = $result[0];
    $quoteId = $result['QuoteId'];
    $quote = $result['Quote'];
    $person = Person::getPersonById($result['PersonId']);
    $tags = Tag::getTagsByQuoteId($id);
    return new Quote($quoteId, $quote, $tags, $person);
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


  static function addQuote($quote, $tags, $person) {
    $db = new Database(HOST, DATABASE, USER, PASSWORD);
    $quoteId = $db->insert("Quote", array("Quote" => $quote, "PersonId" => $person->getPersonId()));
    foreach ($tags as $tag) {
      $db->insert("QuoteTag", array("QuoteId" => $quoteId, "TagId" => $tag->getTagId()));
    }
  }


  static function removeQuote($quoteId) {    
    $db = new Database(HOST, DATABASE, USER, PASSWORD);
    $db->delete("QuoteTag", "QuoteId = $quoteId", 9999);
    $db->delete("Quote", "QuoteId = $quoteId", 99999);
  }

}

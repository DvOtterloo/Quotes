<?php

class App {

  function __construct() {
    $methodToCall = $this->route();
    $this->$methodToCall();
  }


  private function route() {
    if (!isset($this, $_GET['page'])) {
      header("Location: " . (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?page=index");
    }
    return (method_exists($this, $_GET['page'])) ? $_GET['page'] : "pageNotFound";
  }


  private function pageNotFound() {
    $data = array();
    $data["seo"]["title"] = "Quotes!";
    $data["seo"]["description"] = "Met behulp van deze website kun je al jouw quotes beheren!";
    $view = new View();
    $view->render("pageNotFound", $data);
  }


  private function index() {
    $data = array();
    $data["quotes"] = Quote::getAllQuotes();
    $data["seo"]["title"] = "Quotes!";
    $data["seo"]["description"] = "Met behulp van deze website kun je al jouw quotes beheren!";
    $view = new View();
    $view->render("index", $data);
  }


  private function getAllPersons() {
    $persons = Person::getPersonsLike($_POST['search']);
    $html = "<ul class='suggestion-list'>";
    foreach ($persons as $person) {
      $html = $html . "<li>" . $person->getName() . "</li>";
    }
    $html = $html . "</ul>";
    echo $html;
  }


  private function addQuote() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $quote = $_POST['quote'];
      $tags = Tag::parseTags($_POST['tags']);
      if ($_POST['person'] == '') {
        $name = 'Anonymous';
      } else {
        $name = $_POST['person'];
      }
      $person = Person::getByName($name);

      Quote::addQuote($quote, $tags, $person);
    }
    header("Location: " . URL);
  }


  private function search() {

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['search'])) {
      $data = array();
      $data['searchQuery'] = $_POST['search'];
      $data["quotes"] = Quote::getQuotesearchQuery($_POST['search']);      
      $data["seo"]["title"] = "Quotes!";
      $data["seo"]["description"] = "Met behulp van deze website kun je al jouw quotes beheren!";
      $view = new View();
      $view->render("index", $data);
    }
  }


  private function removeQuote() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['quoteId'])) {
      Quote::removeQuote($_POST['quoteId']);
    }
    header("Location: " . URL);
  }


}

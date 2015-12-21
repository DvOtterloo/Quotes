<?php

class Person {

  private $personId, $name;

  function __construct($personId, $name) {
    $this->personId = $personId;
    $this->name = $name;
  }


  function getPersonId() {
    return $this->personId;
  }


  function getName() {
    return $this->name;
  }


  static function getPersonById($id) {
    $db = new Database(HOST, DATABASE, USER, PASSWORD);
    $result = $db->select("SELECT * FROM Person WHERE PersonId = :id", array(":id" => $id));
    return new Person($result[0]["PersonId"], $result[0]["Name"]);
  }


  static function getAllPersons() {
    $db = new Database(HOST, DATABASE, USER, PASSWORD);
    $results = $db->select("SELECT * FROM Person");
    $persons = array();
    foreach ($results as $result) {
      $persons[] = new Person($result['PersonId'], $result['Name']);
    }
    return $persons;
  }


  static function getPersonsLike($queryString) {
    $db = new Database(HOST, DATABASE, USER, PASSWORD);
    $results = $db->select("SELECT * FROM Person WHERE `Name` LIKE '$queryString%' LIMIT 10");
    $persons = array();
    foreach ($results as $result) {
      $persons[] = new Person($result['PersonId'], $result['Name']);
    }
    return $persons;
  }


  static function addPerson($name) {
    $db = new Database(HOST, DATABASE, USER, PASSWORD);
    $personId = $db->insert("Person", array("Name" => $name));
    return new Person($personId, $name);
  }


  static function getByName($name) {
    $db = new Database(HOST, DATABASE, USER, PASSWORD);
    $result = $db->select("SELECT * FROM Person WHERE Name = :name", array(":name" => $name));
    if (empty($result)) {
      $person = Person::addPerson($name);
    } else {
      $person = new Person($result[0]['PersonId'], $result[0]['Name']);
    }    
    return $person;
  }


}

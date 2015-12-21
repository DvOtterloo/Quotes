<?php

class Database extends PDO {

  public function __construct($host, $databaseName, $user, $password) {
    parent::__construct('mysql:host=' . $host . ';dbname=' . $databaseName, $user, $password);
  }


  /**
   * Select
   * @param string $sql The Select statement
   * @param array $array The paramenters to bind
   * @param string $fetchMode The mode to fetch
   * @return mixed
   */
  public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC) {
    $sth = $this->prepare($sql);
    foreach ($array as $key => $value) {
      $sth->bindValue("$key", $value);
    }
    $sth->execute();
    $return = $sth->fetchAll($fetchMode);

    return $return;
  }


  /**
   * Insert data in the database
   * @param string $table The name of the table
   * @param string $data An assosiative array of data 
   */
  public function insert($table, $data) {

    $fieldNames = implode('`,`', array_keys($data));
    $fieldValues = ':' . implode(', :', array_keys($data));

    $sth = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");

    foreach ($data as $key => $value) {
      $sth->bindValue(":$key", $value);
    }

    $sth->execute();
  }


  /**
   * Update data in the database
   * @param string $table The name of the database table
   * @param string $data An assosiative array of data 
   * @param string $where The WHERE query part
   */
  public function update($table, $data, $where) {
    $fieldDetails = NULL;
    foreach ($data as $key => $value) {
      $fieldDetails .= "`$key` = :$key,";
    }
    $fieldDetails = rtrim($fieldDetails, ',');
    $sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");

    foreach ($data as $key => $value) {
      $sth->bindValue(":$key", $value);
    }
    $sth->execute();
  }


  /**
   * Delete
   * @param string $table the table name
   * @param string $where the where part of query
   * @param int $limit number of rows to delete
   * @return int Rows effected
   */
  public function delete($table, $where, $limit = 1) {
    return $this->exec("DELETE FROM $table WHERE $where LIMIT $limit");
  }

}

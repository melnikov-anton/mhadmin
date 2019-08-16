<?php

class Db {
  private static $_instances = array();
  private $_pdo, $query, $_result, $_count = 0, $_error = false, $_lastInsertID = null, $_instHash;

  private function __construct($dbName = DB_NAME, $dbUser = DB_USER, $dbPass = DB_PASSWORD) {

    try {
      $this->_pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . $dbName, $dbUser, $dbPass);
    } catch(PDOException $e) {
      die($e->getMessage());
    }
    $this->$_instHash = md5($dbName . $dbUser);
    self::$_instances[] = $this;
  }

  public static function getInstance($dbName = DB_NAME, $dbUser = DB_USER, $dbPass = DB_PASSWORD) {
    if(empty(self::$_instances)) {
      $newInst = new Db($dbName, $dbUser, $dbPass);

    } else {
      foreach (self::$_instances as $key => $inst) {
        if($inst->$_instHash === md5($dbName . $dbUser)) {
          return self::$_instances[$key];
        }
      }
      $newInst = new Db($dbName, $dbUser, $dbPass);
    }
    return $newInst;
  }


}

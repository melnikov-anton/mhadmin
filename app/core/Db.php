<?php

class Db {
  private static $_instances = array();
  private $_pdo, $_query, $_result, $_numb = 0, $_error = false, $_lastInsertID = null, $_instHash;

  private function __construct($dbName = DB_NAME, $dbUser = DB_USER, $dbPass = DB_PASSWORD) {

    try {
      $this->_pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . $dbName, $dbUser, $dbPass);
      $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
      die($e->getMessage());
    }
    $this->$_instHash = md5($dbName . $dbUser);
    self::$_instances[] = $this;
  }

//------------------------------------------------------------
  public static function getConnection($dbName = DB_NAME, $dbUser = DB_USER, $dbPass = DB_PASSWORD) {
    if(empty(self::$_instances)) {
      $newInst = new self($dbName, $dbUser, $dbPass);

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

//-----------------------------------------------------------
  public function sqlQuery ($sql, $params = []) {
    $this->_error = false;
    try {
      $stat = $this->_pdo->prepare($sql);
      if(!is_array($params)) {
        $stat->bindValue(1, $params);
      } else {
        if(count($params)) {
          $x = 1;
          foreach ($params as $key => $val) {
            $stat->bindValue($x, $val);
            $x++;
          }
        }
      }

      if($stat->execute()) {
        if(preg_match("/select/i", $sql)) {
          //$this->_result = $stat->setFetchMode(PDO::FETCH_ASSOC);
          $this->_result = $stat->fetchAll(PDO::FETCH_ASSOC);
          $this->_numb = $stat->rowCount();
          $this->_lastInsertID = $this->_pdo->lastInsertId();
        } else {return true;}
      } else {
        $this->_error = true;
      }

    } catch(PDOException $e) {
      die($e->getMessage());
    }
    return $this->_result;
  }

//-------------------------------------------------------------
  public function checkUser ($uname, $passw) {
    if(!isset($uname)) {return false;}
      $sql = "SELECT * FROM users WHERE username= ?";
      $res = $this->sqlQuery($sql, $uname);
    /*  $stat = $this->_pdo->prepare($sql);
      $stat->bindValue(':uname', $uname);
      $stat->execute();
      $this->_result = $stat->setFetchMode(PDO::FETCH_ASSOC);
      $this->_result = $stat->fetchAll();*/

    if($this->_numb == 1) {
      if(password_verify($passw, $res[0]['password'])) {
        return $res[0];
      } else return false;
    }
  }
//--------------------------------------------------------------

  public function saveUserInDb ($userData = []) {
    $fieldStr = '';
    $valStr = '';
    $values = [];
    foreach ($userData as $field => $val) {
      $fieldStr .= '`' . $field . '`,';
      $valStr .= '?,';
      $values[] = $val;
    }
    $fieldStr = rtrim($fieldStr, ',');
    $valStr = rtrim($valStr, ',');
    $sql = "INSERT IGNORE INTO users ({$fieldStr}) VALUES ({$valStr})";
    var_dump($sql);
    var_dump($values);
    return $this->sqlQuery($sql, $values);
  }

  public function saveSiteInDb ($siteData = []) {
    $fieldStr = '';
    $valStr = '';
    $values = [];
    foreach ($siteData as $field => $val) {
      $fieldStr .= '`' . $field . '`,';
      $valStr .= '?,';
      $values[] = $val;
    }
    $fieldStr = rtrim($fieldStr, ',');
    $valStr = rtrim($valStr, ',');
    $sql = "INSERT IGNORE INTO sites ({$fieldStr}) VALUES ({$valStr})";

    return $this->sqlQuery($sql, $values);
  }

}

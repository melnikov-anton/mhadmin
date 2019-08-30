<?php

class Db {
  //private static $_instances = array();
  private $_pdo, $_query, $_result, $_numb = 0, $_error = false, $_lastInsertID = null, $_instHash;

  private function __construct($dbName = DB_NAME, $dbUser = DB_USER, $dbPass = DB_PASSWORD) {

    try {
      $this->_pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . $dbName, $dbUser, $dbPass);
      $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {

      die($e->getMessage());
    }
    $this->_instHash = md5($dbName . $dbUser);
    //self::$_instances[] = $this;
  }

//------------------------------------------------------------
  public static function getConnection($dbName = DB_NAME, $dbUser = DB_USER, $dbPass = DB_PASSWORD) {
    if(empty(self::$_instances)) {
      $newInst = new self($dbName, $dbUser, $dbPass);

    } else {
      foreach (self::$_instances as $key => $inst) {
        if($inst->_instHash === md5($dbName . $dbUser)) {
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
    $this->_numb = 0;
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
        return false;
      }

    } catch(PDOException $e) {
      die($e->getMessage());
    }
    return $this->_result;
  }

//-------------------------------------------------------------
  public function checkUser ($uname, $passw) {
    if(!isset($uname)) {return false;}
      $sql = "SELECT username, password FROM users WHERE username= ?";
      $res = $this->sqlQuery($sql, $uname);
    /*  $stat = $this->_pdo->prepare($sql);
      $stat->bindValue(':uname', $uname);
      $stat->execute();
      $this->_result = $stat->setFetchMode(PDO::FETCH_ASSOC);
      $this->_result = $stat->fetchAll();*/

    if($this->_numb == 1) {
      if(password_verify($passw, $res[0]['password'])) {
        return true;
      } else return false;
    }
  }
//--------------------------------------------------------------

//--------------------------------------------------------------

  public function checkUniqueUsername ($uname) {
    if(!isset($uname)) {return false;}
      $sql = "SELECT * FROM users WHERE username= ?";
      $res = $this->sqlQuery($sql, $uname);
      if($this->_numb == 0) {
        return true;
      } else {
        return false;
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
    //var_dump($sql);
    //var_dump($values);
    if($this->sqlQuery($sql, $values)) {
      return true;
    } else {
      return false;
    }
  }
//-----------------------------------------------------------------

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

  public function getSitesList() {
      $sql = "SELECT * FROM sites ORDER BY id_user, id_site";
      $res = $this->sqlQuery($sql);
      if($this->_numb == 0) {
        return 0;
      } else {
        return $res;
      }
  }

  public function getSiteDataById($id) {
      $sql = "SELECT * FROM sites WHERE id_site= ?";
      $res = $this->sqlQuery($sql, $id);
      if($this->_numb == 0) {
        return false;
      } else {
        return $res[0];
      }
  }

  public function getSitesDataByUserId($id_user) {
      $sql = "SELECT * FROM sites WHERE id_user= ?";
      $res = $this->sqlQuery($sql, $id_user);
      if($this->_numb == 0) {
        return false;
      } else {
        return $res;
      }
  }

  public function getUsersList() {
      $sql = "SELECT id_user, fname, lname, username, email, rest, usertype FROM users";
      $res = $this->sqlQuery($sql);
      if($this->_numb == 0) {
        return 0;
      } else {
        return $res;
      }
  }

  public function getUserDataById($id) {
      $sql = "SELECT id_user, fname, lname, username, email, rest, usertype FROM users WHERE id_user= ?";
      $res = $this->sqlQuery($sql, $id);
      if($this->_numb == 0) {
        return false;
      } else {
        return $res[0];
      }
  }

}

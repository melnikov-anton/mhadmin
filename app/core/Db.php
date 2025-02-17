<?php

class Db {
  private static $_instances = array();
  private $_pdo, $_query, $_result, $_numb = 0, $_error = false, $_lastInsertID = null, $_instHash;

  private function __construct($dbName = '', $dbUser = DB_USER, $dbPass = DB_PASSWORD) {

    try {
      $this->_pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . $dbName, $dbUser, $dbPass);
      $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {

      die($e->getMessage());
    }
    $this->_instHash = md5($dbName . $dbUser);
    self::$_instances[] = $this;
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
        if(preg_match("/select/i", $sql) || preg_match("/show/i", $sql)) {
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
    $sql = "INSERT INTO sites ({$fieldStr}) VALUES ({$valStr})";

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

  public function changeUserData($params = []) {
    $sql = "UPDATE users SET email= ?, rest= ? WHERE id_user= ?";
    $res = $this->sqlQuery($sql, $params);
    return $res;
  }

  public function changeUserPassword($params = []) {
    $sql = "UPDATE users SET password= ? WHERE id_user= ?";
    $res = $this->sqlQuery($sql, $params);
    return $res;
  }

  public function changeSiteData($params = []) {
    $sql = "UPDATE sites SET title= ?, description= ? WHERE id_site= ?";
    $res = $this->sqlQuery($sql, $params);
    return $res;
  }

  public function deleteSiteById($site_id) {
    $sql = "DELETE FROM sites WHERE id_site= ?";
    $res = $this->sqlQuery($sql, $site_id);
    return $res;
  }

  public function makeAdmin($user_id) {
    $sql = "UPDATE users SET usertype='admin' WHERE id_user= ?";
    $res = $this->sqlQuery($sql, $user_id);
    return $res;
  }

  public function createSitesDb($db_name, $db_username, $db_pass, $s_id) {

    $sql = "CREATE DATABASE IF NOT EXISTS {$db_name}";
    $res = $this->sqlQuery($sql);
    if($res) {
      $sql = "CREATE USER IF NOT EXISTS {$db_username} IDENTIFIED BY '{$db_pass}'";
      $res = $this->sqlQuery($sql);
      if($res) {
        $sql = "GRANT USAGE ON {$db_name}.* TO {$db_username}@'%'";
        $res = $this->sqlQuery($sql);
        $sql = "GRANT ALL privileges ON {$db_name}.* TO {$db_username}@'%'";
        $res = $this->sqlQuery($sql);
        $sql = "FLUSH PRIVILEGES";
        $res = $this->sqlQuery($sql);
        $sql = "USE " . DB_NAME;
        $res = $this->sqlQuery($sql);
        $sql = "UPDATE sites SET db_name= ? WHERE id_site= ?";
        $res = $this->sqlQuery($sql, [$db_name, $s_id]);
      }
    }
    return $res;
  }

  public function deleteSitesDb($db_name) {
    $sql = "DROP DATABASE IF EXISTS {$db_name}";
    $res = $this->sqlQuery($sql);
    return $res;
  }

  public function changeUsersDbPassword($db_username, $db_password) {
    $sql = "SET PASSWORD FOR {$db_username}@'%' = PASSWORD('{$db_password}')";
    $res = $this->sqlQuery($sql);
    return $res;
  }

  public function getTableNamesInDb($db_name) {
    $res = [];
    $sql = "SHOW TABLES FROM {$db_name}";
    $info = $this->sqlQuery($sql);
    foreach ($info as $table) {
      $res[] = $table['Tables_in_' . $db_name];
    }
    if($res) {
      return $res;
    } else {
      return false;
    }

  }


}

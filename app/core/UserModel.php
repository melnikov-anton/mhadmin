<?php

class UserModel {
  private static $_users = array();
  private $_uid, $_fname, $_lname, $_uname, $_rest, $_sites, $_db, $_session, $_isAdmin = false;


  public function __construct($username) {
    $this->_db = Db::getConnection();
    $sql = "SELECT * FROM users WHERE username= ?";
    $res = $this->_db->sqlQuery($sql, $username);
    $res = $res[0];
    $this->_uid = $res['id_user'];
    $this->_fname = $res['fname'];
    $this->_lname = $res['lname'];
    $this->_uname = $res['username'];
    $this->_rest = $res['rest'];
    $this->_session = md5(session_id() . $this->_uname);
    if($res['usertype'] == 'admin') {
      $this->_isAdmin = true;
    }
    setcookie("UserName", $this->_uname, "/");
    self::$_users[] = $this;

  }

  public static function registerUser($user_data = []) {
    $user_data = array_diff_key($user_data, ['rep_pass' => ' ']);
    if($user_data['email'] == "") {
      $user_data = array_diff_key($user_data, ['email' => ' ']);
    }
    if($user_data['rest'] == "") {
      $user_data = array_diff_key($user_data, ['rest' => ' ']);
    }
    $dbc = Db::getConnection();
    $un = UserModel::createUserName($user_data['fname'], $user_data['lname']);
    //$uun = $dbc->checkUniqueUsername($un);
    while (!$dbc->checkUniqueUsername($un)) {
      $un = UserModel::createUserName($user_data['fname'], $user_data['lname']);
      usleep(200000);
    }
    $user_data = array_merge($user_data, ['username' => $un]);
    $user_data['password'] = password_hash($user_data['password'], PASSWORD_BCRYPT);

    if($dbc->saveUserInDb($user_data)) {
      $us = new UserModel($user_data['username']);
      print_data($us);
      return true;
    } else return false;

  }

  public static function getUser($uname) {
    if(empty(self::$_users)) {
      return false;
    } else {
      foreach (self::$_users as $user) {
        if($user->_session == md5(session_id() . $uname)) {
          return $user;
        }
      }
    }
    return false;
  }

  public static function createUserName($fname, $lname) {
    $fname=translit($fname);
    $lname=translit($lname);
    $str = substr($fname, 0, 3) . substr($lname, 0, 3);
    $str = strtolower($str) . rand(1,99);
    return $str;
  }

  public function isAdmin() {
    return $this->_isAdmin;
  }

  public function getFirstName() {
    return $this->_fname;
  }

  public function getLastName() {
    return $this->_lname;
  }

  public function getUserId() {
    return $this->_uid;
  }

  public function getRestInfo() {
    return $this->_rest;
  }

  public function logout() {
    setcookie("UserName", "", time()-10, "/");
  }

}

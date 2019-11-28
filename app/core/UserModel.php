<?php

class UserModel {

  private $_uid, $_fname, $_lname, $_uname, $_email, $_rest, $_sites, $_perm = array(), $_isAdmin = false;


  public function __construct($username) {
    $db = Db::getConnection();
    $sql = "SELECT * FROM users WHERE username= ?";
    $res = $db->sqlQuery($sql, $username);
    $res = $res[0];
    $this->_uid = $res['id_user'];
    $this->_fname = $res['fname'];
    $this->_lname = $res['lname'];
    $this->_uname = $res['username'];
    $this->_email = $res['email'];
    $this->_rest = $res['rest'];
    if($res['usertype'] == 'admin') {
      $this->_isAdmin = true;
    }
    $this->_sites = $db->getSitesDataByUserId($this->_uid);
    $this->_perm['id'] = $this->_uid;
    if($this->_sites) {
      foreach ($this->_sites as $key => $site) {
        $this->_perm['site'][] = $site['id_site'];
      }
    } else {
      $this->_perm['site'][0] = '0';
    }

  }

  public static function getUser($id) {
    $db = Db::getConnection();
    $u_data = $db->getUserDataById($id);
    return new UserModel($u_data['username']);
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

    while (!$dbc->checkUniqueUsername($un)) {
      $un = UserModel::createUserName($user_data['fname'], $user_data['lname']);
      usleep(200000);
    }
    $user_data = array_merge($user_data, ['username' => $un]);
    $user_data['password'] = password_hash($user_data['password'], PASSWORD_BCRYPT);

    if($dbc->saveUserInDb($user_data)) {
      $_SESSION['username'] = $user_data['username'];
      $_SESSION['admin'] = false;
      return true;
    } else {return false;}

  }


  public static function createUserName($fname, $lname) {
    $fname = UserModel::translit($fname);
    $lname = UserModel::translit($lname);
    $str = substr($fname, 0, 3) . substr($lname, 0, 3);
    $str = strtolower($str) . rand(1,99);
    return $str;
  }

  public static function translit($stroka) {
      $converter = array(
    'а' => 'a', 'б' => 'b', 'в' => 'v',
    'г' => 'g', 'д' => 'd', 'е' => 'e',
    'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
    'и' => 'i', 'й' => 'y', 'к' => 'k',
    'л' => 'l', 'м' => 'm', 'н' => 'n',
    'о' => 'o', 'п' => 'p', 'р' => 'r',
    'с' => 's', 'т' => 't', 'у' => 'u',
    'ф' => 'f', 'х' => 'kh', 'ц' => 'ts',
    'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch',
    'ь' => '', 'ы' => 'y', 'ъ' => '',
    'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
    'А' => 'A', 'Б' => 'B', 'В' => 'V',
    'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
    'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
    'И' => 'I', 'Й' => 'Y', 'К' => 'K',
    'Л' => 'L', 'М' => 'M', 'Н' => 'N',
    'О' => 'O', 'П' => 'P', 'Р' => 'R',
    'С' => 'S', 'Т' => 'T', 'У' => 'U',
    'Ф' => 'F', 'Х' => 'Kh', 'Ц' => 'Ts',
    'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Shch',
    'Ь' => '', 'Ы' => 'Y', 'Ъ' => '',
    'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
    );
   return strtr($stroka, $converter);
  }

  public function prepareSiteData($input_array = []) {
    if(isset($input_array)) {
      if($this->_sites) {
        $i = 1;
        $s_numb_arr = [];
        foreach ($this->_sites as $site) {
          $s_numb_arr[] = explode('-', $site['site_name'])[2];
        }
        while (in_array($i, $s_numb_arr)) {
          $i += 1;
        }
      } else {$i = 1;}
      $input_array['site_dir'] = $this->_uname . DS . 'site_' . $i;
      $input_array['site_name'] = $this->_uname . '-site-' . $i;
      $input_array['db_name'] = '';
      $input_array['id_user'] = $this->_uid;
      return $input_array;
    } else return false;


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

  public function getUsername() {
    return $this->_uname;
  }

  public function getEmail() {
    return $this->_email;
  }

  public function getSites() {
    return $this->_sites;
  }

  public function getUserPermissions() {
    return $this->_perm;
  }

}

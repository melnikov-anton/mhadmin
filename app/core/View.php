<?php

class View {

  public function indexView() {
    $main_user = new UserModel($_SESSION['username']);
    $user = $main_user;
    $user_sites = $user->getSites();
    if($user_sites) {
      define ('SITES_INFO_CARD', PAGES_DIR . DS . 'cards/sites_info_card.php');
    }
    define ('PAGE_CONTENT', PAGES_DIR . DS . 'views/user_data_view.php');

    require_once(PAGES_DIR . DS . 'account_page.php');

  }


  public function usersView($argv1 = '', $argv2 = '') {
    $main_user = new UserModel($_SESSION['username']);
    $perm = $main_user->getUserPermissions();

    switch (true) {
        case ($argv1 == ''):
              if(defined('IS_ADMIN') && constant('IS_ADMIN') == 'admin') {
                $dbc = Db::getConnection();
                $users_list = $dbc->getUsersList();
                define ('PAGE_CONTENT', PAGES_DIR . DS . 'views/users_view.php');
              } else {
                  $msg = 'Нет доступа!';
                  define ('PAGE_CONTENT', PAGES_DIR . DS . 'views/error_page_view.php');
                }
        break;

        case ((int)$argv1 !== 0):
          if((defined('IS_ADMIN') && constant('IS_ADMIN') == 'admin') || $argv1 == $perm['id']) {
            $dbc = Db::getConnection();
            $u_info = $dbc->getUserDataById($argv1);

            if($u_info) {
              $user_sites = $dbc->getSitesDataByUserId($u_info['id_user']);
              define ('PAGE_CONTENT', PAGES_DIR . DS . 'views/user_data_view.php');
              if($user_sites) {
                define ('SITES_INFO_CARD', PAGES_DIR . DS . 'cards/sites_info_card.php');
              }
              $user = new UserModel($u_info['username']);
            } else {
              $msg = MSG_USERINDB_ERR;
              define ('PAGE_CONTENT', PAGES_DIR . DS . 'views/error_page_view.php');

              }
            } else {
              $msg = 'Нет доступа!';
              define ('PAGE_CONTENT', PAGES_DIR . DS . 'views/error_page_view.php');
            }
          break;

          case ($argv1 == 'changeprofil' && (int)$argv2 !== 0):

            //define ('PAGE_CONTENT', PAGES_DIR . DS . 'create_site_view.php');
          break;

          case ((int)$argv1 == 0):
            header('Location: /user/account');
          break;
      }
      require_once(PAGES_DIR . DS . 'account_page.php');
  }


  public function sitesView($argv1 = '', $argv2 = '') {
    $main_user = new UserModel($_SESSION['username']);
    $perm = $main_user->getUserPermissions();

    switch (true) {
        case ($argv1 == ''):
          if(defined('IS_ADMIN') && constant('IS_ADMIN') == 'admin') {
            $dbc = Db::getConnection();
            $sites_list = $dbc->getSitesList();
            define ('PAGE_CONTENT', PAGES_DIR . DS . 'views/sites_view.php');
          } else {
              $msg = 'Нет доступа!';
              define ('PAGE_CONTENT', PAGES_DIR . DS . 'views/error_page_view.php');
            }
        break;

        case ((int)$argv1 !== 0):
          if((defined('IS_ADMIN') && constant('IS_ADMIN') == 'admin') || in_array($argv1, $perm['site'])) {
            $dbc = Db::getConnection();
            $s_info = $dbc->getSiteDataById($argv1);
            if(!$s_info) {
              $msg = 'Нет такого сайта!';
              define ('PAGE_CONTENT', PAGES_DIR . DS . 'views/error_page_view.php');

            } else {
              define ('PAGE_CONTENT', PAGES_DIR . DS . 'views/site_data_view.php');
            }

          } else {
              $msg = 'Нет доступа!';
              define ('PAGE_CONTENT', PAGES_DIR . DS . 'views/error_page_view.php');
            }
        break;
      }
      require_once(PAGES_DIR . DS . 'account_page.php');

  }


  public function createsiteView($argv1 = '', $argv2 = '') {
    if((int)$argv1 !== 0) {
      define ('PAGE_CONTENT', PAGES_DIR . DS . 'views/create_site_view.php');
    } else {
      header('Location: /user/account');
    }
    require_once(PAGES_DIR . DS . 'account_page.php');
  }


  public function changeprofilView($argv1 = '', $argv2 = '') {
    if((int)$argv1 !== 0) {
      $main_user = new UserModel($_SESSION['username']);
      $perm = $main_user->getUserPermissions();
      if((defined('IS_ADMIN') && constant('IS_ADMIN') == 'admin') || $argv1 == $perm['id']) {
        $dbc = Db::getConnection();
        $u_info = $dbc->getUserDataById($argv1);
        $user = new UserModel($u_info['username']);
        define ('PAGE_CONTENT', PAGES_DIR . DS . 'views/change_profil_view.php');
      } else {
          $msg = 'Нет доступа!';
          define ('PAGE_CONTENT', PAGES_DIR . DS . 'views/error_page_view.php');
        }
        require_once(PAGES_DIR . DS . 'account_page.php');
    } else {
      header('Location: /user/account');
    }
  }


  public function createdbView($argv1 = '', $argv2 = '') {
    if((int)$argv1 !== 0 && (int)$argv2 !== 0) {
      $dbc = Db::getConnection();
      $main_user = new UserModel($_SESSION['username']);
      $perm = $main_user->getUserPermissions();
      if($argv2 == $perm['id'] && in_array($argv1, $perm['site'])) {
        $sd = $dbc->getSiteDataById($argv1);
        $site_index = explode('-', $sd['site_name'])[2];
        //print_data($site_index);
        $db_name = $main_user->getUsername() . '_site_' . $site_index . '_db';
        define ('PAGE_CONTENT', PAGES_DIR . DS . 'views/create_db_view.php');
      } else {
        $msg = 'Только владелец сайта может создать базу данных!';
        define ('PAGE_CONTENT', PAGES_DIR . DS . 'views/error_page_view.php');
      }
    } else {
      header('Location: /user/account');
    }



    require_once(PAGES_DIR . DS . 'account_page.php');

  }

  public function changetypeView($argv1 = '', $argv2 = '') {
    if((int)$argv1 !== 0 && $_SESSION['admin']) {
      $dbc = Db::getConnection();
      $ud = $dbc->getUserDataById($argv1);
      if($ud) {
        define ('PAGE_CONTENT', PAGES_DIR . DS . 'views/change_type_view.php');
      } else {
        $msg = 'Пользователь не найден!';
        define ('PAGE_CONTENT', PAGES_DIR . DS . 'views/error_page_view.php');
      }

    } else {
        $msg = 'Нет доступа!';
        define ('PAGE_CONTENT', PAGES_DIR . DS . 'views/error_page_view.php');
      }
    require_once(PAGES_DIR . DS . 'account_page.php');

  }


  public function changesiteView($argv1 = '', $argv2 = '') {
    if((int)$argv1 !== 0) {
      $main_user = new UserModel($_SESSION['username']);
      $perm = $main_user->getUserPermissions();
      if((defined('IS_ADMIN') && constant('IS_ADMIN') == 'admin') || in_array($argv1, $perm['site'])) {
        $dbc = Db::getConnection();
        $s_info = $dbc->getSiteDataById($argv1);

        define ('PAGE_CONTENT', PAGES_DIR . DS . 'views/change_site_view.php');
      } else {
          $msg = 'Нет доступа!';
          define ('PAGE_CONTENT', PAGES_DIR . DS . 'views/error_page_view.php');
        }
        require_once(PAGES_DIR . DS . 'account_page.php');
    } else {
      header('Location: /user/account');
    }

  }


  public function deletesiteView($argv1 = '', $argv2 = '') {
    if((int)$argv1 !== 0) {
      $main_user = new UserModel($_SESSION['username']);
      $perm = $main_user->getUserPermissions();
      if((defined('IS_ADMIN') && constant('IS_ADMIN') == 'admin') || in_array($argv1, $perm['site'])) {
        $dbc = Db::getConnection();
        $sd = $dbc->getSiteDataById($argv1);
        define ('PAGE_CONTENT', PAGES_DIR . DS . 'views/delete_site_view.php');
      } else {
          $msg = 'Нет доступа!';
          define ('PAGE_CONTENT', PAGES_DIR . DS . 'views/error_page_view.php');
        }
        require_once(PAGES_DIR . DS . 'account_page.php');
      } else {
        header('Location: /user/account');
      }


  }






}

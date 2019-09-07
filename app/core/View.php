<?php

class View {

  public function indexView() {
    $main_user = new UserModel($_SESSION['username']);
    $user = $main_user;
    $user_sites = $user->getSites();
    if($user_sites) {
      define ('SITES_INFO_CARD', PAGES_DIR . DS . 'sites_info_card.php');
    }
    define ('PAGE_CONTENT', PAGES_DIR . DS . 'user_data_view.php');

    require_once(ROOT . DS . 'app' . DS . 'pages' . DS . 'account_page.php');
    
  }


  public function usersView($argv1 = '', $argv2 = '') {
    $main_user = new UserModel($_SESSION['username']);
    $perm = $main_user->getUserPermissions();

    switch (true) {
        case ($argv1 == ''):
              if(defined('IS_ADMIN') && constant('IS_ADMIN') == 'admin') {
                $dbc = Db::getConnection();
                $users_list = $dbc->getUsersList();
                define ('PAGE_CONTENT', PAGES_DIR . DS . 'users_view.php');
              } else {
                  $msg = 'Нет доступа!';
                  define ('PAGE_CONTENT', PAGES_DIR . DS . 'error_page_view.php');
                }
        break;

        case ((int)$argv1 !== 0):
          if((defined('IS_ADMIN') && constant('IS_ADMIN') == 'admin') || $argv1 == $perm['id']) {
            $dbc = Db::getConnection();
            $u_info = $dbc->getUserDataById($argv1);

            if($u_info) {
              $user_sites = $dbc->getSitesDataByUserId($u_info['id_user']);
              define ('PAGE_CONTENT', PAGES_DIR . DS . 'user_data_view.php');
              if($user_sites) {
                define ('SITES_INFO_CARD', PAGES_DIR . DS . 'sites_info_card.php');
              }
              $user = new UserModel($u_info['username']);
            } else {
              $msg = MSG_USERINDB_ERR;
              define ('PAGE_CONTENT', PAGES_DIR . DS . 'error_page_view.php');

              }
            } else {
              $msg = 'Нет доступа!';
              define ('PAGE_CONTENT', PAGES_DIR . DS . 'error_page_view.php');
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
            define ('PAGE_CONTENT', PAGES_DIR . DS . 'sites_view.php');
          } else {
              $msg = 'Нет доступа!';
              define ('PAGE_CONTENT', PAGES_DIR . DS . 'error_page_view.php');
            }
        break;

        case ((int)$argv1 !== 0):
          if((defined('IS_ADMIN') && constant('IS_ADMIN') == 'admin') || in_array($argv1, $perm['site'])) {
            $dbc = Db::getConnection();
            $s_info = $dbc->getSiteDataById($argv1);
            define ('PAGE_CONTENT', PAGES_DIR . DS . 'site_data_view.php');
          } else {
              $msg = 'Нет доступа!';
              define ('PAGE_CONTENT', PAGES_DIR . DS . 'error_page_view.php');
            }
        break;
      }
      require_once(PAGES_DIR . DS . 'account_page.php');

  }


  public function createsiteView($argv1 = '', $argv2 = '') {
    if((int)$argv1 !== 0) {
      define ('PAGE_CONTENT', PAGES_DIR . DS . 'create_site_view.php');
    } else {
      header('Location: /user/account');
    }
    require_once(PAGES_DIR . DS . 'account_page.php');
  }


  public function changeprofilView($argv1 = '', $argv2 = '') {

    define ('PAGE_CONTENT', PAGES_DIR . DS . 'change_profil_view.php');

    require_once(PAGES_DIR . DS . 'account_page.php');
  }

  public function createdbView($argv1 = '', $argv2 = '') {

    define ('PAGE_CONTENT', PAGES_DIR . DS . 'create_db_view.php');

    require_once(PAGES_DIR . DS . 'account_page.php');

  }

  public function changesiteView($argv1 = '', $argv2 = '') {

    define ('PAGE_CONTENT', PAGES_DIR . DS . 'change_site_view.php');

    require_once(PAGES_DIR . DS . 'account_page.php');

  }

  public function deletesiteView($argv1 = '', $argv2 = '') {

    define ('PAGE_CONTENT', PAGES_DIR . DS . 'delete_site_view.php');

    require_once(PAGES_DIR . DS . 'account_page.php');


  }






}

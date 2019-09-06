<?php

  if(isset($_SESSION['username'])) {
    $main_user = new UserModel($_SESSION['username']);
    $_SESSION['id_user'] = $main_user->getUserId();
    $perm = $main_user->getUserPermissions();
    if($main_user->isAdmin()) {
      define('USER_ROLE', 'admin');
      define('IS_ADMIN', true);
      $users_list = '';
    } else {
      define('USER_ROLE', 'user');
      define('IS_ADMIN', false);
    }
    $user = $main_user;

    switch (true) {
      case ($arg1 == ''):
        $user_sites = $user->getSites();
        if($user_sites) {
          define ('SITES_INFO_CARD', 'sites_info_card.php');
        }
        define ('PAGE_CONTENT', 'user_data_view.php');
        break;

      case ($arg1 == 'users' && $arg2 == ''):
        if(defined('IS_ADMIN') && constant('IS_ADMIN') == 'admin') {
          $dbc = Db::getConnection();
          $users_list = $dbc->getUsersList();
          define ('PAGE_CONTENT', 'users_view.php');
        } else {
            $msg = 'Нет доступа!';
            define ('PAGE_CONTENT', 'error_page_view.php');
          }
        break;

      case ($arg1 == 'users' && (int)$arg2 != 0):
        if((defined('IS_ADMIN') && constant('IS_ADMIN') == 'admin') || $arg2 == $perm['id']) {
          $dbc = Db::getConnection();
          $u_info = $dbc->getUserDataById($arg2);

          if($u_info) {
            $user_sites = $dbc->getSitesDataByUserId($u_info['id_user']);
            define ('PAGE_CONTENT', 'user_data_view.php');
            if($user_sites) {
              define ('SITES_INFO_CARD', 'sites_info_card.php');
            }
            $user = new UserModel($u_info['username']);
          } else {
            $msg = MSG_USERINDB_ERR;
            define ('PAGE_CONTENT', 'error_page_view.php');
            //Router::showErrorPage(MSG_USERINDB_ERR);
            }
          } else {
            $msg = 'Нет доступа!';
            define ('PAGE_CONTENT', 'error_page_view.php');
          }
        break;

        case ($arg1 == 'sites' && $arg2 == ''):
          if(defined('IS_ADMIN') && constant('IS_ADMIN') == 'admin') {
            $dbc = Db::getConnection();
            $sites_list = $dbc->getSitesList();
            define ('PAGE_CONTENT', 'sites_view.php');
          } else {
              $msg = 'Нет доступа!';
              define ('PAGE_CONTENT', 'error_page_view.php');
            }
        break;

        case ($arg1 == 'sites' && (int)$arg2 != 0):
          if((defined('IS_ADMIN') && constant('IS_ADMIN') == 'admin') || in_array($arg2, $perm['site'])) {
            $dbc = Db::getConnection();
            $s_info = $dbc->getSiteDataById($arg2);
            define ('PAGE_CONTENT', 'site_data_view.php');
          } else {
              $msg = 'Нет доступа!';
              define ('PAGE_CONTENT', 'error_page_view.php');
            }
        break;

        case ($arg1 == 'users' && $arg2 == 'createsite' && (int)$arg3 != 0):

          define ('PAGE_CONTENT', 'create_site_view.php');
        break;

    }

  }

 ?>

<!DOCTYPE html>
<html lang="ru">

  <head>
    <title>MH Admin: Личный кабинет</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/mhadmin.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap_4.3.1.min.css">

  </head>

  <body>

  <div class="container-fluid" style="height: 100%;">

    <div class="row" style="min-height: 10%;">
      <div class="col-md-12 border border-primary rounded-lg">
        <h3 class="text-center p-3">Mini-Hosting Admin</h3>
      </div>
    </div>

    <div class="row" style="min-height: 90%;">

        <div class="col-md-3 border border-primary rounded-lg bg-orange mh-100">
          <div class="row">
            <div class="card mt-2 mx-auto border border-primary rounded-lg bg-success text-white shadow-lg">
              <div class="card-body">
                <h5>Имя пользователя: <span style="text-decoration: underline;font-size: 1.3em;"><b><?php echo $_SESSION['username']; ?></b></span></h5>
                <?php if($main_user->isAdmin()): ?>
                  <h5>Роль: Администратор</h5>
                <?php endif; ?>
              </div>

            </div>
          </div>
          <div class="row">
            <div class="col-md-12 mt-3">
              <?php include 'side_menu.php';?>
            </div>
          </div>
        </div>


          <?php
            if(defined('PAGE_CONTENT')) {
              include PAGE_CONTENT;
            }
          ?>

    </div>

  </div>

  </body>
</html>

<?php

  if(isset($_SESSION['username'])) {
    $main_user = new UserModel($_SESSION['username']);
    $_SESSION['id_user'] = $main_user->getUserId();
    $USERNAME = $main_user->getUsername();
    if($main_user->isAdmin()) {
      define('USER_ROLE', 'admin');
      $users_list = '';
    } else {
      define('USER_ROLE', 'user');
    }
    $user = $main_user;

    switch (true) {
      case ($arg1 == ''):
        define ('PAGE_CONTENT', 'user_data_view.php');
        break;
      case ($arg1 == 'users' && $arg2 == ''):
        $dbc = Db::getConnection();
        $users_list = $dbc->getUsersList();
        define ('PAGE_CONTENT', 'users_view.php');
        break;
      case ($arg1 == 'users' && is_int((int)$arg2) && (int)$arg2 != 0):
        $dbc = Db::getConnection();
        $u_info = $dbc->getUserDataById($arg2);

        if($u_info) {
          define ('PAGE_CONTENT', 'user_data_view.php');
          $user = new UserModel($u_info['username']);
        } else {
          $msg = MSG_USERINDB_ERR;
          define ('PAGE_CONTENT', 'error_page.php');
          //Router::showErrorPage(MSG_USERINDB_ERR);
        }
        break;
        case ($arg1 == 'sites' && $arg2 == ''):
          $msg = 'Страница в разработке!';
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

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 border border-primary rounded-lg">
        <h3 class="text-center p-3">Mini-Hosting Admin</h3>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3 border border-primary rounded-lg bg-orange mh-100">
        <div class"row">
          <div class="card mt-2 border border-primary rounded-lg bg-success text-white shadow-lg">
            <div class="card-body">
              <h5>Имя пользователя: <span style="text-decoration: underline;font-size: 1.3em;"><b><?php echo $USERNAME; ?></b></span></h5>
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

      <div class="col-md-9 border border-primary rounded-lg p-4 bg-light mh-100">
        <?php
          if(defined('PAGE_CONTENT')) {
            include PAGE_CONTENT;
          }
        ?>
      </div>

    </div>

  </div>

  </body>
</html>

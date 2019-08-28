<?php

  if(isset($_SESSION['username'])) {
    $user = new UserModel($_SESSION['username']);
    if($user->isAdmin()) {
      $cat = 'Admin';
      if($arg1 == 'users') {
        $dbc = Db::getConnection();
        $users_list = $dbc->getUsersList();
      } else {$users_list = '';}
    } else {$cat = 'User';}


  }

 ?>

<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--изменить ссылку на файл стилей-->
    <link rel="stylesheet" type="text/css" href="/css/mhadmin.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap_4.3.1.min.css">

  </head>

  <body>

  <div class="container-fluid h-100">
    <div class="row">
      <div class="col-md-12 border border-primary rounded-lg">
        <h3 class="text-center p-3">Mini-Hosting Admin</h3>
      </div>

    </div>

    <div class="row h-100">
      <div class="col-md-3 border border-primary rounded-lg bg-orange">
        <div class"row">
          <div class="col-md-12 border border-primary">
            <h4 class="ml-1 p-3">Имя пользователя: <?php echo $user->getUsername(); ?></h4>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 mt-3">
            <?php include 'side_menu.php';?>
          </div>
        </div>
      </div>

      <div class="col-md-9 border border-primary rounded-lg p-4 bg-light">
        <?php
        if($arg1 == '') {
          include 'user_data_view.php';
        } elseif ($arg1 == 'users') {
          include 'users_view.php';
        }

        ?>
      </div>

    </div>

  </div>

  </body>
</html>

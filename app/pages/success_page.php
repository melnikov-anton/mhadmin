<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="../css/mhadmin.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap_4.3.1.min.css">

  </head>

  <body>

  <div class="container-fluid">

    <div class="row mt-4">
      <div class="col-md-6 mx-auto border border-success rounded-lg p-4 bg-light">
        <h2 class="text-center text-success"><?php echo $msg; ?></h2>
      </div>
   </div>

<?php
  $sec_msg = '';
  if($msg == MSG_REG_SUC) {
    $sec_msg = <<<MSG
       <div class="row mt-4">
         <div class="col-md-5 mx-auto border border-primary rounded-lg p-3 bg-light">
           <h5 class="text-center">Пользователь <b>{$_SESSION['username']}</b> успешно зарегистрирован!</h5>
           <h5 class="text-center">Используйте это имя пользователя и введенный пароль для входа в приложение.</h5>
         </div>
       </div>
MSG;
  }
  echo $sec_msg;
?>
    <div class="row mt-3">
      <div class="col-md-4 mx-auto p-4">
        <img src="/images/standup_cat.jpg" class="mx-auto d-block" alt="Success">
      </div>
    </div>

    <div class="row mt-1">
      <div class="col-md-3 mx-auto p-3">
        <a href="/" class="btn btn-outline-success btn-block mt-4">Продолжить</a>
      </div>
    </div>

  </div>

  </body>
</html>


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
      <div class="col-md-12 border border-primary rounded-lg bg-lightblue">
        <h3 class="text-center p-3">Mini-Hosting Admin</h3>
      </div>
    </div>

    <div class="row" style="min-height: 90%;">

        <div class="col-md-3 border border-primary rounded-lg bg-orange mh-100">
          <div class="row">
            <div class="card mt-2 mx-auto border border-primary rounded-lg bg-success text-white shadow-lg">
              <div class="card-body">
                <h5>Имя пользователя: <span style="text-decoration: underline;font-size: 1.3em;"><b><?php echo $_SESSION['username']; ?></b></span></h5>
                <?php if(constant('IS_ADMIN') == 'admin'): ?>
                  <h5>Роль: Администратор</h5>
                <?php endif; ?>
              </div>

            </div>
          </div>
          <div class="row">
            <div class="col-md-12 mt-3">
              <?php include PAGES_DIR . DS . 'side_menu.php';?>
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

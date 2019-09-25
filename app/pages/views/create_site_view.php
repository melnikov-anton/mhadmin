<?php
  $db = Db::getConnection();
  $us = $db->getUserDataById($argv1);
?>

<div class="col-md-9 border border-primary p-4 bg-light mh-100">
  <div class="card bg-light text-dark shadow-lg">
      <div class="card-body">
        <h4 class="card-title">Создание сайта</h4>
        <div class="row">
          <div class="col-md-6 mx-auto p-4 bg-light mb-5">
              <h5 class="text-center">Сайт для пользователя <b class="text-primary"><?php echo $us['username']; ?></b></h5>
              <form action="/user/createsite/<?php echo $argv1 ?>" method="post">
                <label for="tit">*Имя сайта</label>
                </br>
                <input type="text" class="form-control" id="tit" name="title" required>
                </br>

                <label for="desc">Краткое описание</label>
                </br>
                <textarea name="description" id="desc" class="form-control"
                    maxlength="250" style="height: 10em"></textarea>
                </br>
                </br>
                <input type="submit" class="btn btn-primary btn-block" value="Создать сайт">
              </form>

            </div>
        </div>
      </div>
    </div>
</div>

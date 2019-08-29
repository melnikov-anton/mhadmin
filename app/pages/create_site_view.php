<?php
// если админ - добавить выбор пользователя?!
?>

<div class="card bg-light text-dark shadow-lg">
    <div class="card-body">

      <div class="row">
        <div class="col-md-4 mx-auto border border-primary rounded-lg p-4 bg-light shadow-lg">

            <form action="/site/create" method="post">
              <label for="tit">*Имя сайта</label>
              </br>
              <input type="text" class="form-control" id="tit" name="title" required>
              </br>

              <label for="desc">Краткое описание</label>
              </br>
              <textarea name="description" id="desc" class="form-control"
                  maxlength="250"></textarea>
              </br>
              </br>
              <input type="submit" class="btn btn-primary btn-block" value="Создать сайт">
            </form>

          </div>
      </div>
    </div>
  </div>

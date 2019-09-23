
<div class="col-md-9 border border-primary rounded-lg p-4 bg-light mh-100">
  <div class="card bg-light text-dark shadow-lg">
      <div class="card-body">
        <h4 class="card-title">Удаление сайта</h4>
        <div class="row">
          <div class="col-md-8 mx-auto border border-danger rounded-lg p-3 bg-light mb-5 mt-4">
            <h5 class="text-center">Удаление сайта <b><?php echo $sd['site_name']; ?></b></h5>
            <p class="text-center">Внимание! Ваш сайт будет удален! Содержимое директории, в которой размещался
            сайт, будет сохранено в архиве. Чтобы получить архив, обратитесь к администратору сервиса.</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 mx-auto p-4 bg-light mb-5">
              <h6>Что-бы удалить сайт, укажите пароль от Вашей учетной записи.</h6>
              </br>
              <form action="/user/deletesite/<?php echo $argv1 ?>" method="post">
                <label for="passw">*Пароль</label>
                </br>
                <input type="password" class="form-control" id="passw" name="password" required>
                </br>
                <input type="submit" class="btn btn-primary btn-block" value="Удалить сайт">
              </form>

            </div>
        </div>
      </div>
    </div>
</div>

<div class="col-md-9 border border-primary p-4 bg-light">
    <div class="card bg-light text-dark shadow-lg">
        <div class="card-body">
          <h4 class="card-title">Назначение пользователя администратором</h4>

              <div class="row">
                <div class="col-md-8 mx-auto border border-danger rounded-lg p-3 bg-light mb-5 mt-4">
                    <h5 class="text-center">Назначение пользователя <b><?php echo $ud['username'] . ' (' . $ud['fname'] . ' ' . $ud['lname'] . ')'; ?></b>
                        администратором!</h5>
                    <p class="text-center">Внимание! Указанный пользователь получит расширенные права!</p>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4 mx-auto p-4 bg-light mb-5">
                    <h6>Что-бы назначить пользователя администратором, укажите пароль от Вашей учетной записи.</h6>
                    </br>
                    <form action="/user/makeadmin/<?php echo $argv1 ?>" method="post">
                        <label for="passw">*Пароль</label>
                        </br>
                        <input type="password" class="form-control" id="passw" name="password" required>
                        </br>
                        <input type="submit" class="btn btn-primary btn-block" value="Назначить администратором">
                    </form>
                  </div>
              </div>

        </div>

    </div>

</div>


<div class="col-md-9 border border-primary rounded-lg p-4 bg-light">
    <div class="card bg-light text-dark shadow-lg">
        <div class="card-body">
          <h4 class="card-title">Изменение информация о пользователе</h4>

          <div class="row">
            <div class="col-md-6 p-4 m-4">
              <div class="row">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm">
                  <tbody>
                    <tr>
                      <td style="width: 40%;"><h6>Имя:</h6></td>
                      <td><?php echo $user->getFirstName(); ?></td>
                    </tr>
                    <tr>
                      <td><h6>Фамилия:</h6></td>
                      <td><?php echo $user->getLastName(); ?></td>
                    </tr>
                    <tr>
                      <td><h6>E-Mail:</h6></td>
                      <td><?php echo $user->getEmail(); ?></td>
                    </tr>
                    <tr>
                      <td><h6>Имя пользователя:</h6></td>
                      <td><?php echo $user->getUsername(); ?></td>
                    </tr>
                    <tr>
                      <td><h6>Тип пользователя:</h6></td>
                      <td><?php if($user->isAdmin()) {echo "Администратор";} else {echo "Пользователь";} ?></td>
                    </tr>
                    <tr>
                      <td><h6>Дополнительная информация:</h6></td>
                      <td><?php echo $user->getRestInfo(); ?></td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>

            <div class="row">
              <div class="col-md-8 mx-auto border border-primary rounded-lg p-4">
                <form action="/user/changepassword/<?php echo $user->getUserId(); ?>" method="post">
                  <div class="form-group">
                    <h6>Изменить пароль:</h6>
                  </div>
                  <div class="form-group">
                    <label for="oldpw">*Старый пароль</label>
                    <input type="password" id="oldpw" name="password" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="npw">*Новый пароль</label>
                    <input type="password" id="npw" name="new_pass" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="rnpw">*Повторите новый пароль</label>
                    <input type="password" id="rnpw" name="rep_new_pass" class="form-control" required>
                  </div>
                  <button type="submit" class="btn btn-primary btn-block mt-5">Изменить пароль</button>
                </form>
              </div>

            </div>


            </div>

            <div class="col-md-5 mx-auto border border-primary rounded-lg p-4">
              <form action="/user/changeprofil/<?php echo $user->getUserId(); ?>" method="post">
                <div class="form-group">
                  <h6>Изменить данные:</h6>
                </div>
                <div class="form-group">
                  <label for="em">E-Mail</label>
                  <input type="email" id="em" name="email" value="<?php echo $user->getEmail(); ?>" class="form-control">
                </div>

                <div class="form-group">
                  <label for="pr">Примечание</label>
                  <textarea name="rest" id="pr"
                      title="Поле может быть использовано, если нужно зарегистрировать группу учащихся."
                      maxlength="250" class="form-control" style="height: 8em"><?php echo $user->getRestInfo(); ?></textarea>
                </div>

                <div class="form-group">
                  </br>
                  </br>
                  <h6>Что-бы изменить профиль, укажите пароль от Вашей учетной записи.</h6>
                </div>

                <div class="form-group">
                  <label for="pw">*Пароль</label>
                  <input type="password" id="pw" name="password" class="form-control" required>
                </div>

                  <button type="submit" class="btn btn-primary btn-block mt-5">Изменить данные</button>

              </form>
            </div>


          </div>

        </div>
      </div>
</div>

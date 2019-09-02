<div class="card bg-light text-dark shadow-lg">
    <div class="card-body">
      <h4 class="card-title">Информация о пользователе</h4>
      <div class="row">
        <div class="col-md-9">
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <tbody>
                <tr>
                  <td style="width: 40%;"><h5>Имя:</h5></td>
                  <td><?php echo $user->getFirstName(); ?></td>
                </tr>
                <tr>
                  <td><h5>Фамилия:</h5></td>
                  <td><?php echo $user->getLastName(); ?></td>
                </tr>
                <tr>
                  <td><h5>E-Mail:</h5></td>
                  <td><?php echo $user->getEmail(); ?></td>
                </tr>
                <tr>
                  <td><h5>Имя пользователя:</h5></td>
                  <td><?php echo $user->getUsername(); ?></td>
                </tr>
                <tr>
                  <td><h5>Тип пользователя:</h5></td>
                  <td><?php if($user->isAdmin()) {echo "Администратор";} else {echo "Пользователь";} ?></td>
                </tr>
                <tr>
                  <td><h5>Дополнительная информация:</h5></td>
                  <td><?php echo $user->getRestInfo(); ?></td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-3">
          <div>
            <a href="/user/account/users/createsite/<?php echo $user->getUserId(); ?>" class="btn btn-outline-primary btn-block mt-4">Создать сайт</a>
            <a href="/user/account/users/changeprofil/<?php echo $user->getUserId(); ?>" class="btn btn-outline-danger btn-block mt-4">Изменить профиль</a>
            <a href="/user/account/users/changepassword/<?php echo $user->getUserId(); ?>" class="btn btn-outline-danger btn-block mt-4">Изменить пароль</a>

          </div>
        </div>
    </div>
    </div>
</div>

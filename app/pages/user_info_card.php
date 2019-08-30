<div class="card bg-light text-dark shadow-lg">
    <div class="card-body">
      <h4 class="card-title">Информация о пользователе</h4>
      <div class="table-responsive">
        <table class="table table-striped table-bordered" style="width:70%;">
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
</div>

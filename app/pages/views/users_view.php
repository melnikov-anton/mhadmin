<div class="col-md-9 border border-primary p-4 bg-light">
  <div class="card bg-light text-dark shadow-lg">
      <div class="card-body">
        <h4 class="card-title">Список пользователей:</h4>
        <div class="mt-3 mb-3">
          <input class="form-control" id="myInput" type="text" placeholder="Поиск..">
        </div>
        <div class="table-responsive-md">
          <table class="table table-striped table-bordered table-sm">
            <thead class="thead-dark">
              <tr>
                <th style="width: 5%;">ID</th>
                <th style="width: 15%;">Имя</th>
                <th style="width: 20%;">Фамилия</th>
                <th style="width: 15%;">Имя пользователя</th>
                <th style="width: 25%;">Email</th>
                <th style="width: 6%;">Тип</th>
                <th style="width: 9%;">Действие</th>
              </tr>
            </thead>
            <tbody id="myTable">
            <?php foreach ($users_list as $key => $user): ?>
              <tr <?php if($user['usertype'] == 'admin') {echo 'class="table-success"';} ?>>
                <td><?php echo $user['id_user']; ?></td>
                <td><?php echo $user['fname']; ?></td>
                <td><?php echo $user['lname']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['usertype']; ?></td>
                <td><a href="/user/account/users/<?php echo $user['id_user']; ?>" class="btn btn-outline-info btn-sm ml-2">Просмотр</a>
                </td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

  </div>
</div>

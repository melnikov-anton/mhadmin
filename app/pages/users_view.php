<div class="card bg-light text-dark">
    <div class="card-body">
      <h4 class="card-title">Список пользователей</h4>
      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead class="thead-dark">
            <tr>
              <th>ID</th>
              <th>Имя</th>
              <th>Фамилия</th>
              <th>Имя пользователя</th>
              <th>Email</th>
              <th>Тип</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($users_list as $key => $user): ?>
            <tr>
              <td><?php echo $user['id_user']; ?></td>
              <td><?php echo $user['fname']; ?></td>
              <td><?php echo $user['lname']; ?></td>
              <td><?php echo $user['username']; ?></td>
              <td><?php echo $user['email']; ?></td>
              <td><?php echo $user['usertype']; ?></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
</div>

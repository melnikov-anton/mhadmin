<div class="col-md-9 border border-primary p-4 bg-light mh-100">
  <div class="card bg-light text-dark shadow-lg">
      <div class="card-body">
        <h4 class="card-title">Список виртуальных хостов:</h4>
        <div class="mt-3 mb-3">
          <input class="form-control" id="myInput" type="text" placeholder="Поиск..">
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-sm">
            <thead class="thead-dark">
              <tr>
                <th style="width: 5%;">ID</th>
                <th style="width: 30%;">Название</th>
                <th style="width: 10%;">Владелец</th>
                <th style="width: 13%;">Псевдоним</th>
                <th style="width: 12%;">Имя БД</th>
                <th style="width: 15%;">Директория</th>
                <th style="width: 10%;">Действие</th>
              </tr>
            </thead>
            <tbody id="myTable">
            <?php if($sites_list): ?>
            <?php foreach ($sites_list as $key => $site): ?>
              <tr>
                <td><?php echo $site['id_site']; ?></td>
                <td><?php echo $site['title']; ?></td>
                <td>
                  <a href="/user/account/users/<?php echo $site['id_user']; ?>" class="btn btn-outline-info btn-sm ml-2">
                    <?php
                      $us = $dbc->getUserDataById($site['id_user']);
                      echo $us['username'];
                    ?>
                  </a>
                </td>
                <td><?php echo $site['site_name']; ?></td>
                <td><?php echo $site['db_name']; ?></td>
                <td><?php echo $site['site_dir']; ?></td>
                <td><a href="/user/account/sites/<?php echo $site['id_site']; ?>" class="btn btn-outline-info btn-sm ml-2">Просмотр</a>
                </td>
              </tr>
            <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
          </table>
        </div>

      </div>

  </div>
</div>

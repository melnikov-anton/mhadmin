<div class="col-md-9 border border-primary rounded-lg p-4 bg-light mh-100">
  <div class="card bg-light text-dark shadow-lg">
      <div class="card-body">
        <h4 class="card-title">Информация о сайте</h4>
        <div class="row">
          <div class="col-md-9">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                  <tbody>
                    <tr>
                      <td style="width: 30%;"><h5>Название:</h5></td>
                      <td><?php echo $s_info['title']; ?></td>
                    </tr>
                    <tr>
                      <td><h5>Описание:</h5></td>
                      <td><?php echo $s_info['description']; ?></td>
                    </tr>
                    <tr>
                      <td><h5>Владелец:</h5></td>
                      <td>
                        <a href="/user/account/users/<?php echo $s_info['id_user']; ?>" class="btn btn-link">
                          <?php
                            $us = $dbc->getUserDataById($s_info['id_user']);
                            echo $us['username'] . "  (" . $us['fname'] . " " . $us['lname'] . ")";
                          ?>
                        </a>
                      </td>
                    </tr>

                    <tr>
                      <td><h5>Псевдоним сайта:</h5></td>
                      <td><?php echo $s_info['site_name']; ?></td>
                    </tr>

                    <tr>
                      <td><h5>Имя БД:</h5></td>
                      <td><?php echo $s_info['db_name']; ?></td>
                    </tr>
                    <tr>
                      <td><h5>Директория:</h5></td>
                      <td><?php echo $s_info['site_dir']; ?></td>
                    </tr>

                  </tbody>
                </table>
            </div>
          </div>

        <div class="col-md-3">
          <div>
            <a href="/user/account/createdb/<?php echo $s_info['id_site']; ?>/<?php echo $s_info['id_user']; ?>" class="btn btn-outline-primary btn-block mt-4">Создать БД</a>
            <a href="/user/account/changesite/<?php echo $s_info['id_site']; ?>" class="btn btn-outline-danger btn-block mt-4">Изменить сайт</a>
            <a href="/user/account/deletesite/<?php echo $s_info['id_site']; ?>" class="btn btn-outline-danger btn-block mt-4">Удалить сайт</a>
          </div>
        </div>
      </div>


      </div>
  </div>
</div>

<div class="col-md-9 border border-primary rounded-lg p-4 bg-light mh-100">
  <div class="card bg-light text-dark shadow-lg">
      <div class="card-body">
        <h4 class="card-title">Информация о сайте</h4>
        <div class="table-responsive">
            <table class="table table-striped table-bordered" style="width:70%;">
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
  </div>
</div>

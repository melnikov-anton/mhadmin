<div class="col-md-9 border border-primary p-4 bg-light">
    <div class="card bg-light text-dark shadow-lg">
        <div class="card-body">
          <h4 class="card-title">Изменение информация о сайте</h4>

              <div class="row">

                <div class="col-md-6">
                  <div class="table-responsive">
                      <table class="table table-striped table-bordered">
                        <tbody>
                          <tr>
                            <td style="width: 40%;"><h5>Название:</h5></td>
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

                <div class="col-md-5 mx-auto border border-primary rounded-lg p-4 bg-light">
                    <h6>Изменить данные:</h6>
                    <form action="/user/changesite/<?php echo $argv1 ?>" method="post">
                      <label for="tit">Название</label>
                      </br>
                      <input type="text" class="form-control" id="tit" name="title" value="<?php echo $s_info['title']; ?>">
                      </br>

                      <label for="desc">Описание</label>
                      </br>
                      <textarea name="description" id="desc" class="form-control"
                          maxlength="250" style="height: 8em"><?php echo $s_info['description']; ?></textarea>
                      </br>
                      </br>

                      <h6>Что-бы изменить данные сайта укажите пароль от Вашей учетной записи.</h6>
                      <label for="pw">*Пароль</label>

                      <input type="password" id="pw" name="password" class="form-control" required>
                        </br>
                      <input type="submit" class="btn btn-primary btn-block" value="Изменить данные">
                    </form>

                  </div>

              </div>

        </div>
    </div>
</div>

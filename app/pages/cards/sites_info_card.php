<div class="card bg-light text-dark shadow-lg">
    <div class="card-body">
      <h4 class="card-title">Сайты пользователя</h4>

            <div class="table-responsive">
              <table class="table table-striped table-bordered table-sm">
                <thead class="thead-dark">
                  <tr>
                    <th style="width: 35%;">Название</th>
                    <th style="width: 55%;">Описание</th>
                    <th style="width: 10%;">Действие</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($user_sites as $key => $usite): ?>
                  <tr>
                    <td><?php echo $usite['title']; ?></td>
                    <td><?php echo $usite['description']; ?></td>
                    <td><a href="/user/account/sites/<?php echo $usite['id_site']; ?>" class="btn btn-outline-info btn-sm ml-2">Просмотр</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
            </div>

    </div>
</div>

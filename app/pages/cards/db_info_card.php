<?php
  $names = '';
  foreach ($db_names as $db_name) {
    $names = $names . ', ' . $db_name;
  }
  $names = ltrim($names, ', ')
 ?>
<div class="card bg-light text-dark shadow-lg">
    <div class="card-body">
      <h4 class="card-title">Доступ к базе данных</h4>
        <p>Вы имеете доступ к следующим базам данных Ваших сайтов: <b><?php echo $names; ?></b>.</p>
        <p>Для доступа к базам данных сайтов используйте Ваше имя пользователя и пароль от учетной записи.</p>

    </div>
</div>

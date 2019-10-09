
<div class="card bg-light text-dark shadow-lg">
    <div class="card-body">
      <h4 class="card-title">Доступ к базе данных</h4>
        <p>Вы имеете доступ к следующим базам данных Ваших сайтов: <b><?php echo $names; ?></b>.</p>
        <p>Для доступа к базам данных сайтов используйте Ваше имя пользователя и пароль от учетной записи.</p>
        <?php foreach ($table_names as $tables): ?>
          <?php foreach ($tables as $name => $table): ?>
            <?php if($table): ?>
              <p>БД <b><?php echo $name;?></b> содержит следующие таблицы: <b><?php echo $table; ?></b>.</p>
            <?php else: ?>
              <p>БД <b><?php echo $name;?></b> не содержат таблиц.</p>
            <?php endif; ?>
          <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
</div>

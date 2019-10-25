<?php
  $fn = ROOT . DS . 'config' . DS . 'sidemenu.json';
  $mstr = file_get_contents($fn);
  $menu = json_decode($mstr, true);
?>

  <div class="col-md-12 mx-auto">
    <?php foreach ($menu[USER_ROLE] as $key => $val): ?>
      <a href="<?php echo $val; ?>" class="btn btn-primary btn-block"><?php echo $key; ?></a>
    <?php endforeach; ?>
  </div>

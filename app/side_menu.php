<?php
  //$fn = ROOT . DS . 'config' . DS . 'sidemenu.json';
  $fn = '../config/sidemenu.json';
  $mstr = file_get_contents($fn);

  //echo $mstr;
  $menu = json_decode($mstr, true);
  //var_dump($menu);




echo '<div style="width: 300px; border-style: solid;">';

    echo "<ul>";
    foreach ($menu as $key => $val) {
      if(is_array($val)) {
        echo "<li>$key <ul>";
        foreach ($val as $k => $v) {
          echo "<li>$k</li>";
        }
        echo "</ul></li>";
      }else {
        echo "<li> $key </li>";
      }
    }
    echo "</ul>";

echo "</div>";

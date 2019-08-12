<?php
  //$fn = ROOT . DS . 'config' . DS . 'sidemenu.json';
  $fn = '../config/sidemenu.json';
  $mstr = file_get_contents($fn);

  //echo $mstr;
  $menu = json_decode($mstr, true);
  //var_dump($menu);

  $cat = 'Admin';


echo '<div style="background-color: orange; border-radius: 15px; width: 250px; border-style: solid;">';

    echo "<ul>";
    foreach ($menu[$cat] as $key => $val) {
      if(is_array($val)) {
        echo "<li>$key <ul>";
        foreach ($val as $k => $v) {
          echo '<li><a href="' . $v . '">' . $k . '</a></li>';
        }
        echo "</ul></li>";
      }else {
        echo '<li><a href="' . $val . '">' . $key . '</a></li>';
      }
    }
    echo "</ul>";

echo "</div>";

<?php
  $fn = ROOT . DS . 'config' . DS . 'sidemenu.json';
  //$fn = '../../config/sidemenu.json';
  $mstr = file_get_contents($fn);

  //echo $mstr;
  $menu = json_decode($mstr, true);
  //var_dump($menu);

  //$cat = 'Admin';



    echo '<ul class="nav nav-pills nav-justified flex-column">';
    foreach ($menu[$cat] as $key => $val) {
      if(is_array($val)) {
        echo '<li class="nav-link">' . $key . '<ul class="nav nav-pills nav-justified flex-column">';
        foreach ($val as $k => $v) {
          echo '<li class="nav-item m-1">
                  <a class="nav-link active" href="' . $v . '">' . $k . '</a>
                </li>';
        }
        echo "</ul></li>";
      }else {
        echo '<li class="nav-item m-1">
                <a class="nav-link active" href="' . $val . '">' . $key . '</a>
              </li>';
      }
    }
    echo '</ul>';

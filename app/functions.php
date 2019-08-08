<?php

function autoload($className) {
  if(file_exists(ROOT . DS . 'app' . DS . $className . '.php')) {
    require_once(ROOT . DS . 'app' . DS . $className . '.php');
  }
}

spl_autoload_register('autoload');

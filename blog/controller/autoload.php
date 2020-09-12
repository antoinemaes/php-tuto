<?php

function autoload($class){
  $class = str_replace('Antoine\\blog\\', '', $class);
  $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
  require $class.'.php';
}

spl_autoload_register('autoload');

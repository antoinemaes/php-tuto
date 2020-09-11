<?php

function autoload($classname)
{
  if(file_exists(
    $file = 'model/' . $classname . '.php'))
  {
    require $file;
  }
}

spl_autoload_register('autoload');

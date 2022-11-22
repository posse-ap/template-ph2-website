<?php
if (!function_exists('d')) {
  // var_dump改良版
  function d()
  {
    echo '<pre style="background:#fff;color:#333;border:1px solid #ccc;margin:2px;padding:4px;font-family:monospace;font-size:12px">';
    foreach (func_get_args() as $v) {
      // デバッグ用途の関数だが、ローカル環境以外では念のためエスケープ
      // $v = PHP_OS === 'Linux' ? h($v) : $v;
      var_dump($v);
    }
    echo '</pre>';
  }
  
  // var_dump改良版を行った後に終了させる
  function dx()
  {
    $bt = debug_backtrace();
    $file = $bt[0]['file'];
    $line = $bt[0]['line'];
    echo "$file $line\n";
    
    $args = func_get_args();
    call_user_func_array('d', $args);
    exit();
  }
} elseif (function_exists('ddd')) {
  // required Kint
  function dx()
  {
    $args = func_get_args();
    call_user_func_array('ddd', $args);
  }
}
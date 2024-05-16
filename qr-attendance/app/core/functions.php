<?php

function show($stuff)
{
  echo '<pre>';
  print_r($stuff);
  echo '</pre>';
}

function redirect($path) {
  header("Location: " . ROOT . "/" . $path );
}

function get_var($key)
{
  if (isset($_POST[$key])) {
    return $_POST[$key];
  }
}
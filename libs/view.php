<?php
class View {
  public function __construct() {}

  public function render($view, $data = []) {
    $this->data = $data;
    error_log('View::render View');

    require 'views/'.$view.'.php';
  }
}
<?php
class Controller {
  public function __construct() {
    $this->view = new View();
  }

  public function loadModel($model) {
    $fileModel = 'models/'.$model.'.model.php';

    if(file_exists($fileModel)) {
      require_once $fileModel;

      $objectModel = $model.'Model';
      $this->model = new $objectModel(); 
    }
  }

  public function existPOST($params) {
    foreach ($params as $param) {
      if(!isset($_POST[$param])) return false;
    }

    return true;
  }

  public function existGET($params) {
    foreach($params as $param) {
      if(!isset($_GET[$param])) return false;
    }

    return true;
  }

  public function getPost($name) {
    return $_POST[$name];
  }

  public function getGet($name) {
    return $_GET[$name];
  }

  public function redirect($url) {
    header('Location: '. constant('URL') .'/'. $url);
  }
}
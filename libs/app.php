<?php
require_once 'controllers/errors.controller.php';

class App {
  public function __construct() {
    $url = isset($_GET['url']) ? $_GET['url'] : null;
    $url = rtrim($url, '/');
    $url = explode('/', $url);

    if(empty($url[0])) {
      $fileController = 'controllers/login.controller.php';
      require_once $fileController;

      $controller = new Login();
      $controller->loadModel('login');
      $controller->render();
      return;
    }

    $fileController = 'controllers/'.$url[0].'.controller.php';

    if(file_exists($fileController)) {
      require_once $fileController;

      $controller = new $url[0];
      $controller->loadModel($url[0]);

      if(isset($url[1])) {
        if(method_exists($controller, $url[1])) {
          if(isset($url[2])) {
            $numParams = count($url) - 2;
            $params = [];

            for ($i=0; $i < $numParams; $i++) { 
              array_push($params, $url[$i + 2]);
            }

            $controller->{$url[1]}($params);
          } else {
            $controller->{$url[1]}();
          }
        } else {
          // handle new error
          $controller = new Errors();
          $controller->render();
        }
      } else {
        $controller->render();
      }
    } else {
      // handle new Error
      $controller = new Errors();
      $controller->render();
    }
  }
}
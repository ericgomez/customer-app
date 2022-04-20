<?php
class Login extends SessionController {
  public function __construct() {
    parent::__construct();
    $this->view->message = '';
  }

  public function render() {
    $this->view->render('login/index');
  }

  public function authenticate() {
    if(!$this->existPOST(['username', 'password'])) {
      $this->view->message = 'Faltan campos requeridos por enviar';
      $this->render();
      return;
    }

    /*
    login:
      username: eric
      password: 1234
    */

    $username = $this->getPost('username');
    $password = $this->getPost('password');

    if(empty($username) || $username == '' || empty($password) || $password == '' ) {
      $this->view->message = 'Los campos no pueden vacios';
      $this->render();

      return;
    }

    // $user = new LoginModel();
    // $user->setUsername($username);
    // $user->setPassword($password);

    $this->model->setUsername($username);
    $this->model->setPassword($password);

    $res = $this->model->login();
    // $res = $user->login();
    
    if($res != null) {
      $this->initialize($res);
    } else {
      $this->view->message = 'Usuario o contraseña incorrectos';
      $this->render();

      return;
    }
  }
}
<?php
require_once 'classes/session.php';

class SessionController extends Controller {
  private $session;

  public function __construct() {
    parent::__construct();

    $this->init();
  }

  public function init() {
    $this->session = new Session();

    $this->validateSession();
  }

  public function validateSession() {
    $currentURL = $this->getCurrentPage();

    if($this->existsSession()) {
      if($currentURL != 'customer') {
        $this->redirect('customer');
      }
    } else {
      if($currentURL == 'customer') {
        $this->redirect('');
      }
    }
  }

  public function getCurrentPage() {
    $actualLink = trim($_SERVER['REQUEST_URI']);
    $url = explode('/', $actualLink);

    return $url[2];
  }

  public function existsSession() {
    if(!$this->session->exists()) return false;
    if($this->session->getCurrentUser() == null) return false;

    $user = $this->session->getCurrentUser();

    if($user) return true;

    error_log('SessionController::not exists Session');
    return false;
  }

  public function initialize($user) {
    $this->session->setCurrentUser($user['id']);

    error_log('SessionController::initialize');
    $this->redirect('customer');
  }

  public function logout() {
    error_log('SessionController::logout');
    $this->session->closeSession();
  }

}
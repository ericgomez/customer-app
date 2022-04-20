<?php 
class LoginModel extends Model {
  private $username;
  private $password;
  
  public function __construct() {
    parent::__construct();
  }
  
  public function login() {
    try {
      $query = $this->prepare('SELECT * FROM users WHERE username = :username');
      $query->execute([
        'username' => $this->username
      ]);

      if($query->rowCount() == 1) {
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if(password_verify($this->password, $user['password'])) {
          return $user;
        } else {
          return null;
        }
      }
    } catch (PDOException $e) {
      return $e;
    }
  }

  public function setUsername($username) { $this->username = $username; }
  public function setPassword($password) { $this->password = $password; }

  public function getUsername() { return $this->username; }
  public function getPassword() { return $this->password; }
}
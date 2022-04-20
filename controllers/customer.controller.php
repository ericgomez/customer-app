<?php
class Customer extends SessionController {
  public function __construct() {
    parent::__construct();
  }

  public function render() {
    $customer = new CustomerModel();

    $this->view->render('customer/index', ['customers' => $customer->getAll()]);
  }

  public function createCustomer() {
    if(!$this->existPOST(['names', 'lastName', 'lastName2', 'address', 'email'])) {
      echo json_encode([
        'status' => 'error',
        'message' => 'Faltan campos por enviar'
      ]);

      return;
    }

    $names = $this->getPost('names');
    $lastName = $this->getPost('lastName');
    $lastName2 = $this->getPost('lastName2');
    $address = $this->getPost('address');
    $email = $this->getPost('email');

    if(empty($names) || empty($lastName) || empty($lastName2) || empty($address) || empty($email)) {
      echo json_encode([
        'status' => 'error',
        'message' => 'Los campos no pueden estar vacios'
      ]);
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo json_encode([
        'status' => 'error',
        'message' => 'Email invalido'  
      ]);
    }

    $customer = new CustomerModel();
    $customer->setNames($names);
    $customer->setLastName($lastName);
    $customer->setLastName2($lastName2);
    $customer->setAddress($address);
    $customer->setEmail($email);

    $id = $customer->save();

    if($id) {
      echo json_encode([
        'status' => 'success',
        'message' => 'Cliente Creado correctamente',
        'data' => $id
      ]);
    } else {
      echo json_encode([
        'status' => 'error',
        'message' => 'Error al momento de crear al cliente'
      ]);
    }
  }

  public function getCustomerById() {
    if(!$this->existPOST(['id'])) {
      echo json_encode([
        'status' => 'error',
        'message' => 'Faltan campos por enviar'
      ]);
    }

    if(empty($this->getPost('id'))) {
      echo json_encode([
        'status' => 'error',
        'message' => 'El id no puede ser vacio'
      ]);
    }

    $data = [];
    
    $customer = new CustomerModel();
    $customer->setId($this->getPost('id'));
    
    $res = $customer->getById();
    if($res) {
      $data['id'] = $res->getId();
      $data['names'] = $res->getNames();
      $data['lastName'] = $res->getLastName();
      $data['lastName2'] = $res->getLastName2();
      $data['address'] = $res->getAddress();
      $data['email'] = $res->getEmail();

      echo json_encode([
        'status' => 'success',
        'message' => 'Cliente encontrado',
        'data' => $data
      ]);
    } else {
      echo json_encode([
        'status' => 'error',
        'message' => 'Cliente no encontrado',
      ]);
    }


  }

  public function updateCustomer() {
    if(!$this->existPOST(['id', 'names', 'lastName', 'lastName2', 'address', 'email'])) {
      echo json_encode([
        'status' => 'error',
        'message' => 'Faltan campos por enviar'
      ]);
    }

    $id = $this->getPost('id');
    $names = $this->getPost('names');
    $lastName = $this->getPost('lastName');
    $lastName2 = $this->getPost('lastName2');
    $address = $this->getPost('address');
    $email = $this->getPost('email');

    if(empty($id) || empty($names) || empty($lastName) || empty($lastName2) || empty($address) || empty($email)) {
      echo json_encode([
        'status' => 'error',
        'message' => 'Los campos no pueden estar vacios'
      ]);
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo json_encode([
        'status' => 'error',
        'message' => 'Formato de correo invalido'
      ]);
    }

    $customer = new CustomerModel();
    $customer->setId($id);
    $customer->setNames($names);
    $customer->setLastName($lastName);
    $customer->setLastName2($lastName2);
    $customer->setAddress($address);
    $customer->setEmail($email);

    $res = $customer->update();

    if($res) {
      echo json_encode([
        'status' => 'success',
        'message' => 'Cliente actualizo correctamente'
      ]);
    } else {
      echo json_encode([
        'status' => 'error',
        'message' => 'Error al actualizar el cliente'
      ]);
    }

  }

  public function deleteCustomer() {
    if(!$this->existPOST(['id'])) {
      echo json_encode([
        'status' => 'error',
        'message' => 'Faltan campos por enviar'
      ]);
    }

    if(empty($this->getPost('id'))) {
      echo json_encode([
        'status' => 'error',
        'message' => 'El id es requerido'
      ]);
    }

    $customer = new CustomerModel();
    $customer->setId($this->getPost('id'));

    $res = $customer->delete();

    if($res) {
      echo json_encode([
        'status' => 'success',
        'message' => 'Cliente eliminado correctamente'
      ]);
    } else {
      echo json_encode([
        'status' => 'error',
        'message' => 'Error al eliminar el cliente'
      ]);
    }
  }
}
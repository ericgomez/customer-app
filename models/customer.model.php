<?php
class CustomerModel extends Model implements IModel {
  private $id;
  private $names;
  private $lastName;
  private $lastName2;
  private $address;
  private $email;
  
  public function save(){
    try {
      $query = $this->prepare('CALL addCustomer (:names, :lastName, :lastName2, :address, :email)');
      $query->execute([
        'names'      => $this->names,
        'lastName'   => $this->lastName,
        'lastName2'  => $this->lastName2,
        'address'    => $this->address,
        'email'      => $this->email
      ]);

      $id = $query->fetch(PDO::FETCH_ASSOC);

      return $id;
    } catch (PDOException $e) {
      return false;
    }
  }

  public function getAll(){
    try {
      $query = $this->query('SELECT * FROM customers');
      
      $customers = [];
      while($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $customer = new CustomerModel();
        $customer->id        = $row['id'];
        $customer->names     = $row['names'];
        $customer->lastName  = $row['last_name'];
        $customer->lastName2 = $row['last_name2'];
        $customer->address   = $row['address'];
        $customer->email     = $row['email'];

        array_push($customers, $customer);
      }

      return $customers;
    } catch (PDOException $e) {
      return $e;
    }
  }

  public function getById(){
    try {
      $query = $this->prepare('SELECT * FROM customers WHERE id = :id');
      $query->execute([
        'id' => $this->id
      ]);

      if($query->rowCount() == 1) {
        $row = $query->fetch(PDO::FETCH_ASSOC);

        $this->id        = $row['id'];
        $this->names     = $row['names'];
        $this->lastName  = $row['last_name'];
        $this->lastName2 = $row['last_name2'];
        $this->address   = $row['address'];
        $this->email     = $row['email'];

        return $this;
      } else {
        return false;
      }
    } catch (PDOException $e) {
      return $e;
    }
  }
  public function delete(){
    try {
      $query = $this->prepare('DELETE FROM customers WHERE id = :id');
      $query->execute([
        'id' => $this->id
      ]);

      return true;
    } catch (PDOException $e) {
      return false;
    }
  }
  public function update(){
    try {
      $query = $this->prepare('UPDATE customers SET names = :names, last_name = :lastName, last_name2 = :lastName2, address = :address, email = :email WHERE id = :id');
      $query->execute([
        'id'         => $this->id,
        'names'      => $this->names,
        'lastName'   => $this->lastName,
        'lastName2'  => $this->lastName2,
        'address'    => $this->address,
        'email'      => $this->email
      ]);

      return true;
    } catch (PDOException $e) {
      return false;
    }
  }

  public function setId($id) {                $this->id = $id; }
  public function setNames($names) {          $this->names = $names; }
  public function setLastName($lastName) {    $this->lastName = $lastName; }
  public function setLastName2($lastName2) {  $this->lastName2 = $lastName2; }
  public function setAddress($address) {      $this->address = $address; }
  public function setEmail($email) {          $this->email = $email; }

  public function getId() {         return $this->id; }
  public function getNames() {      return $this->names; }
  public function getLastName() {   return $this->lastName; }
  public function getLastName2() {  return $this->lastName2; }
  public function getAddress() {    return $this->address; }
  public function getEmail() {      return $this->email; }
}
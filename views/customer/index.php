<?php
  $customers = $this->data['customers'];
  
  // var_dump($customers);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de Clientes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
</head>
<body>
  <?php require 'header.php' ?>
  <div class="container mt-5">
    <div class="text-center">
      <h1>Lista de Clientes</h1>
    </div>

    <button type="button" class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#addModal">
      Agregar Cliente
    </button>
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Nombres</th>
          <th>Apellido Paterno</th>
          <th>Apellido Materno</th>
          <th>Direccion</th>
          <th>Email</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody id='customer-list'>
        <?php
          foreach($customers as $customer) {
            echo '<tr data-id='.$customer->getId().'>';
            echo '<td>'.$customer->getId().'</td>';
            echo '<td>'.$customer->getNames().'</td>';
            echo '<td>'.$customer->getLastName().'</td>';
            echo '<td>'.$customer->getLastName2().'</td>';
            echo '<td>'.$customer->getAddress().'</td>';
            echo '<td>'.$customer->getEmail().'</td>';
            echo '<td>';
            echo '<button type="button" class="btn btn-link btn-edit" data-bs-toggle="modal" data-bs-target="#editModal">Editar</button>';
            echo '<button type="button" class="btn btn-link text-danger btn-delete" >Eliminar</button>';
            echo '</td>';
            echo '</tr>';
          }
        ?>
      </tbody>
    </table>
  </div>
  
  <!-- Modal Add -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Agregar Cliente</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger d-none"></div>

          <form method="post" id='add-form'>
            <div class="mb-3">
              <label for="names" class="form-label">Nombres</label>
              <input type="text" class="form-control" name="names" id="names" placeholder="Nombres">
            </div>

            <div class="mb-3">
              <label for="lastName" class="form-label">Apellido Paterno</label>
              <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Apellido Paterno">
            </div>

            <div class="mb-3">
              <label for="lastName2" class="form-label">Apellido Materno</label>
              <input type="text" class="form-control" name="lastName2" id="lastName2" placeholder="Apellido Materno">
            </div>

            <div class="mb-3">
              <label for="address" class="form-label">Direccion</label>
              <input type="text" class="form-control" name="address" id="address" placeholder="Direccion">
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Correo</label>
              <input type="text" class="form-control" name="email" id="email" placeholder="Correo">
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Agregar Cliente</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Modal Edit -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar Cliente</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger d-none"></div>

          <form method="post" id='edit-form'>

            <input type="hidden" class="form-control" name="id" id="id">
            
            <div class="mb-3">
              <label for="names" class="form-label">Nombres</label>
              <input type="text" class="form-control" name="names" id="names" placeholder="Nombres">
            </div>

            <div class="mb-3">
              <label for="lastName" class="form-label">Apellido Paterno</label>
              <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Apellido Paterno">
            </div>

            <div class="mb-3">
              <label for="lastName2" class="form-label">Apellido Materno</label>
              <input type="text" class="form-control" name="lastName2" id="lastName2" placeholder="Apellido Materno">
            </div>

            <div class="mb-3">
              <label for="address" class="form-label">Direccion</label>
              <input type="text" class="form-control" name="address" id="address" placeholder="Direccion">
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Correo</label>
              <input type="text" class="form-control" name="email" id="email" placeholder="Correo">
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Editar Cliente</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
  <script src="public/js/customer.js"></script>
</body>
</html>
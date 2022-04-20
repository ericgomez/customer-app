<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Error 404</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
          <div class="col-md-12 text-center">
            <h1 class="error404">404</h1> 
            <p> 
                La pagina que buscas no existe.
                <br />
                <a href="<?= constant('URL') ?>">Regresar a la pagina principal</a>
            </p>   
          </div>
        </div>
    </div>
</body>
</html>
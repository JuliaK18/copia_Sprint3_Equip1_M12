<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body>
<main class="vh-100">
      <div
        class="container-fluid d-flex flex-column align-items-start justify-content-center px-5 h-75">
            <h1 class="mt-5">¡Aún no tienes una cuenta!</h1>

            <form
              id="email-div"
              class=" mt-4 flex-column"
              action="../../PHP/recovery.php"
              method="post"
            >
              <h5>Parece que aún no tienes una cuenta creada. Si deseas crear una, introduce la información necesaria.</h5>
              <br><br>
              <div class="input-group">
                <label for="username" class="col-form-label">Nombre de usuario</label>
                <input
                  type="text"
                  class="form-control w-100"
                  placeholder="Nombre de usuario"
                  name="username"
                  id="username"
                  aria-label="username"
                  aria-describedby="addon-wrapping"
                />
              </div>
              <br>
              <button id="create-account" type="button" name="create" class="btn btn-dark mt-3 w-100">
                Crear cuenta
              </button>
            </form>
      </div>
    </main>

    <script src="script.js"></script>

</body>
</html>
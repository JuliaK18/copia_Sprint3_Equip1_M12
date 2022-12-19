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
<main>
      <div
        class="container-fluid d-flex align-items-start justify-content-start ms-5">
            <h1 class="mt-5">¡Aún no tienes una cuenta!</h1>

            <form
              id="email-div"
              class="input-group form-group mt-4 flex-column"
              action="../../PHP/recovery.php"
              method="post"
            >
              <h5>Parece que aún no tienes una cuenta creada. Si deseas crear una, introduce la información necesaria.</h5>
              <br><br><br>
              <input
                type="text"
                class="form-control w-100"
                placeholder="Nombre de usuario"
                name="username"
                aria-label="username"
                aria-describedby="addon-wrapping"
              />
            </form>
            <button id="ready-button" type="button" name="username-select" class="btn btn-dark mt-3">
              Listo
            </button>
      </div>
    </main>

</body>
</html>
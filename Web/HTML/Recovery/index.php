<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="./recovery.css" />

    <title>Recuperar contraseña</title>
  </head>

  <body>
    <header id="header">
      <div class="d-flex justify-content-end">
        <a href="../Login" target="_blank" class="btn btn-dark mt-3 me-3"
          >Iniciar sesión</a
        >
        <a href="../Register" target="_blank" class="btn btn-dark mt-3 me-3"
          >Registrarse</a
        >
      </div>
    </header>

    <main>
      <div
        class="container-fluid d-flex align-items-start justify-content-start"
        id="container"
      >
        <div class="row">
          <div
            class="col-10 col-sm-10 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
          >
            <div class="h1 mt-5">Recuperar contraseña</div>

            <div
              id="email-div"
              class="input-group form-group mt-4 flex-column"
              action="../../PHP/recovery.php"
              method="post"
            >
              <p>Por favor, introduce el correo electrónico</p>
              <input
                type="email"
                class="form-control w-100"
                placeholder="Email"
                name="email"
                id="email"
                aria-label="Email"
                aria-describedby="addon-wrapping"
              />
              <button id="change-password" type="button" name="forgotPwd" class="btn btn-dark mt-3">Listo</button>
            </div>
          </div>
          <a class="mt-5">Servicio de atención al cliente</a>
        </div>
      </div>
    </main>

    <footer></footer>

    <script src="script.js"></script>
  </body>
</html>

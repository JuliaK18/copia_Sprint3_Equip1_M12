<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="./cssRecovery.css" />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
      crossorigin="anonymous"
    ></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Recuperar contraseña</title>
  </head>

  <body>
    <header>
      <div id="buttons">
        <a href="../Login" target="_blank"
          ><button type="button" class="btn btn-dark mt-3 me-3">Iniciar sesión</button></a
        >
        <a href="../Register" target="_blank">
        <button type="button" class="btn btn-dark mt-3 me-3">Registrarse</button>
      </a>
      </div>
    </header>

    <main>
      <div class="container-fluid ms-5" id="container">
        <div class="row">
          <form
            class="col-10 col-sm-10 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
            action="../../PHP/recovery.php"
            method="post"
          >
            <div class="h1 mt-5">Recuperar contraseña</div>
            <div class="h4 mt-4">Introduce tu nueva contraseña</div>

            <div class="input-group form-group mt-4">
              <input
                type="password"
                class="form-control"
                placeholder="Contraseña"
                aria-label="password"
                name="name"
                aria-describedby="addon-wrapping"
              />
            </div>
            <div class="mt-2">La contraseña debe tener entre 8 y 20 caracteres.</div>
            <div class="h5 mt-4">Repite tu contraseña</div>
            <div class="input-group form-group mt-3">
              <input
                type="password"
                class="form-control"
                placeholder="Contraseña"
                aria-label="password"
                name="confirm_password"
                aria-describedby="addon-wrapping"
              />
            </div>
            <div class="mt-2">La contraseña debe coincidir con la introducida anteriormente.</div>
            <div class="d-flex justify-content-end"><button type="button" class="btn btn-dark mt-3 py-2 px-5" name="resetBtn">Listo</button></div>
</form>
          <a class="mt-5">Servicio de atención al cliente</a>
        </div>
      </div>
    </main>

    <footer></footer>
  </body>
</html>

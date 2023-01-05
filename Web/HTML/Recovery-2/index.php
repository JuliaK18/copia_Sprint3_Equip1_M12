<?php
if (!isset($_GET['hash'])) {
  header('location: ../Login');
}

$hash = $_GET['hash'];
?>
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
    <script src="https://cdn.jsdelivr.net/npm/party-js@latest/bundle/party.min.js"></script>

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
      <div class="container-fluid">
        <div class="row d-flex justify-content-center">
          <div
            class="col-12 col-md-9 col-lg-6 px-4"
          >
            <div class="h1 mt-5">Recuperar contraseña</div>
            <div class="h4 mt-4">Introduce tu nueva contraseña</div>

            <div class="input-group form-group mt-4">
              <input
                type="password"
                class="form-control"
                placeholder="Contraseña"
                aria-label="password"
                name="password"
                id="password"
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
                aria-label="password_verify"
                name="password-verify"
                id="password-verify"
                aria-describedby="addon-wrapping"
              />
            </div>

            <input type="hidden" name="hash" id="hash" value="<?= $hash ?>">
            <div class="mt-2">La contraseña debe coincidir con la introducida anteriormente.</div>
            <button type="button" class="btn btn-dark mt-3 py-2 px-5 w-100" name="resetBtn" id="resetButton">Listo</button>
          </div>
        </div>
      </div>
    </main>

    <div class="button" onmousedown="party.confetti(this)">Click me!</div>

    <footer></footer>

    <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body">
            <h1 class="h4" id="modalLabel">Contraseña cambiada</h1>
            <p class="my-0">Su contraseña se ha cambiado correctamente.</p> 
            <p class="mt-0 mb-3">Ahora se le redirigirá a la página para iniciar sesión.</p>
            <div class="progress" style="height: 5px;">
              <div class="progress-bar" style="transition: none;" role="progressbar" id="progress" aria-valuenow="0" aria-valuemin="0" aria-valuemax="1000"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div style="width: 50px; height: 50px; background: transparent; position:absolute; left:50%; top:30%;" id="party-point">

    </div>


    <script src="script.js"></script>
  </body>
</html>

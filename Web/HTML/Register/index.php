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

    <link rel="stylesheet" href="./signin.css" />

    <title>Sign In</title>
  </head>

  <body>
    <header id="header">
      <div class="d-flex justify-content-end">
        <a href="../Login" target="_blank" class="btn btn-dark mt-3 me-3"
          >Iniciar sesión</a
        >
        <a href="./" class="btn btn-dark mt-3 me-3"
          >Registrarse</a
        >
      </div>
    </header>
    <main class>
      <div
        class="container-fluid d-flex align-items-center justify-content-center"
        id="container"
      >
        <div class="row d-flex justify-content-center">
          <form
            class="col-10 col-sm-10 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
            id="registerForm"
          >
            <div id="logo">
              <img
                src="../icons/logo.png"
                alt=""
                style="height: auto; width: 20%"
              />
            </div>
            <div class="row d-flex justify-content-center pt-3 h1">
              Regístrate a MirMeet
            </div>
            <div
              class="row d-flex justify-content-left pt-4 h6"
              style="padding-left: 12px"
            >
              Nombre de usuario
            </div>
            <div class="input-group form-group pt-1">
              <span class="input-group-text" id="addon-wrapping">
                <i class="fa fa-user"></i>
              </span>
              <input
                type="email"
                class="form-control"
                id="usernameInput"
                placeholder="Nombre de usuario"
                aria-label="Nombre de usuario"
                aria-describedby="addon-wrapping"
              />
            </div>
            <div
              class="row d-flex justify-content-left pt-4 h6"
              style="padding-left: 12px"
            >
              Correo electrónico
            </div>
            <div class="input-group form-group pt-1">
              <span class="input-group-text" id="addon-wrapping">
                <i class="fa fa-envelope"></i>
              </span>
              <input
                type="email"
                class="form-control"
                id="emailInput"
                placeholder="Correo electrónico"
                aria-label="Correo electrónico"
                aria-describedby="addon-wrapping"
              />
            </div>
            
            <div
              class="row d-flex justify-content-left pt-4 h6"
              style="padding-left: 12px"
            >
              Contraseña
            </div>
            <div class="input-group flex-nowrap">
              <span class="input-group-text" id="addon-wrapping">
                <i class="fa fa-lock"></i>
              </span>
              <input
                type="password"
                class="form-control"
                id="passwordInput"
                placeholder="Contraseña"
                aria-label="Contraseña"
                aria-describedby="addon-wrapping"
              />
            </div>
            <div
              class="row d-flex justify-content-left pt-4 h6"
              style="padding-left: 12px"
            >
              Repite tu contraseña
            </div>
            <div class="input-group flex-nowrap">
              <span class="input-group-text" id="addon-wrapping">
                <i class="fa fa-lock"></i>
              </span>
              <input
                type="password"
                class="form-control"
                id="passwordRepeatInput"
                placeholder="Contraseña"
                aria-label="Contraseña"
                aria-describedby="addon-wrapping"
              />
            </div>
            <div
              class="row d-flex justify-content-center pt-1"
              style="padding-left: 12px"
            >
              La contraseña debe tener entre 6 y 50 carácteres.
            </div>
            <div
              class="row d-flex justify-content-center pt-4 h6"
              style="padding-left: 12px"
            >
              <button type="button" id="registerButton" class="btn btn-dark col-3">Registrar</button>
            </div>
          </form>
        </div>
      </div>
    </main>
    <footer></footer>
    <script src="script.js"></script>
    <script src="../Validacions/main.js"></script>
    <script src="../Validacions/validacions.js"></script>
  </body>
</html>

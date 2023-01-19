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

    <title>Revisa el correo</title>
  </head>

  <body>
    <header id="header">
      <div class="d-flex justify-content-end">
        <a href="../Login" target="_blank" class="btn btn-dark mt-3 me-3"
          >Iniciar sesión</a
        >
        <a href="../Register" class="btn btn-dark mt-3 me-3"
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
            
            <div class=" pt-3 h1">
              ¡Un paso más cerca!
            </div>

            <p>Revisa tu correo electrónico, allí encontrarás las instrucciones para continuar.</p>
            
        </div>
      </div>
    </main>
      <!-- Toasts -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
      <div id="errorToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header toast-error">
          <strong class="me-auto">Pymeshield</strong>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="errorToastMessage">
          No cumples los criterios
        </div>
      </div>
    </div>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
      <div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header toast-error">
          <strong class="me-auto">Pymeshield</strong>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="errorToastMessage">
          ¡El usuario se ha creado! Revisa el correo
        </div>
      </div>
    </div>
  </div>
    <footer></footer>
    <script src="script.js"></script>
    <script src="../Validacions/main.js"></script>
    <script src="../Validacions/validacions.js"></script>
  </body>
</html>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="./login.css" />
  <title>Login-Mirmit</title>
</head>

<body>
  <header id="header">
    <div class="d-flex justify-content-end">
      <a href="./" class="btn btn-dark mt-3 me-3">Iniciar sesión</a>
      <a href="../Register" target="_blank" class="btn btn-dark mt-3 me-3">Registrarse</a>
    </div>
  </header>

  <main>
    <div class="container-fluid d-flex align-items-center justify-content-center" id="container">
      <div class="row d-flex justify-content-center">
        <form class="col-10 col-sm-10 col-md-12 col-lg-12 col-xl-12 col-xxl-12" action="../../PHP/login.php" method="post">
          <div id="buttonDiv" onclick="client.requestCode()"></div> 
        
          <div class="tittle">
            <img src="../icons/mirmit.png" alt="" style="height: auto; width: 100%" />
          </div>

          <div class="input-group form-group pt-5">
            <span class="input-group-text" id="addon-wrapping"><i class="fa fa-user"></i></span>
            <input type="text" class="form-control" placeholder="Nombre de usuario" name="username" aria-label="Username" aria-describedby="addon-wrapping" />
          </div>

          <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping"><i class="fa fa-lock"></i></span>
            <input type="password" class="form-control" placeholder="Contraseña" name="password" aria-label="Password" aria-describedby="addon-wrapping" />
          </div>

          <div class="row d-flex justify-content-center pt-3">
            <a href="../Recovery/index.php" class="d-flex justify-content-center text-decoration-underline" id="recovery" target="_blank">Recuperar contraseña</a>
            <button type="submit" class="btn btn-dark" style="width: 55%">
              Iniciar sesión
            </button>
          </div>
        </form>
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
        Los datos introducidos no corresponden a ningún usuario
      </div>
    </div>
  </div>
  </div>

  <footer id="footer"></footer>

  <script src="script.js"></script>
  <script src="https://accounts.google.com/gsi/client" async defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
        function handleCredentialResponse(response) {
          $.ajax({
            url: 'http://localhost:88/PHP/logingoogle.php',
            method: 'POST',
            data: 'token=' + response.credential,
            success: (res) => {
              res = JSON.parse(res)
              if (res.ok) {
                window.location = '../Who'
              }
            }
          })
        }
        window.onload = function () {
          google.accounts.id.initialize({
            client_id: "822015483698-5d28u0rfk1359t6tpn2trni7a9b66u1d.apps.googleusercontent.com",
            callback: handleCredentialResponse
          });
          google.accounts.id.renderButton(
            document.getElementById("buttonDiv"),
            { theme: "outline", size: "large" }  // customization attributes
          );
        }
    </script>
  <?php 
  // Ensenyem els missatges d'error en cas necessari
    if (isset($_GET['error'])) {
      switch ($_GET['error']) {
        case 'empty':
          echo 
            '<script>',
              'id("errorToastMessage").innerText = "Algún campo está vacío";',
              'errorToast.show();',
            '</script>';
          break;
        
        case 'true':
          echo 
            '<script>',
              'id("errorToastMessage").innerText = "El nombre de usuario y/o la contraseña son incorrectos";',
              'errorToast.show();',
            '</script>';
          break;
      }
    }
  ?>
</body>

</html>
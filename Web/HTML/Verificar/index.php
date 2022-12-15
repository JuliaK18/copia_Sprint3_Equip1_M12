<?php
include_once "../../PHP/Classes/Class_Usuaris.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificació</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
<script src="./verificacio.js"></script>

    <!-- Començament del Button trigger modal -->
<div class="container">
      <h2>Llistat usuaris per verificar</h2>
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Verificar
      </button>

   
      <!-- Inici Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Insereix el nom de l'usuari per verificar</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  <!-- Finestra que mostra usuaris que sol·liciten la verificació -->

              <!-- Mostrar usuaris no verificats-->
              <h4>Usuaris no verificats</h4>
              <?php
            $consulta = Usuari::get_users_not_verified2();
            while ($mostrar = mysqli_fetch_array($consulta)) {
            ?>
              <tr>
                <td id="user"><?php echo $mostrar['user'] ?></td>
              </tr>

              <br>
              <br>                      
                    <form method="POST" id="verify" action = "verify.php">
                      <div class="input-group">
                      <?php
                       }
                      ?>
                          <label for="message-text" class="col-form-label">Nom usuari: </label>
                          <input class="form-control" name="user" id="user">
                      </div>
                        </div>
                    </form>    
                   
            </div>
            <div class="modal-footer">
              <button onclick="confirmForm()" type="button" class="btn btn-primary" id ="si">Guardar canvis</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tanca</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Final Modal -->

<br>

    


    
</body>
</html>
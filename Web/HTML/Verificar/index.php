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
              <h5 class="modal-title" id="exampleModalLabel">Sol·licituts per verificar</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  <!-- Finestra que mostra usuaris que sol·liciten la verificació -->
            <?php
                    $verify = Usuari::check_not_verify_user();
         
                  
    
                  
                  '<div class="input-group mb-3">'
                    '<button class="btn btn-outline-secondary" type="button">Button</button>'
                    '<button class="btn btn-outline-secondary" type="button">Button</button>'
                    '<input type="text" class="form-control" placeholder="" aria-label="Example text with two button addons">'
                  '</div>'
                  
                  '<div class="input-group">'
                    '<input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username with two button addons">'
                    '<button class="btn btn-outline-secondary" type="button">Button</button>'
                    '<button class="btn btn-outline-secondary" type="button">Button</button>'
                  '</div>'                    
            ?>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary">Guardar canvis</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tanca</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

<!-- Final Modal -->


    
</body>
</html>
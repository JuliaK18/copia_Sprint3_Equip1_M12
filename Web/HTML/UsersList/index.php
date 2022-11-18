<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MirMeet</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>

<body class="w-100">
    <h1 class="text-center m-3">Listado de usuarios</h1>
    <?php
        include_once '../../PHP/Classes/Class_Usuaris.php';

        $data = Usuari::get_users_not_verified();

        if ($data) {
            echo 
                '<div class="container">',
                    '<table class="table table-responsive table-striped align-middle ">',
                        '<thead>',
                            '<tr>',
                                '<th scope="col">Username</th>',
                                '<th scope="col" class="d-none d-sm-table-cell">Email</th>',
                                '<th scope="col" class="text-end">Options</th>',
                            '</tr>',
                        '</thead>',
                        '<tbody>';

            foreach ($data as $key => $user) {
                echo 
                    '<tr>',
                        '<td>' . $user['NomUsuari'] . '</td>',
                        '<td class="d-none d-sm-table-cell">' . $user['CorreuElectronic'] . '</td>',
                        '<td class="text-end">',
                            '<button class="btn" onclick="accept('. $user['Id'] . ')">',
                                '<i class="fa fa-check"></i>',
                            '</button>',
                            '<button class="btn" onclick="discard('. $user['Id'] . ')">',
                                '<i class="fa fa-xmark"></i>',
                            '</button>',
                        '</td>',
                    '</tr>';
            }

            echo 
                    '</tbody>',
                '</table>',
            '</div>';

        } else {
            echo '<h6 class="text-center">There\'s no users to verify!</h6>';
        }
        
    ?>

    <!-- Toasts -->
  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header toast-success">
        <strong class="me-auto">MirMeet</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body" id="successToastMessage">
        User verificated
      </div>
    </div>
  </div>

  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="errorToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header toast-error">
        <strong class="me-auto">MirMeet</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body" id="errorToastMessage">
        Something went wrong
      </div>
    </div>
  </div>

    <script src="script.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.21.2/dist/bootstrap-table.min.css">
</head>
<body>
    
    <table
    id="table"
    data-toggle="table"
    data-url="../../PHP/listusr.php">
        <thead>
            <tr>
            <th data-field="state" data-checkbox="true"></th>
            <th data-field="NomUsuari">Nom Usuari</th>
            <th data-field="Verificat"> Verificat</th>
            <th data-field="Acceptat"> Acceptat</th>
            <th data-formatter="boto"> Opcions</th>


            </tr>
        </thead>

    </table>

    <script>
            function boto(value, row, index){
                if(row['Verificat'] == 0){
                return[
                    '<button onclick="verificar('+ row['Id']+ ')"> Verificar </button>'
                ].join('')

            }else
                return[
                    '<button onclick="desverificar('+ row['Id']+ ')"> Desverificar </button>'
                ].join('')
        }

            function verificar(id){
                $.ajax({
                    url: 'http://localhost:88/PHP/verify.php',
                    method: 'POST',
                    data: {
                        id: id
                    },
                    success: function(result) {
                        console.log('OK')
                        $('#table').bootstrapTable('refresh')
                    }

                })
            }
            
                function desverificar(id){
                $.ajax({
                    url: 'http://localhost:88/PHP/desverify.php',
                    method: 'POST',
                    data: {
                        id: id
                    },
                    success: function(result) {
                        console.log('Oki')
                        $('#table').bootstrapTable('refresh')
                    }

                })
            }
        

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.21.2/dist/bootstrap-table.min.js"></script>
</body>
</html>
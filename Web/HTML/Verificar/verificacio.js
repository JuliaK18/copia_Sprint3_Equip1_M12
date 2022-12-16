//Confirmació per poder assegurar-nos si volem verificar a l'usuari mencionat 
document.getElementById("si").onclick = confirmForm;

function confirmForm(){
    if(confirm('Estàs segur de validar aquest usuari?')){
        return boolean;
    }     
}

// CapacityWindow.document.open("text/html");
// CapacityWindow.document.write(s);
// CapacityWindow.document.close();

// //Començament ajax
// $.ajax({
//     url: 'index.php',  // L'arxiu PHP on es troba el mètode
//     type: 'POST',  // El tipus de solicitut que s'està enviant (POST, GET, etc.)
//     data: { method: 'check_verify_user' }  // Les dades que s'están enviant l'arxiu PHP (amb el nom del mètode)
//     success:function(resultat){
//         console.log(result.prova);
//     }
//   });
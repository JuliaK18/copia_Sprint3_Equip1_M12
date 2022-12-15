

$.ajax({
    url: 'index.php',  // L'arxiu PHP on es troba el mètode
    type: 'POST',  // El tipus de solicitut que s'està enviant (POST, GET, etc.)
    data: { method: 'check_verify_user' }  // Les dades que s'están enviant l'arxiu PHP (amb el nom del mètode)
  })
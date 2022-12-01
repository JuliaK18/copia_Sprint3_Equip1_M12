<?php
include_once "../Classes/Class_Usuaris.php";
//Consultar persones NO verificades
$llistatCursos = Curs::(1);


foreach ($llistatCursos as $curs) {
   //echo  "<strong>  $curs[name] </strong>";
   echo " 
   <div class='accordion-item'>
    <h2 class='accordion-header' id='heading$curs[id]'>
      <button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#collapse$curs[id]' aria-expanded='true' aria-controls='collapse$curs[id]'>
        $curs[name] $curs[id]
      </button>
    </h2>
    <div id='collapse$curs[id]' class='accordion-collapse collapse show' aria-labelledby='heading$curs[id]' data-bs-parent='#accordionExample'>
      <div class='accordion-body'>

      </div>
    </div>
  </div>
   ";
}
?>
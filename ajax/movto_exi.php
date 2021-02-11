<?php
     $nom = '';
     $ord = '';
     $tab = array();
     session_start();
     $tab['men'] = '';
     $tab['qtd'] = 0;
     include_once "../dados.php";
     include_once "../profsa.php";
     date_default_timezone_set("America/Sao_Paulo");
     if (isset($_REQUEST['ord']) == true) { $ord = $_REQUEST['ord']; }
     if (isset($_REQUEST['nom']) == true) { $nom = $_REQUEST['nom']; }
     if ($ord == 4) {
          $nro = acessa_reg("Select Count(*) as qtde from tb_movto_id where infarquivo = '" . $nom . "'", $reg);            
          if ($nro == 1) {
               $tab['qtd'] = $reg['qtde']; 
               $_SESSION['wrkqtdreg'] = $reg['qtde']; 
          }
     }
     $tab['ord'] = $ord;
     echo json_encode($tab);     

?>
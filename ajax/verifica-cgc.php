<?php
     $cgc = '';
     $tab = array();
     session_start();
     $tab['men'] = 'Número do Cnpj informado não existe cadastrado no sistema';
     $tab['nom'] = '';
     $_SESSION['wrknomfun'] = "";      
     include_once "../dados.php";
     include_once "../profsa.php";
     date_default_timezone_set("America/Sao_Paulo");
     if (isset($_REQUEST['cgc']) == true) { $cgc = $_REQUEST['cgc']; }
     $nro = acessa_reg("Select idfundo, funnome from tb_fundos where funcnpj = '" . limpa_nro($cgc) . "'", $reg);            
     if ($nro == 1) {
          $tab['men'] = ""; 
          $tab['nom'] = utf8_encode($reg['funnome']); 
          $_SESSION['wrknomfun'] = $reg['funnome']; 
     }

     echo json_encode($tab);     

?>
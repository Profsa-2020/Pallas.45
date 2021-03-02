<?php
     $cgc = '';
     $tab = array();
     session_start();
     $tab['qtd'] = 0;
     $tab['men'] = '';
     include_once "../dados.php";
     include_once "../profsa.php";
     date_default_timezone_set("America/Sao_Paulo");
     if (isset($_REQUEST['nom']) == true) { $nom = $_REQUEST['nom']; }
     if (isset($_REQUEST['cgc']) == true) { $cgc = limpa_nro($_REQUEST['cgc']); }
     $nro = acessa_reg("Select idfundo, funcnpj, funnome from tb_fundos where funcnpj = '" . limpa_nro($cgc) . "'", $reg);            
     if ($nro == 0) {
          $tab['men'] = "Número do Cnpj informado não está cadastrado no sistema"; 
     } else {
          $_SESSION['wrklisfun'][$cgc]['cha'] = $reg['idfundo']; 
          $_SESSION['wrklisfun'][$cgc]['cgc'] = $reg['funcnpj']; 
          $_SESSION['wrklisfun'][$cgc]['nom'] = $reg['funnome']; 
     }
     foreach($_SESSION['wrklisfun'] as $cpo => $dad ) {
          $tab['qtd'] = $tab['qtd'] + 1;
     }

     echo json_encode($tab);     

?>
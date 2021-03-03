<?php   
     $nom = "";
     $tab_w = array();
     include_once "../dados.php";
     include_once "../profsa.php";
     if (isset($_REQUEST['term']) == true) { $nom = $_REQUEST['term']; }    // term é o nome fixo
     if (strlen($nom) >= 7) { 
          $com = "Select idfundo, funnome, funcnpj from tb_fundos where funnome like '%" . $nom . "%' order by funnome Limit 25";
          $nro = leitura_reg($com, $reg);
          foreach ($reg as $lin) {
               $tab_w[] = array ("label" => limpa_cpo(utf8_encode(trim($lin['funnome']))), "id" => $lin['idfundo'], "cnpj" => mascara_cpo($lin['funcnpj'], "  .   .   /    -  "));   
          }
     }
     echo json_encode($tab_w);     
?>    

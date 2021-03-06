<?php
     $cgc = '';
     $tab = array();
     session_start();
     $tab['men'] = '';
     $tab['txt'] = '';
     include_once "../dados.php";
     include_once "../profsa.php";
     date_default_timezone_set("America/Sao_Paulo");
     if (isset($_REQUEST['cgc']) == true) { $cgc = $_REQUEST['cgc']; }
     $nro = acessa_reg("Select * from tb_fundos where funcnpj = '" . limpa_nro($cgc) . "'", $reg);            
     if ($nro == 0) {
          $tab['men'] = "Número do Cnpj informado não encontrado no sistema"; 
     } else {
          $ret = patrimonio_liq($reg['idfundo'], $dat, $val);
          $tab['txt'] .= "<strong>";
          $tab['txt'] .= "Nome do Fundo: " . utf8_encode($reg['funnome']) . "<br />";
          $tab['txt'] .= "Número do C.n.p.j.: " . mascara_cpo($reg['funcnpj'], "  .   .   /    -  ") . "<br />";
          $tab['txt'] .= "</strong>";
          $tab['txt'] .= 'Data de Cadastro: ' . date('d/m/Y',strtotime($reg['fundatacomp'])) . ' ('  . calcula_idade($reg['fundatacomp']) . ' anos)' . '<br />' ;
          if ($reg['fundatainic'] == null) {
               $tab['txt'] .= "Data de Início: **/**/****" . "<br />"; 
          } else {
               $tab['txt'] .= 'Data de Início: ' . date('d/m/Y',strtotime($reg['fundatainic'])) . ' ('  . calcula_idade($reg['fundatacomp']) . ' anos)' . '<br />' ;
          }
          if ($reg['funstatus'] == 0) {$tab['txt'] .= "Status: Normal" . "<br />";}  
          if ($reg['funstatus'] == 1) {$tab['txt'] .= "Status: Cancelado" . "<br />";}    
          if ($reg['funstatus'] == 2) {$tab['txt'] .= "Status: Bloqueado" . "<br />";}  
          if ($reg['funstatus'] == 3) {$tab['txt'] .= "Status: Exclusivo" . "<br />";}  
          if ($reg['funclasse'] == "0") { $tab['txt'] .= 'Classe: Indefinida' . "<br />"; }
          if ($reg['funclasse'] == "1") { $tab['txt'] .= 'Classe: Fundo Cambial' . "<br />"; }
          if ($reg['funclasse'] == "2") { $tab['txt'] .= 'Classe: Fundo da Dívida Externa' . "<br />"; }
          if ($reg['funclasse'] == "3") { $tab['txt'] .= 'Classe: Fundo de Ações' . "<br />"; }
          if ($reg['funclasse'] == "4") { $tab['txt'] .= 'Classe: Fundo de Curto Prazo' . "<br />"; }
          if ($reg['funclasse'] == "5") { $tab['txt'] .= 'Classe: Fundo de Renda Fixa' . "<br />"; }
          if ($reg['funclasse'] == "6") { $tab['txt'] .= 'Classe: Fundo Multimercado' . "<br />"; }
          if ($reg['funclasse'] == "7") { $tab['txt'] .= 'Classe: Fundo Referenciado' . "<br />"; }
          if ($reg['funclaambima'] == "A") {$tab['txt'] .= 'Classe Anbima: Açoes' . "<br />";}  
          if ($reg['funclaambima'] == "C") {$tab['txt'] .= 'Classe Anbima: Cambial' . "<br />";}  
          if ($reg['funclaambima'] == "M") {$tab['txt'] .= 'Classe Anbima: Multimercado' . "<br />";}  
          if ($reg['funclaambima'] == "R") {$tab['txt'] .= 'Classe Anbima: Renda Fixa' . "<br />";}  
          if ($reg['funclaambima'] == "P") {$tab['txt'] .= 'Classe Anbima: Previdência' . "<br />";}  
          if ($reg['funclaambima'] == "F") {$tab['txt'] .= 'Classe Anbima: Fundo Cambial' . "<br />";}  
          if ($reg['funpubalvo'] == "") { $tab['txt'] .= 'Público: *****' . "<br />";}  
          if ($reg['funpubalvo'] == "A") { $tab['txt'] .= 'Público: Profissionais' . "<br />";}  
          if ($reg['funpubalvo'] == "B") { $tab['txt'] .= 'Público: Qualificados' . "<br />";}  
          if ($reg['funpubalvo'] == "C") { $tab['txt'] .= 'Público: Previdenciário' . "<br />";}  
          if ($reg['funpubalvo'] == "D") { $tab['txt'] .= 'Público: Geral' . "<br />";}  
          $tab['txt'] .= 'Espelho: ' . ($reg['funespelho'] == "N" ? 'Não' : 'Sim' ) . "<br />";
          $tab['txt'] .= 'Condomínio: ' . ($reg['funcondominio'] == "A" ? 'Aberto' : 'Fechado' ) . "<br />";
          $tab['txt'] .= 'Aplicação Mínima: ' . number_format($reg['funaplminima'], 2, ",", ".") . '<br />';
          $tab['txt'] .= 'Fundo de Cotas:  ' . ($reg['funcotas'] == 'N' ? 'Não' : 'Sim') . " <br />";
          $tab['txt'] .= 'Cota Diária: ' . ($reg['funatuadiaria'] == 'N' ? 'Não' : 'Sim') . " <br />";
          $tab['txt'] .= 'Exclusivo: ' . ($reg['funexclusivo'] == 0 ? 'Não' : 'Sim') . "<br />";
          $tab['txt'] .= 'Funcionamento Normal: ' . ($reg['funnormal'] == 1 ? 'Não' : 'Sim') . "<br />";
          $tab['txt'] .= 'Patrimônio Liquido: R$ ' . number_format($val, 2, ",", ".") . ' - ' . $dat. '<br />';
     } 

     echo json_encode($tab);     


     function patrimonio_liq($cod, &$dat, &$val) {
          $ret = 0; $dat = '**/**/****'; $val = 0;
          $com = "Select infdata, infpatrimonio from tb_movto_id where idfundo = " . $cod . " order by infdata";
          $nro = leitura_reg($com, $reg);
          foreach ($reg as $lin) {
               $val = $lin['infpatrimonio'];
               $dat = date('d/m/Y',strtotime($lin['infdata']));
          }
          return $ret;
     }

?>
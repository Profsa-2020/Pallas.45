<?php
     $arq = 0;
     $reg = 0;
     session_start();
     $dir = __DIR__;
     $tab = array();
     $tab['men'] = '';
     $tab['pro'] = 0;
     $tab['gra'] = 0;
     include_once "../dados.php";
     include_once "../profsa.php";
     $max = ini_get('upload_max_filesize');
     $_SESSION['wrknumusu'] = getmypid();
     date_default_timezone_set("America/Sao_Paulo");
     if (isset($_REQUEST['arq']) == true) { $arq = $_REQUEST['arq']; }
     if (isset($_REQUEST['reg']) == true) { $reg = $_REQUEST['reg']; }
     if (isset($_FILES) == false) {
          $tab['men'] = 'Não há arquivos para serem efetuado upload de dados';
     } else {
          $ret = upload_csv($_SESSION['wrknumusu'], $_FILES, $arq, $cam, $nom, $des, $tip, $ext, $tam, $men);
          $tab['men'] = $men;
          if ($men == "") {
               $qtd = verifica_csv($cam, $nom, $arq, $reg, $con);
               if ($qtd != 0) {
                    $tab['men'] = "Arquivo fornecido para UpLoad tem colunas incorretas -> 116";
               } else {
                    if ($arq == 1) {
                         $ret = processa_fun($cam, $nom, $des, $arq, $pro, $gra, $men, $com);
                         $tab['pro'] = $pro;
                         $tab['gra'] = $gra;
                    }
               }
          }
     }

     echo json_encode($tab);     



     function upload_csv ($nro, $fil , $ord, &$cam, &$nom, &$des, &$tip, &$ext, &$tam, &$men) {
          $sta = 0; $des = ""; $tam = 0; $men = ""; $cam = ""; $nom = ""; $arq = false;
          $arq = (isset($fil['arq-up']) ? $fil['arq-up'] : false); 
          if ($arq == false) {
               $men = "Não há arquivo informado para ser efetuado o UpLoad no sistema";
               return 1;
          } else if ($arq['name'] == "") {
               $men = "Nome do arquivo informado para UpLoad etá em branco";
               return 2;
          }            
          $erro[0] = 'Não houve erro encontrado no Upload do arquivo';
          $erro[1] = 'O arquivo informado no upload é maior do que o limite da plataforma';
          $erro[2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
          $erro[3] = 'O upload do arquivo foi feito parcialmente, tente novamente';
          $erro[4] = 'Não foi feito o upload do arquivo corretamente !';
          $erro[5] = 'Não foi feito o upload do arquivo corretamente !!';
          $erro[6] = 'Pasta temporária ausente para Upload do arquivo informado';
          $erro[7] = 'Falha em escrever o arquivo para upload informado em disco';
          if ($arq['error'] != 0) {
               $men = $erro[$arq['error']];
               return 3; 
          }
          if ($sta == 0) {
               $tip = array('csv', 'CSV');
               $nom = $arq['name'];
               $des = limpa_cpo($arq['name']);
               $tam = $arq['size'];
               $fim = explode('.', $des);
               $ext = end($fim);
               if (array_search($ext, $tip) === false) {
                    $men = 'Extensão de arquivo informado deve ser somente .csv';
                    $sta = 4; 
               }
          }
          if ($sta == 0) {
               $tip = explode('.', $des);
               $des = $tip[0] . "." . $ext;
               $pas = "../upload"; 
               if (file_exists($pas) == false) { mkdir($pas);  }
               $nom = 'Csv_' . str_pad($nro, 6, "0", STR_PAD_LEFT) . "_" . str_pad($ord, 3, "0", STR_PAD_LEFT) . "." . $ext; 
               $cam = $pas . "/" . 'Csv_' . str_pad($nro, 6, "0", STR_PAD_LEFT) . "_" . str_pad($ord, 3, "0", STR_PAD_LEFT) . "." . $ext; 
               $ret = move_uploaded_file($arq['tmp_name'], $cam);
               if ($ret == false) {
                    $men = 'Erro na cópia do arquivo informado para upload';
                    $sta = 5; 
               } else {
                    $sta = gravar_log(25, "UpLoad de arquivo - Nom: " . $nom . " Tam: " . $tam . " Cam: " . $cam . " Des: " . $des);
               }      
          }    
          return $sta;
     }

     function verifica_csv ($cam, $nom, $ord, $reg,  &$con) {
          $con = 0;
          include_once "../dados.php";
          $csv = fopen($cam, "r");  
          while (!feof ($csv)) {
               $lin = explode(";", fgets($csv));
               if ($ord == 1) {
                    if (count($lin) != 1 && count($lin) != 116) {
                         $con = $con + 1;          
                    }
               }
          } 
          fclose($csv);     
          return $con; 
     }

     function processa_fun ($cam, $nom, $des, $ord, &$pro, &$gra, &$men, &$com) {
          $ret = 0; 
          $pro = 0; 
          $gra = 0; 
          $men = ''; $com = '';
          include_once "../dados.php";
          $csv = fopen($cam, "r");  
          while (!feof ($csv)) {
               $lin = explode(";", fgets($csv));
               $nro = acessa_reg("Select idfundo from tb_fundos where funcnpj = '" . limpa_nro($lin[0]) . "'", $reg);            
               if ($nro == 0 &&  limpa_nro($lin[0]) != "0") {
                    $sql  = "insert into tb_fundos (";
                    $sql .= "funcnpj, ";
                    $sql .= "funnome, ";
                    $sql .= "fundatacomp, ";
                    $sql .= "funcondominio, ";
                    $sql .= "funnegmercado, ";
                    $sql .= "funpubalvo, ";
                    $sql .= "funcotas, ";
                    $sql .= "funespelho, ";
                    $sql .= "funclaambima, ";
                    $sql .= "funaplminima, ";
                    $sql .= "funatuadiaria, ";
                    $sql .= "funupload, ";
                    $sql .= "funarquivo, ";
                    $sql .= "funordem, ";
                    $sql .= "funsequencia, ";
                    $sql .= "funprocesso, ";
                    $sql .= "keyinc, ";
                    $sql .= "datinc ";
                    $sql .= ") value ( ";
                    $sql .= "'" . limpa_nro($lin[0]) . "',";
                    $sql .= "'" . utf8_encode(str_replace("'", "´", substr($lin[1], 0, 75))) . "',";
                    if (substr($lin[2], 4, 1) == "-" || substr($lin[2], 4, 1) == "/") {
                         $sql .= "'" . $lin[2] . "',";
                    } else {
                         $sql .= "'" . inverte_dat(1, $lin[2]) . "',";
                    }
                    $sql .= "'" . substr($lin[3], 0, 1) . "',";  // Coluna D
                    $sql .= "'" . substr($lin[5], 0, 1) . "',";  // Coluna F
                    $sql .= "'" . substr($lin[8], 0, 1) . "',";  // Coluna I
                    $sql .= "'" . substr($lin[15], 0, 1) . "',";  // Coluna P
                    $sql .= "'" . substr($lin[16], 0, 1) . "',";  // Coluna Q
                    $sql .= "'" . substr($lin[10], 0, 1) . "',";  // Coluna K
                    $sql .= "'" . $lin[17] . "',";  // Coluna R R$ - Aplicação Mínima
                    $sql .= "'" . substr($lin[18], 0, 1) . "',";  // Coluna S - Atualização Diária
                    $sql .= "'" . $nom . "',";  
                    $sql .= "'" . $des . "',";  
                    $sql .= "'" . $ord . "',";  
                    $sql .= "'" . $pro . "',";  
                    $sql .= "'" .  $_SESSION['wrknumusu'] . "',";  
                    $sql .= "'" . $_SESSION['wrkideusu'] . "',";
                    $sql .= "'" . date("Y-m-d H:i:s") . "')";
                    $ret = comando_tab($sql, $nro, $cha, $men);
                    if ($ret == false) {
                         $com = $sql;
                         $men = "Erro na gravação do registro solicitado no banco de dados !";
                    }               
                    $gra = $gra + 1;
               } 
               $pro = $pro + 1;
          } 
          fclose($csv);     
          return $ret; 
     }
?>

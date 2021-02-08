<?php
     $arq = 0;
     $reg = 0;
     session_start();
     $dir = __DIR__;
     $tab = array();
     $tab['men'] = '';
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
          $ret = upload_csv($_SESSION['wrknumusu'], $_FILES, $arq, $cam, $tip, $ext, $tam, $men);
          $tab['men'] = $men;
          if ($men == "") {
               $qtd = verifica_csv($cam, $arq, $reg, $con);

          }
     }

     echo json_encode($tab);     



     function upload_csv ($nro, $fil , $ord, &$cam, &$tip, &$ext, &$tam, &$men) {
          $sta = 0; $des = null; $tam = 0; $men = ""; $arq = false;
          $arq = (isset($fil['arq-up']) ? $fil['arq-up'] : false); 
          if ($arq == false) {
               return 1;
          } else if ($arq['name'] == "") {
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

     function verifica_csv ($cam, $ord, $reg,  &$con) {
          $con = 0;
          include_once "../dados.php";
          $csv = fopen($cam, "r");  
          while (!feof ($csv)) {
               $lin = explode(";", fgets($csv));
               if ($ord == 1) {
                    if (count($lin) != 1 || count($lin) != 116) {
                         $con = $con + 1;          
                    }
               }
          } 
          fclose($csv);     
          return $con; 
     }
?>

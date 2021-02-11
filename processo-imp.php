<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt_br">

<head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
     <meta name="description" content="Profsa Informática - UpLoad de dados e Análise de Investimentos" />
     <meta name="author" content="Paulo Rogério Souza" />
     <meta name="viewport" content="width=device-width, initial-scale=1" />

     <link href="https://fonts.googleapis.com/css?family=Lato:300,400" rel="stylesheet" type="text/css" />
     <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" type="text/css" />

     <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css">

     <link rel="icon" href="https://moneyway.com.br/wp-content/uploads/2020/11/cropped-money-way-favicon-32x32.png"
          sizes="32x32" />
     <link rel="icon" href="https://moneyway.com.br/wp-content/uploads/2020/11/cropped-money-way-favicon-192x192.png"
          sizes="192x192" />
     <link rel="apple-touch-icon"
          href="https://moneyway.com.br/wp-content/uploads/2020/11/cropped-money-way-favicon-180x180.png" />
     <meta name="msapplication-TileImage"
          content="https://moneyway.com.br/wp-content/uploads/2020/11/cropped-money-way-favicon-270x270.png" />

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
          integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
     </script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
          integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
     </script>

     <link href="css/pallas45.css" rel="stylesheet" type="text/css" media="screen" />
     <title>Importações - Análise de Investimentos - Profsa Informátda Ltda</title>
</head>

<script>
$(document).ready(function() {
     $('.alert').alert();
     $('.alert').delay(2500).fadeOut(2500);

     $('#upload').bind("click", function() {
          let arq = $('#arq').val();
          if (arq == 0) {
               alert("Não foi informada uma opção de arquivo para efetuar UpLoad");
          } else {
               $('#arq-up').click();
          }
     });

     $('#arq-up').change(function() {
          $('#inf_1').text('');
          $('#qtd_m').val(0);
          var ord = $('#arq').val();
          var arqu = $(this)[0].files[0].name;
          var data = $(this)[0].files[0].lastModifiedDate;
          data = ((data.getDate())) + "/" + ((data.getMonth() + 1)) + "/" + data.getFullYear();
          tam = $(this)[0].files[0]['size'] / 1024;
          var max = parseInt($('#tam_m').val().replace(/[^0-9]/g, ''), 10) * 1024;
          $('#max_a').text('Tamanho Máximo: ' + max + ' kb');
          $('#tam_a').text('Tamanho do Arquivo: ' + tam.toFixed(0) + ' kb');
          if (tam >= max) {
               $('#sta_a').val(0);
               alert("Arquivo a ser feito UpLoad (" + Math.round(tam, 0) +
                    "kb) é maior que o permitido");
          } else {
               $('#sta_a').val(1);
               $('#nom_a').text('Nome do Arquivo: ' + arqu);
               $('#dat_a').text('Data do Arquivo: ' + data);

               var fileReader = new FileReader();
               fileReader.onload = function() {
                    const lines = fileReader.result.split('\n').map(function(line) {
                         return line.split(';');
                    })
                    $('#reg_a').val(lines.length - 2);
                    $('#lin_a').text('Número de Linhas: ' + (lines.length - 2) + ' linhas');
               }
               fileReader.readAsText($(this)[0].files[0]);

               $.getJSON("ajax/movto_exi.php", { nom: arqu, ord: ord })
                    .done(function(data) {
                    if (data.men != "") {
                         alert(data.men);
                    } else {
                         if (data.qtd > 0 && data.ord == 4) {    // 4 - arquivo de movimento
                              ('#qtd_m').val(data.qtd);
                              alert('Há [' + data.qtd + '] registros no movimento para este arquivo, será excluído !');
                         }
                    }
               }).fail(function(data){
                    console.log('Erro: ' + JSON.stringify(data)); 
                    alert("Erro ocorrido no processamento da verificação de movto");
               });

          }
     });

     $(window).scroll(function() {
          if ($(this).scrollTop() > 100) {
               $(".subir").fadeIn(500);
          } else {
               $(".subir").fadeOut(250);
          }
     });

     $(".subir").click(function() {
          $topo = $("#box00").offset().top;
          $('html, body').animate({
               scrollTop: $topo
          }, 1500);
     });

});
</script>

<?php 
     $pro = 0;
     $gra = 0;
     include_once "dados.php";
     include_once "profsa.php";
     $_SESSION['wrknompro'] = __FILE__;
     date_default_timezone_set("America/Sao_Paulo");
     $_SESSION['wrkdatide'] = date ("d/m/Y H:i:s", getlastmod());
     $_SESSION['wrknomide'] = get_current_user();
     $_SESSION['wrknumusu'] = getmypid();
     if (isset($_SERVER['HTTP_REFERER']) == true) {
          if (limpa_pro($_SESSION['wrknompro']) != limpa_pro($_SERVER['HTTP_REFERER'])) {
               $_SESSION['wrkproant'] = limpa_pro($_SERVER['HTTP_REFERER']);
               $ret = gravar_log(6, "Entrada na página de UpLoad de arquivos .Csv Pallas.45 - MoneyWay");  
          }
     }
     if (isset($_SESSION['wrkqtdreg']) == false) { $_SESSION['wrkqtdreg'] = 0; }
     ini_set('max_execution_time', 300);       
     $max = ini_get('upload_max_filesize');
     if (isset($_REQUEST['processa']) == true) {
          $arq = (isset($_REQUEST['arq']) == false ? 0 : $_REQUEST['arq']);
          $ret = upload_csv($_SESSION['wrknumusu'], $_FILES, $arq, $cam, $nom, $des, $tip, $ext, $tam, $men);
          if ($men != "") {
               echo '<script>alert("' . $men . '");</script>';
          } else {
               $qtd = verifica_csv($cam, $nom, $arq, $con);
               if ($qtd == 999999) {
                    echo '<script>alert("Arquivo informado para UpLoad não possue quebra de linhas");</script>';
               } else if ($qtd != 0) {
                    if ($arq == 1) {
                         echo '<script>alert("Arquivo fornecido para UpLoad tem colunas incorretas -> 116");</script>';
                    }
                    if ($arq == 2) {
                         echo '<script>alert("Arquivo fornecido para UpLoad tem colunas incorretas -> 5");</script>';
                    }
                    if ($arq == 3) {
                         echo '<script>alert("Arquivo informado para UpLoad tem colunas incorretas -> 5");</script>';
                    }
                    if ($arq == 4) {
                         echo '<script>alert("Arquivo fornecido para UpLoad tem colunas incorretas -> 8");</script>';
                    }
                    if ($arq == 5) {
                         echo '<script>alert("Arquivo fornecido para UpLoad tem colunas incorretas -> 5");</script>';
                    }
                    if ($arq == 6) {
                         echo '<script>alert("Arquivo fornecido para UpLoad tem colunas incorretas -> 5");</script>';
                    }
               } else {
                    if ($arq == 1) {
                         $ret = processa_fun($cam, $nom, $des, $arq, $pro, $gra, $men, $com);
                    }
                    if ($arq == 2) {
                         $ret = processa_sit($cam, $nom, $des, $arq, $pro, $gra, $men, $com);
                    }
                    if ($arq == 3) {
                         $ret = processa_exc($cam, $nom, $des, $arq, $pro, $gra, $men, $com);
                    }
                    if ($arq == 4) {
                         $ret = processa_dia($cam, $nom, $des, $arq, $pro, $gra, $men, $com);
                    }
                    if ($arq == 5) {
                         $ret = processa_cla($cam, $nom, $des, $arq, $pro, $gra, $men, $com);
                    }
                    if ($arq == 6) {
                         $ret = processa_ren($cam, $nom, $des, $arq, $pro, $gra, $men, $com);
                    }
               }
          }
     }
?>

<body id="box00">
     <h1 class="cab-0">Importações - MoneyWay Investimentos - Profsa Informática</h1>
     <?php include_once "cabecalho-1.php"; ?>
     <div class="container-fluid">
          <div class="row">
               <div class="col-md-2">
                    <!-- Menu -->
                    <?php include_once "cabecalho-2.php"; ?>
               </div>
               <div class="col-md-10">
                    <!-- Corpo -->
                    <p class="lit-4">Processo de Importação de Dados</p>
                    <br />
                    <div class="row text-center">
                         <div class="col-md-1"></div>
                         <?php
                              if ($pro != 0) {
                                   echo '<div class="col-md-10 alert alert-success alert-dismissible fade show" role="alert">';
                                   echo '<p><strong><h4>Processamento efetuado com Sucesso - Lidos: ' . $pro . ' Gravados: ' . $gra . '</h4></strong></p>';     
                                   echo '</div>';
                              }
                         ?>
                         <div class="col-md-1"></div>
                    </div>
                    <br />
                    <form class="qua-4" id="frmTelImp" name="frmTelImp" action="processo-imp.php" method="POST"
                         enctype="multipart/form-data">
                         <div class="row">
                              <div class="col-md-2"></div>
                              <div class="cpo-1 col-md-8">
                                   <label class="cor-2">Arquivo .Csv a ser importado</label>
                                   <select id="arq" name="arq" class="form-control">
                                        <option value="0">Selecione o arquivo a ser importado ...
                                        </option>
                                        <option value="1">Informações Cadastrais dos Fundos</option>
                                        <option value="2">Opções dos Fundos - Situação</option>
                                        <option value="3">Opções dos Fundos - Exclusivo</option>
                                        <option value="4">Informações Diárias (movimento)</option>
                                        <option value="5">Informações de Fundos - Classes</option>
                                        <option value="6">Informações de Fundos - Rentabilidade</option>

                                   </select>
                              </div>
                              <div class="col-md-2"></div>
                         </div>
                         <br />
                         <div class="row">
                              <div class="col-md-12 text-center">
                                   <strong>
                                        <span id="nom_a">Nome do Arquivo: </span><br />
                                        <span id="dat_a">Data do Arquivo: </span><br />
                                        <span id="tam_a">Tamanho do Arquivo: </span><br />
                                        <span id="lin_a">Número de Linhas: </span><br />
                                        <span id="max_a">Tamanho Máximo: </span><br />
                                        <?php
                                        if ($pro != 0) {
                                             echo '<br /><span>Lidos / Gravados: ' . $pro . ' - ' . $gra . '</span><br />';
                                        }
                                        ?>
                                   </strong>
                              </div>
                         </div>
                         <br />
                         <div class="row text-center">
                              <div id="mov-1" class="col-md-12">
                                   <strong><h5></h5></strong>
                              </div>
                         </div>
                         <br />
                         <div class="row text-center">
                              <div class="col-md-3"></div>
                              <div class="col-md-3">
                                   <button type="button" id="upload" name="upload" class="bot-1"> <i
                                             class="cur-1 fa fa-upload fa-1g" aria-hidden="true"></i> UpLoad</button>
                              </div>
                              <div class="col-md-3">
                                   <button type="submit" id="processa" name="processa" class="bot-1"> <i
                                             class="cur-1 fa fa-cogs fa-1g" aria-hidden="true"></i> Processar</button>
                              </div>
                              <div class="col-md-3"></div>
                         </div>
                         <br />
                         <input type="hidden" id="sta_a" name="sta_a" value="0" />
                         <input type="hidden" id="reg_a" name="reg_a" value="0" />
                         <input type="hidden" id="qtd_m" name="qtd_m" value="0" />
                         <input type="hidden" id="tam_m" name="tam_m"
                              value="<?php echo ini_get('upload_max_filesize'); ?>" />
                         <input name="arq-up" type="file" id="arq-up" class="bot-3" value="" accept=".csv" />
                    </form>
               </div>
          </div>
     </div>
     <div id="box10">
          <img class="subir" src="img/subir.png" title="Volta a página para o seu topo." />
     </div>
</body>
<?php
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
               $pas = "upload"; 
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

     function verifica_csv ($cam, $nom, $ord, &$con) {
          $con = 0;
          include_once "dados.php";
          $csv = fopen($cam, "r");  
          while (!feof ($csv)) {
               $tam = strlen(fgets($csv));   // Menor que 2000 OK
               if ($tam > 2000) {
                    fclose($csv);     
                    return 999999;
               } else {
                    $lin = explode(";", fgets($csv));
                    if ($ord == 1) {
                         if (count($lin) != 1 && count($lin) != 116) {
                              $con = $con + 1;          
                         }
                    }
                    if ($ord == 2) {
                         if (count($lin) != 1 && count($lin) != 5) {
                              $con = $con + 1;          
                         }
                    }
                    if ($ord == 3) {
                         if (count($lin) != 1 && count($lin) != 5) {
                              $con = $con + 1;          
                         }
                    }
                    if ($ord == 4) {
                         if (count($lin) != 1 && count($lin) != 8) {
                              $con = $con + 1;          
                         }
                    }
                    if ($ord == 5) {
                         if (count($lin) != 1 && count($lin) != 5) {
                              $con = $con + 1;          
                         }
                    }
                    if ($ord == 6) {
                         if (count($lin) != 1 && count($lin) != 5) {
                              $con = $con + 1;          
                         }
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
          include_once "dados.php";
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

     function processa_dia ($cam, $nom, $des, $ord, &$pro, &$gra, &$men, &$com) {
          $ret = 0; 
          $pro = 0; 
          $gra = 0; 
          $men = ''; $com = '';
          include_once "dados.php";
          if ($_SESSION['wrkqtdreg'] > 0) {
               $_SESSION['wrkqtdreg'] = 0;
               $sql  = "delete from tb_movto_id where infarquivo = '" . $nom . "'" ;
               $ret = comando_tab($sql, $nro, $cha, $men);
               if ($ret == false) {
                    print_r($sql);
                    echo '<script>alert("Erro na exclusão do movimento solicitado !");</script>';
               }                         
          }
          $csv = fopen($cam, "r");  
          while (!feof ($csv)) {
               $lin = explode(";", fgets($csv));
               $cha = ler_fundo($lin[0], $sta);
               if ($cha != 0 && $sta == 0) {
                    $sql  = "insert into tb_movto_id (";
                    $sql .= "idfundo, ";
                    $sql .= "infdata, ";
                    $sql .= "inftotal, ";
                    $sql .= "infquota, ";
                    $sql .= "infpatrimonio, ";
                    $sql .= "infcapital, ";
                    $sql .= "infresgate, ";
                    $sql .= "infnumcotas, ";
                    $sql .= "infsequencia, ";
                    $sql .= "infarquivo, ";
                    $sql .= "infordem, ";
                    $sql .= "infprocesso, ";
                    $sql .= "keyinc, ";
                    $sql .= "datinc ";
                    $sql .= ") value ( ";
                    $sql .= "'" . $cha . "',";
                    if (substr($lin[1], 4, 1) == "-" || substr($lin[1], 4, 1) == "/") {
                         $sql .= "'" . $lin[1] . "',";
                    } else {
                         $sql .= "'" . inverte_dat(1, $lin[1]) . "',";
                    }
                    $sql .= "'" . $lin[2] . "',";  
                    $sql .= "'" . limpa_nro($lin[3]) . "',";  
                    $sql .= "'" . $lin[4] . "',";  
                    $sql .= "'" . $lin[5] . "',";  
                    $sql .= "'" . $lin[6] . "',";
                    $sql .= "'" . $lin[7] . "',";  
                    $sql .= "'" . $pro . "',";  
                    $sql .= "'" . $des . "',";  
                    $sql .= "'" . $ord . "',";  
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

     function processa_sit ($cam, $nom, $des, $ord, &$pro, &$gra, &$men, &$com) {
          $ret = 0; 
          $pro = 0; 
          $gra = 0; 
          $atu = 0; 
          $upd = 0; 
          $men = ''; $com = '';
          include_once "dados.php";
          $csv = fopen($cam, "r");  
          while (!feof ($csv)) {
               $lin = explode(";", fgets($csv));               
               $ati = (strpos($lin[2], "NORMAL") > 0 ? 1 : 0);    
               if ($ati == 0) {
                    $key = ler_opcao($lin[0]);
                    $cha = ler_fundo($lin[0], $sta);
                    if ($cha != 0 && $key == 0) {
                         $sql  = "insert into tb_opcoes (";
                         $sql .= "opccnpj, ";
                         $sql .= "opcexclusivo, ";
                         $sql .= "opcativo, ";
                         $sql .= "opcarquivo, ";
                         $sql .= "opcordem, ";
                         $sql .= "opctipo, ";
                         $sql .= "keyinc, ";
                         $sql .= "datinc ";
                         $sql .= ") value ( ";
                         $sql .= "'" . limpa_nro($lin[0]) . "',";
                         $sql .= "'" . '0' . "',";     // 0-não exclusivo, 1-exclusivo  
                         $sql .= "'" . '0' . "',";     // 0-desativado, 1-ativo
                         $sql .= "'" . $des . "',";  
                         $sql .= "'" . $pro . "',";  
                         $sql .= "'" . $ord . "',";  
                         $sql .= "'" . $_SESSION['wrkideusu'] . "',";
                         $sql .= "'" . date("Y-m-d H:i:s") . "')";
                         $ret = comando_tab($sql, $nro, $cha, $men);
                         if ($ret == false) {
                              $com = $sql;
                              $men = "Erro na gravação do registro solicitado no banco de dados !";
                         }               
                         $gra = $gra + 1;
                    }
                    if ($key != 0) {
                         $sql  = "update tb_opcoes set ";
                         $sql .= "opcativo = '". '2' . "', ";
                         $sql .= "keyalt = '" . $_SESSION['wrkideusu'] . "', ";
                         $sql .= "datalt = '" . date("Y-m-d H:i:s") . "' ";
                         $sql .= "where idopcao = " . $key;
                         $ret = comando_tab($sql, $nro, $ind, $men);
                         if ($ret == false) {
                              $com = $sql;
                              $men = "Erro na regravação do ativo solicitado no banco de dados !!!";
                         }               
                         $atu = $atu + 1;
                    } 
                    if ($cha != 0) {
                         $sql  = "update tb_fundos set ";
                         $sql .= "funstatus = '". '3' . "', ";
                         $sql .= "keyalt = '" . $_SESSION['wrkideusu'] . "', ";
                         $sql .= "datalt = '" . date("Y-m-d H:i:s") . "' ";
                         $sql .= "where idfundo = " . $cha;
                         $ret = comando_tab($sql, $nro, $ind, $men);
                         if ($ret == false) {
                              $com = $sql;
                              $men = "Erro na regravação do registro solicitado no banco de dados !";
                         }               
                         $upd = $upd + 1;
                    } 
               }
               $pro = $pro + 1;
          } 
          fclose($csv);     
          return $ret; 
     }

     function processa_exc ($cam, $nom, $des, $ord, &$pro, &$gra, &$men, &$com) {
          $ret = 0; 
          $pro = 0; 
          $gra = 0; 
          $atu = 0;
          $upd = 0;
          $men = ''; $com = '';
          include_once "dados.php";
          $csv = fopen($cam, "r");  
          while (!feof ($csv)) {
               $lin = explode(";", fgets($csv));               
               if ($lin[2] == 'S') {
                    $key = ler_opcao($lin[0]);
                    $cha = ler_fundo($lin[0], $sta);
                    if ($cha != 0 && $key == 0) {
                         $sql  = "insert into tb_opcoes (";
                         $sql .= "opccnpj, ";
                         $sql .= "opcexclusivo, ";
                         $sql .= "opcativo, ";
                         $sql .= "opcarquivo, ";
                         $sql .= "opcordem, ";
                         $sql .= "opctipo, ";
                         $sql .= "keyinc, ";
                         $sql .= "datinc ";
                         $sql .= ") value ( ";
                         $sql .= "'" . limpa_nro($lin[0]) . "',";
                         $sql .= "'" . '1' . "',";     // 0-não exclusivo, 1-exclusivo  
                         $sql .= "'" . '0' . "',";     // 0-desativado, 1-ativo
                         $sql .= "'" . $des . "',";  
                         $sql .= "'" . $pro . "',";  
                         $sql .= "'" . $ord . "',";  
                         $sql .= "'" . $_SESSION['wrkideusu'] . "',";
                         $sql .= "'" . date("Y-m-d H:i:s") . "')";
                         $ret = comando_tab($sql, $nro, $cha, $men);
                         if ($ret == false) {
                              $com = $sql;
                              $men = "Erro na gravação do registro solicitado no banco de dados !";
                         }               
                         $gra = $gra + 1;
                    }
                    if ($key != 0) {
                         $sql  = "update tb_opcoes set ";
                         $sql .= "opcexclusivo = '". '2' . "', ";
                         $sql .= "keyalt = '" . $_SESSION['wrkideusu'] . "', ";
                         $sql .= "datalt = '" . date("Y-m-d H:i:s") . "' ";
                         $sql .= "where idopcao = " . $key;
                         $ret = comando_tab($sql, $nro, $ind, $men);
                         if ($ret == false) {
                              $com = $sql;
                              $men = "Erro na regravação da opção solicitado no banco de dados !!";
                         }               
                         $atu = $atu + 1;
                    } 
                    if ($cha != 0) {
                         $sql  = "update tb_fundos set ";
                         $sql .= "funstatus = '". '2' . "', ";
                         $sql .= "keyalt = '" . $_SESSION['wrkideusu'] . "', ";
                         $sql .= "datalt = '" . date("Y-m-d H:i:s") . "' ";
                         $sql .= "where idfundo = " . $cha;
                         $ret = comando_tab($sql, $nro, $ind, $men);
                         if ($ret == false) {
                              $com = $sql;
                              $men = "Erro na regravação do registro solicitado no banco de dados !!";
                         }               
                         $upd = $upd + 1;
                    } 
               }
               $pro = $pro + 1;
          } 
          fclose($csv);     
          return $ret; 
     }

     function ler_fundo ($cgc, &$sta) {
          $cha = 0; 
          include_once "dados.php";
          $nro = acessa_reg("Select idfundo, funstatus from tb_fundos where funcnpj = '" . limpa_nro($cgc) . "'", $reg);            
          if ($nro == 1) {
               $cha = $reg['idfundo'];
               $sta = $reg['funstatus'];
          }
          return $cha;
     }

     function ler_opcao ($cgc) {
          $key = 0; 
          include_once "dados.php";
          $nro = acessa_reg("Select idopcao from tb_opcoes where opccnpj = '" . limpa_nro($cgc) . "'", $reg);            
          if ($nro == 1) {
               $key = $reg['idopcao'];
          }
          return $key;
     }

     function processa_cla ($cam, $nom, $des, $ord, &$pro, &$atu, &$men, &$com) {
          $ret = 0; 
          $pro = 0; 
          $atu = 0;
          $men = ''; $com = '';
          include_once "dados.php";
          $csv = fopen($cam, "r");  
          while (!feof ($csv)) {
               $tip = 0;
               $lin = explode(";", fgets($csv));               
               $cha = ler_fundo($lin[0], $sta);
               if ($cha == 1) {
                    if ($lin[2] == "Fundo Cambial") {$tip = 1; }
                    if ($lin[2] == "Fundo da Dívida Externa") {$tip = 2; }
                    if ($lin[2] == "Fundo de Ações") {$tip = 3; }
                    if ($lin[2] == "Fundo de Curto Prazo") {$tip = 4; }
                    if ($lin[2] == "Fundo de Renda Fixa") {$tip = 5; }
                    if ($lin[2] == "Fundo Multimercado") {$tip = 6; }
                    if ($lin[2] == "Fundo Referenciado") {$tip = 7; }
                    if ($tip >= 1) {
                         $sql  = "update tb_fundos set ";
                         $sql .= "funclasse = '". $tip . "', ";
                         $sql .= "keyalt = '" . $_SESSION['wrkideusu'] . "', ";
                         $sql .= "datalt = '" . date("Y-m-d H:i:s") . "' ";
                         $sql .= "where idfundo = " . $cha;
                         $ret = comando_tab($sql, $nro, $ind, $men);
                         if ($ret == false) {
                              $com = $sql;
                              $men = "Erro na regravação do registro da classe no banco de dados !";
                         }      
                         $atu = $atu + 1;
                    }         
               }
               $pro = $pro + 1;
          }
          return $ret;
     }

     function processa_ren ($cam, $nom, $des, $ord, &$pro, &$atu, &$men, &$com) {
          $ret = 0; 
          $pro = 0; 
          $atu = 0;
          $men = ''; $com = '';
          include_once "dados.php";
          $csv = fopen($cam, "r");  
          while (!feof ($csv)) {
               $tip = 0;
               $lin = explode(";", fgets($csv));               
               $cha = ler_fundo($lin[0], $sta);
               if ($cha == 1) {
                    if ($lin[2] == "Carteira de ações") {$tip = 1; }
                    if ($lin[2] == "Cota de PIBB") {$tip = 2; } 
                    if ($lin[2] == "DI de um dia") {$tip = 3; } 
                    if ($lin[2] == "Dólar comercial") {$tip = 4; } 
                    if ($lin[2] == "Euro") {$tip = 5; } 
                    if ($lin[2] == "Ibovespa") {$tip = 6; } 
                    if ($lin[2] == "IBrX") {$tip = 7; } 
                    if ($lin[2] == "IBrX-50") {$tip = 8; } 
                    if ($lin[2] == "IEE") {$tip = 9; } 
                    if ($lin[2] == "Índice de Mercado Andima Geral") {$tip = 10; } 
                    if ($lin[2] == "Índice de Mercado Andima LFT") {$tip = 11; } 
                    if ($lin[2] == "Índice de Mercado Andima NTN-B até 5 anos") {$tip = 12; } 
                    if ($lin[2] == "Índice de Mercado Andima NTN-B mais de 5 anos") {$tip = 13; } 
                    if ($lin[2] == "Índice de Mercado Andima todas NTN-B") {$tip = 14; } 
                    if ($lin[2] == "Índice de Mercado Andima todas NTN-C") {$tip = 15; } 
                    if ($lin[2] == "Índice de preços") {$tip = 16; } 
                    if ($lin[2] == "Índice de Preços ao Consumidor (IPC/FIPE)") {$tip = 17; } 
                    if ($lin[2] == "Índice de Preços ao Consumidor Amplo (IPCA/IBGE)") {$tip = 18; } 
                    if ($lin[2] == "Índice Geral de Preços-Disponibilidade Interna (IGP-DI)") {$tip = 19; }
                    if ($lin[2] == "Índice Geral de Preços-Mercado (IGP-M)") {$tip = 20; } 
                    if ($lin[2] == "Índice Nacional de Preços ao Consumidor (INPC/IBGE)") {$tip = 21; } 
                    if ($lin[2] == "IRF-M") {$tip = 22; } 
                    if ($lin[2] == "ITEL") {$tip = 23; } 
                    if ($lin[2] == "Ouro 250 gramas") {$tip = 24; } 
                    if ($lin[2] == "OUTROS") {$tip = 25; } 
                    if ($lin[2] == "Taxa Anbid") {$tip = 26; } 
                    if ($lin[2] == "Taxa Básica Financeira") {$tip = 27; } 
                    if ($lin[2] == "Taxa de Juro de Longo Prazo") {$tip = 28; } 
                    if ($lin[2] == "Taxa de juro prefixada") {$tip = 29; } 
                    if ($lin[2] == "Taxa Referencial") {$tip = 30; } 
                    if ($lin[2] == "Taxa Selic") {$tip = 31; } 
                    if ($tip >= 1) {
                         $sql  = "update tb_fundos set ";
                         $sql .= "funrentab = '". $tip . "', ";
                         $sql .= "keyalt = '" . $_SESSION['wrkideusu'] . "', ";
                         $sql .= "datalt = '" . date("Y-m-d H:i:s") . "' ";
                         $sql .= "where idfundo = " . $cha;
                         $ret = comando_tab($sql, $nro, $ind, $men);
                         if ($ret == false) {
                              $com = $sql;
                              $men = "Erro na regravação do registro da classe no banco de dados !";
                         }      
                         $atu = $atu + 1;
                    }                        
               }
               $pro = $pro + 1;
          }
          return $ret;
     }

?>

</html>
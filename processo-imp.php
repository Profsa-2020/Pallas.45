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
     $('.alert').delay(5000).fadeOut(2500);

     $('#upload').bind("click", function() {
          let arq = $('#arq').val();
          if (arq == 0) {
               alert("Não foi informada uma opção de arquivo para efetuar UpLoad");
          } else {
               $('#arq-up').click();
          }
     });

     $('#arq-up').change(function() {
          $('#inf-1').text('');
          $('#inf-2').text('Fase: 01/03');
          $('#qtd_m').val(0);
          var ord = $('#arq').val();
          var arqu = $(this)[0].files[0].name;
          $('#inf-3').text($(this)[0].files[0].name);
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

               $.getJSON("ajax/movto_exi.php", {
                         nom: arqu,
                         ord: ord
                    })
                    .done(function(data) {
                         if (data.men != "") {
                              alert(data.men);
                         } else {
                              if (data.qtd > 0 && data.ord == 4) { // 4 - arquivo de movimento
                                   ('#qtd_m').val(data.qtd);
                                   alert('Há [' + data.qtd +
                                        '] registros no movimento para este arquivo, será excluído !'
                                   );
                              }
                         }
                    }).fail(function(data) {
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

     $("#web-1").click(function() {
          let arq = $('#arq').val();
          if (arq == 0) {
               alert("Selecione um tipo de arquivo para abrir endereço do site");
          } else if (arq == 1) {
               window.open('http://dados.cvm.gov.br/dados/FI/DOC/EXTRATO/DADOS/', '_blank');
          } else if (arq == 2 || arq == 3) {
               window.open(
                    'http://dados.cvm.gov.br/dataset/fi-cad/resource/9ff23a88-d333-4b04-8600-ee474d9e1aae?inner_span=True',
                    '_blank');
          } else if (arq == 4) {
               window.open('http://dados.cvm.gov.br/dados/FI/DOC/INF_DIARIO/DADOS/', '_blank');
          } else if (arq == 5 || arq == 6) {
               window.open(
                    'http://dados.cvm.gov.br/dataset/fi-cad/resource/9ff23a88-d333-4b04-8600-ee474d9e1aae?inner_span=True',
                    '_blank');
          } else if (arq == 7) {
               window.open(
                    'https://www3.bcb.gov.br/sgspub/localizarseries/localizarSeries.do?method=prepararTelaLocalizarSeries',
                    '_blank');
          }
     });


});
</script>

<?php 
     $pro = 0;
     $gra = 0;
     $inf = "Fase: 00/03";
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
     if (isset($_REQUEST['ope']) == true) { $_SESSION['wrkopereg'] = $_REQUEST['ope']; }
     if (isset($_REQUEST['cod']) == true) { $_SESSION['wrkcodreg'] = $_REQUEST['cod']; }

     if (isset($_SESSION['wrkqtdreg']) == false) { $_SESSION['wrkqtdreg'] = 0; }
     if (isset($_SESSION['wrkopereg']) == false) { $_SESSION['wrkopereg'] = 0; }
     if (isset($_SESSION['wrknumcol']) == false) { $_SESSION['wrknumcol'] = 0; }
     if (isset($_SESSION['wrknomcsv']) == false) { $_SESSION['wrknomcsv'] = ''; }
     if (isset($_SESSION['wrknomarq']) == false) { $_SESSION['wrknomarq'] = ''; }
     ini_set('max_execution_time', 1800);       
     $max = ini_get('upload_max_filesize');
     $arq = (isset($_REQUEST['arq']) == false ? 0 : $_REQUEST['arq']);
     if (isset($_REQUEST['subir']) == true) {
          $inf = "Fase: 02/03"; $_SESSION['wrkopereg'] = $arq;
          $ret = upload_csv($_SESSION['wrknumusu'], $_FILES, $arq, $cam, $nom, $des, $tip, $ext, $tam, $men);
          if ($men != "") {
               echo '<script>alert("' . $men . '");</script>';
          }
     }     
     if (isset($_REQUEST['processa']) == true) {
          $arq = $_SESSION['wrkopereg'];
          $qtd = verifica_csv($_SESSION['wrknomarq'], $_SESSION['wrknomcsv'], $arq, $con);
          if ($qtd == 999998) {
               echo '<script>alert("Arquivo informado não carregado para efetuar UpLoad do mesmo");</script>';
          } else if ($qtd == 999999) {
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
               if ($arq == 7) {
                    echo '<script>alert("Arquivo fornecido para UpLoad tem colunas incorretas -> 2/7");</script>';
               }
          } else {
               if ($arq == 1) {
                    $ret = processa_fun($_SESSION['wrknomarq'], $_SESSION['wrknomcsv'], $arq, $pro, $gra, $men, $com);
                    if (trim($men) != "") {
                         echo '<script>alert("' . $men . ' !");</script>';
                         echo '<script>console.log("' . $com . ' !!");</script>';
                    }
               }
               if ($arq == 2) {
                    $ret = processa_sit($_SESSION['wrknomarq'], $_SESSION['wrknomcsv'], $arq, $pro, $gra, $men, $com);
                    if (trim($men) != "") {
                         echo '<script>alert("' . $men . ' !!");</script>';
                         echo '<script>console.log("' . $com . ' !!");</script>';
                    }
               }
               if ($arq == 3) {
                    $ret = processa_exc($_SESSION['wrknomarq'], $_SESSION['wrknomcsv'], $arq, $pro, $gra, $men, $com);
                    if (trim($men) != "") {
                         echo '<script>alert("' . $men . ' !!");</script>';
                         echo '<script>console.log("' . $com . ' !!");</script>';
                    }
               }
               if ($arq == 4) {
                    $ret = processa_dia($_SESSION['wrknomarq'], $_SESSION['wrknomcsv'], $arq, $pro, $gra, $men, $com);
                    if (trim($men) != "") {
                         echo '<script>alert("' . $men . ' !!");</script>';
                         echo '<script>console.log("' . $com . ' !!");</script>';
                    }
               }
               if ($arq == 5) {
                    $ret = processa_cla($_SESSION['wrknomarq'], $_SESSION['wrknomcsv'], $arq, $pro, $gra, $men, $com);
                    if (trim($men) != "") {
                         echo '<script>alert("' . $men . ' !!");</script>';
                         echo '<script>console.log("' . $com . ' !!");</script>';
                    }
               }
               if ($arq == 6) {
                    $ret = processa_ren($_SESSION['wrknomarq'], $_SESSION['wrknomcsv'], $arq, $pro, $gra, $men, $com);
                    if (trim($men) != "") {
                         echo '<script>alert("' . $men . ' !!");</script>';
                         echo '<script>console.log("' . $com . ' !!");</script>';
                    }
               }
               if ($arq == 7) {
                    $ret = processa_ind($_SESSION['wrknomarq'], $_SESSION['wrknomcsv'], $arq, $pro, $gra, $men, $com);
                    if (trim($men) != "") {
                         echo '<script>alert("' . $men . ' !!");</script>';
                         echo '<script>console.log("' . $com . ' !!");</script>';
                    }
               }
          }
          $inf = "Fase: 03/03"; $_SESSION['wrknomcsv'] = ""; $_SESSION['wrknomarq'] = "";
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
                                   echo '<p><strong><h4 id="inf-1">Processamento efetuado com Sucesso - Lidos: ' . $pro . ' Gravados: ' . $gra . '</h4></strong></p>';     
                                   echo '</div>';
                              }
                         ?>
                         <div class="col-md-1"></div>
                    </div>
                    <br />
                    <form class="qua-4" id="frmTelImp" name="frmTelImp" action="processo-imp.php" method="POST"
                         enctype="multipart/form-data">
                         <div class="row">
                              <div class="col-md-1"></div>
                              <div class="cpo-1 col-md-10">
                                   <label class="cor-2">Arquivo .Csv a ser importado</label>
                                   <select id="arq" name="arq" class="form-control">
                                        <option value="0">Selecione o arquivo a ser importado ...
                                        </option>
                                        <option value="1">Informações Cadastrais dos Fundos (extrato_fi_AAAA.csv)
                                        </option>
                                        <option value="2">Opções dos Fundos - Situação (cad_fi_hist_sit.csv)</option>
                                        <option value="3">Opções dos Fundos - Exclusivo (cad_fi_hist_exclusivo.csv)
                                        </option>
                                        <option value="4">INFORMAÇÕES DIÁRIAS (inf_diario_fi_AAAAMM.csv)</option>
                                        <option value="5">Informações de Fundos - Classes (cad_fi_hist_classe.csv)
                                        </option>
                                        <option value="6">Informações de Fundos - Rentabilidade (cad_fi_hist_rentab.csv)
                                        </option>
                                        <option value="7">Índices de Correção de Ativos</option>
                                   </select>
                              </div>
                              <div class="col-md-1"></div>
                         </div>
                         <br />
                         <div class="row">
                              <div class="col-md-12 text-center">
                                   <strong>
                                        <span id="nom_a">Nome do Arquivo:
                                             <?php echo $_SESSION['wrknomcsv']; ?></span><br />
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
                         <div class="row text-center">
                              <div id="mov-1" class="col-md-12">
                                   <strong>
                                        <h5></h5>
                                   </strong>
                              </div>
                         </div>
                         <br />
                         <div class="row">
                              <div class="col-md-12 text-center">
                                   <button type="button" id="upload" name="upload" class="bot-1"> <i
                                             class="cur-1 fa fa-database fa-1g" aria-hidden="true"></i>&nbsp; &nbsp;
                                        Arquivo</button>
                                   &nbsp;
                                   <button type="submit" id="subir" name="subir" class="bot-1"> <i
                                             class="cur-1 fa fa-upload fa-1g" aria-hidden="true"></i>&nbsp; &nbsp;
                                        UpLoad</button>
                                   &nbsp;
                                   <button type="submit" id="processa" name="processa" class="bot-1"> <i
                                             class="cur-1 fa fa-cogs fa-1g" aria-hidden="true"></i>&nbsp; &nbsp;
                                        Atualizar</button>
                              </div>
                         </div>
                         <br />
                         <div class="row">
                              <div class="col-md-12 text-center">
                                   <i id="web-1" class="cur-1 cor-4 fa fa-globe fa-2x" aria-hidden="true"
                                        title="Abre nova guia com acesso ao web site do tipo de arquivo"></i>
                              </div>
                         </div>
                         <br />
                         <div class="row">
                              <div class="col-md-12 text-center ">
                                   <strong>
                                        <h4><span id="inf-2"><?php echo $inf; ?></span></h4>
                                        <span id="inf-3"><?php echo $_SESSION['wrknomcsv']; ?></span><br />
                                        <span id="inf-4"><?php echo $_SESSION['wrknomarq']; ?></span><br />
                                   </strong>
                              </div>
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
               $_SESSION['wrknomcsv'] = $des;
               if (file_exists($pas) == false) { mkdir($pas);  }
               $nom = 'Csv_' . str_pad($nro, 6, "0", STR_PAD_LEFT) . "_" . str_pad($ord, 3, "0", STR_PAD_LEFT) . "." . $ext; 
               $cam = $pas . "/" . 'Csv_' . str_pad($nro, 6, "0", STR_PAD_LEFT) . "_" . str_pad($ord, 3, "0", STR_PAD_LEFT) . "." . $ext; 
               $ret = move_uploaded_file($arq['tmp_name'], $cam);
               $_SESSION['wrknomarq'] = $nom;
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
          $con = 0; $_SESSION['wrknumcol'] = 0;
          if ($cam == "") { return 999998; }
          include_once "dados.php";
          $csv = fopen('upload/' . $cam, "r");  
          while (!feof ($csv)) {
               $tam = strlen(fgets($csv));   // Menor que 2000 OK
               if ($tam > 2000) {
                    fclose($csv);     
                    return 999999;
               } else {
                    $reg = fgets($csv);
                    if (strpos($reg, ';') == 0) {
                         $lin = explode(",", $reg);
                    } else {
                         $lin = explode(";", $reg);
                    }   
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
                    if ($ord == 7) {
                         if (count($lin) != 1 && count($lin) != 2 && count($lin) != 7) {
                              $con = $con + 1;          
                         }
                    }
                    if (count($lin) >= 2) {
                         $_SESSION['wrknumcol'] = count($lin);
                    }
               }
          } 
          fclose($csv);     
          return $con; 
     }

     function processa_fun ($cam, $des, $ord, &$pro, &$gra, &$men, &$com) {
          $ret = 0; 
          $pro = 0; 
          $gra = 0; 
          $men = ''; $com = '';
          include_once "dados.php";
          $csv = fopen('upload/' . $cam, "r");  
          while (!feof ($csv)) {
               $lin = explode(";", fgets($csv, 1024));
               $nro = acessa_reg("Select idfundo from tb_fundos where funcnpj = '" . limpa_nro($lin[0]) . "'", $reg);       
               if ($nro == 0 &&  limpa_nro($lin[0]) != "0" && count($lin) == 116) {
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
                    $sql .= "'" . limpa_nro($lin[0]) . "',";     // Cnpj
                    $sql .= "'" . utf8_encode(str_replace("'", "´", substr($lin[1], 0, 75))) . "',";     // Nome
                    if (substr($lin[2], 4, 1) == "-" || substr($lin[2], 4, 1) == "/") {
                         $sql .= "'" . $lin[2] . "',";      //Data Cadastro
                    } else {
                         $sql .= "'" . inverte_dat(1, $lin[2]) . "',";
                    }
                    $sql .= "'" . substr($lin[3], 0, 1) . "',";  // Coluna D - Condomínio
                    $sql .= "'" . substr($lin[5], 0, 1) . "',";  // Coluna F - negocia mercado
                    if ($lin[8] == "INVESTIDORES PROFISSIONAIS") { $sql .= "'" . 'A' . "',"; }      // Coluna I - Publico Alvo }
                    if ($lin[8] == "INVESTIDORES QUALIFICADOS") { $sql .= "'" . 'B' . "',";  }      // Coluna I - Publico Alvo }
                    if (utf8_encode($lin[8]) == "PREVIDENCIÁRIO") { $sql .= "'" . 'C' . "',";  }    // Coluna I - Publico Alvo }
                    if (utf8_encode($lin[8]) == "PÚBLICO EM GERAL") { $sql .= "'" . 'D' . "',";  } // Coluna I - Publico Alvo }
                    $sql .= "'" . substr($lin[15], 0, 1) . "',";  // Coluna P - Fundo Cotas
                    $sql .= "'" . substr($lin[16], 0, 1) . "',";  // Coluna Q - espelho     

                    if (utf8_encode(trim($lin[10])) == "") { $sql .= "01'" . '' . "',";  }    // Coluna K - Anbima (Estratégia) 
                    if (utf8_encode($lin[10]) == "AÇÕES - ATIVO - DIVIDENDOS") { $sql .= "'" . '02' . "',";  }
                    if (utf8_encode($lin[10]) == "AÇÕES - ATIVO - ÍNDICE ATIVO") { $sql .= "'" . '03' . "',";  }
                    if (utf8_encode($lin[10]) == "AÇÕES - ATIVO - LIVRE") { $sql .= "'" . '04' . "',";  }
                    if (utf8_encode($lin[10]) == "AÇÕES - ATIVO - SETORIAIS") { $sql .= "'" . '05' . "',";  }
                    if (utf8_encode($lin[10]) == "AÇÕES - ATIVO - SMALL CAPS") { $sql .= "'" . '06' . "',";  }
                    if (utf8_encode($lin[10]) == "AÇÕES - ATIVO - SUSTENTABILIDADE / GOVERNANÇA") { $sql .= "'" . '07' . "',";  }
                    if (utf8_encode($lin[10]) == "AÇÕES - ATIVO - VALOR / CRESCIMENTO") { $sql .= "'" . '08' . "',";  }
                    if (utf8_encode($lin[10]) == "AÇÕES - FUNDOS FECHADOS") { $sql .= "'" . '09' . "',";  }
                    if (utf8_encode($lin[10]) == "AÇÕES - INDEXADO - ÍNDICE PASSIVO") { $sql .= "'" . '10' . "',";  }
                    if (utf8_encode($lin[10]) == "AÇÕES - INVESTIMENTO NO EXTERIOR") { $sql .= "'" . '11' . "',";  }
                    if (utf8_encode($lin[10]) == "AÇÕES - MONO AÇÃO") { $sql .= "'" . '12' . "',";  }
                    if (utf8_encode($lin[10]) == "FUNDO CAMBIAL") { $sql .= "'" . '13' . "',";  }
                    if (utf8_encode($lin[10]) == "MULTIMERCADO - ALOCAÇÃO - BALANCEADOS") { $sql .= "'" . '14' . "',";  }
                    if (utf8_encode($lin[10]) == "MULTIMERCADO - ALOCAÇÃO - DINÂMICOS") { $sql .= "'" . '15' . "',";  }
                    if (utf8_encode($lin[10]) == "MULTIMERCADO - ESTRATÉGIA - CAPITAL PROTEGIDO") { $sql .= "'" . '16' . "',";  }
                    if (utf8_encode($lin[10]) == "MULTIMERCADO - ESTRATÉGIA - ESTRATÉGIA ESPECÍFICA") { $sql .= "'" . '17' . "',";  }
                    if (utf8_encode($lin[10]) == "MULTIMERCADO - ESTRATÉGIA - JUROS E MOEDAS") { $sql .= "'" . '18' . "',";  }
                    if (utf8_encode($lin[10]) == "MULTIMERCADO - ESTRATÉGIA - LIVRE") { $sql .= "'" . '19' . "',";  }
                    if (utf8_encode($lin[10]) == "MULTIMERCADO - ESTRATÉGIA - LONG & SHORT DIRECIONAL") { $sql .= "'" . '20' . "',";  }
                    if (utf8_encode($lin[10]) == "MULTIMERCADO - ESTRATÉGIA - LONG & SHORT NEUTRO") { $sql .= "'" . '21' . "',";  }
                    if (utf8_encode($lin[10]) == "MULTIMERCADO - ESTRATÉGIA - MACRO") { $sql .= "'" . '22' . "',";  }
                    if (utf8_encode($lin[10]) == "MULTIMERCADO - ESTRATÉGIA - TRADING") { $sql .= "'" . '23' . "',";  }
                    if (utf8_encode($lin[10]) == "MULTIMERCADO - INVESTIMENTO NO EXTERIOR") { $sql .= "'" . '24' . "',";  }
                    if (utf8_encode($lin[10]) == "PREVIDÊNCIA - AÇÕES ATIVO") { $sql .= "'" . '25' . "',";  }
                    if (utf8_encode($lin[10]) == "PREVIDÊNCIA - BALANCEADOS - ACIMA DE 49") { $sql .= "'" . '26' . "',";  }
                    if (utf8_encode($lin[10]) == "PREVIDÊNCIA - BALANCEADOS - DE 30-49") { $sql .= "'" . '27' . "',";  }
                    if (utf8_encode($lin[10]) == "PREVIDÊNCIA - MULTIMERCADOS LIVRE") { $sql .= "'" . '28' . "',";  }
                    if (utf8_encode($lin[10]) == "PREVIDÊNCIA - RF DURAÇÃO BAIXA - GRAU DE INVESTIMENTO") { $sql .= "'" . '29' . "',";  }
                    if (utf8_encode($lin[10]) == "PREVIDÊNCIA - RF DURAÇÃO LIVRE - GRAU DE INVESTIMENTO") { $sql .= "'" . '30' . "',";  }
                    if (utf8_encode($lin[10]) == "PREVIDÊNCIA - RF DURAÇÃO LIVRE - SOBERANO") { $sql .= "'" . '31' . "',";  }
                    if (utf8_encode($lin[10]) == "PREVIDÊNCIA - RF DURAÇÃO MÉDIA - GRAU DE INVESTIMENTO") { $sql .= "'" . '32' . "',";  }
                    if (utf8_encode($lin[10]) == "PREVIDÊNCIA - RF INDEXADOS") { $sql .= "'" . '33' . "',";  }
                    if (utf8_encode($lin[10]) == "PREVIDÊNCIA AÇÕES") { $sql .= "'" . '34' . "',";  }
                    if (utf8_encode($lin[10]) == "PREVIDÊNCIA BALANCEADOS - ACIMA DE 30") { $sql .= "'" . '35' . "',";  }
                    if (utf8_encode($lin[10]) == "PREVIDÊNCIA BALANCEADOS - ATÉ 15") { $sql .= "'" . '36' . "',";  }
                    if (utf8_encode($lin[10]) == "PREVIDÊNCIA BALANCEADOS - DE 15 A 30") { $sql .= "'" . '37' . "',";  }
                    if (utf8_encode($lin[10]) == "PREVIDÊNCIA DATA ALVO (FIQ)") { $sql .= "'" . '38' . "',";  }
                    if (utf8_encode($lin[10]) == "PREVIDÊNCIA MULTIMERCADO") { $sql .= "'" . '39' . "',";  }
                    if (utf8_encode($lin[10]) == "RENDA FIXA") { $sql .= "'" . '40' . "',";  }
                    if (utf8_encode($lin[10]) == "RENDA FIXA - INV. NO EXTERIOR") { $sql .= "'" . '41' . "',";  }
                    if (utf8_encode($lin[10]) == "RENDA FIXA - INV. NO EXTERIOR - DÍVIDA EXTERNA") { $sql .= "'" . '42' . "',";  }
                    if (utf8_encode($lin[10]) == "RENDA FIXA - PASSIVO - ÍNDICES") { $sql .= "'" . '43' . "',";  }
                    if (utf8_encode($lin[10]) == "RENDA FIXA ALTA DURAÇÃO - CRÉDITO LIVRE") { $sql .= "'" . '44' . "',";  }
                    if (utf8_encode($lin[10]) == "RENDA FIXA ALTA DURAÇÃO - GRAU DE INVESTIMENTO") { $sql .= "'" . '45' . "',";  }
                    if (utf8_encode($lin[10]) == "RENDA FIXA ALTA DURAÇÃO - SOBERANO") { $sql .= "'" . '46' . "',";  }
                    if (utf8_encode($lin[10]) == "RENDA FIXA BAIXA DURAÇÃO - CRÉDITO LIVRE") { $sql .= "'" . '47' . "',";  }
                    if (utf8_encode($lin[10]) == "RENDA FIXA BAIXA DURAÇÃO - GRAU DE INVESTIMENTO") { $sql .= "'" . '48' . "',";  }
                    if (utf8_encode($lin[10]) == "RENDA FIXA BAIXA DURAÇÃO - SOBERANO") { $sql .= "'" . '49' . "',";  }
                    if (utf8_encode($lin[10]) == "RENDA FIXA LIVRE DURAÇÃO - CRÉDITO LIVRE") { $sql .= "'" . '50' . "',";  }
                    if (utf8_encode($lin[10]) == "RENDA FIXA LIVRE DURAÇÃO - GRAU DE INVESTIMENTO") { $sql .= "'" . '51' . "',";  }
                    if (utf8_encode($lin[10]) == "RENDA FIXA LIVRE DURAÇÃO - SOBERANO") { $sql .= "'" . '52' . "',";  }
                    if (utf8_encode($lin[10]) == "RENDA FIXA MÉDIA DURAÇÃO - CRÉDITO LIVRE") { $sql .= "'" . '53' . "',";  }
                    if (utf8_encode($lin[10]) == "RENDA FIXA MÉDIA DURAÇÃO - GRAU DE INVESTIMENTO") { $sql .= "'" . '54' . "',";  }
                    if (utf8_encode($lin[10]) == "RENDA FIXA MÉDIA DURAÇÃO - SOBERANO") { $sql .= "'" . '55' . "',";  }
                    if (utf8_encode($lin[10]) == "RENDA FIXA SIMPLES") { $sql .= "'" . '56' . "',";  }

                    $sql .= "'" . $lin[17] . "',";  // Coluna R R$ - Aplicação Mínima
                    $sql .= "'" . substr($lin[18], 0, 1) . "',";  // Coluna S - Atualização Diária Cota
                    $sql .= "'" . $cam . "',";  
                    $sql .= "'" . $des . "',";  
                    $sql .= "'" . $ord . "',";  
                    $sql .= "'" . $pro . "',";  
                    $sql .= "'" .  $_SESSION['wrknumusu'] . "',";  
                    $sql .= "'" . $_SESSION['wrkideusu'] . "',";
                    $sql .= "'" . date("Y-m-d H:i:s") . "')";
                    $ret = comando_tab($sql, $nro, $cha, $men);
                    if ($ret == false) {
                         $com = $sql;
                         $men = "Erro na gravação do registro de fundos no banco de dados !";
                    }               
                    $gra = $gra + 1;
               } 
               $pro = $pro + 1;
          } 
          fclose($csv);     
          return $ret; 
     }

     function processa_dia ($cam, $des, $ord, &$pro, &$gra, &$men, &$com) {
          $ret = 0; 
          $pro = 0; 
          $gra = 0; 
          $men = ''; $com = '';
          include_once "dados.php";
          $lin = linhas_mov($des);
          if ($_SESSION['wrkqtdreg'] > 0) {
               $_SESSION['wrkqtdreg'] = 0;
               $sql  = "delete from tb_movto_id where infarquivo = '" . $des . "'" ;
               $ret = comando_tab($sql, $nro, $cha, $men);
               if ($ret == false) {
                    print_r($sql);
                    echo '<script>alert("Erro na exclusão do movimento solicitado !");</script>';
               }                         
          }
          $csv = fopen('upload/' . $cam, "r");  
          while (!feof ($csv)) {
               $lin = explode(";", fgets($csv));
               $cha = ler_fundo($lin[0], $sta);
               if ($cha != 0 && $sta == 0 && count($lin) == 8) {
                    $sql  = "insert into tb_movto_id (";
                    $sql .= "idfundo, ";
                    $sql .= "inffundo, ";
                    $sql .= "infdata, ";
                    $sql .= "inftotal, ";
                    $sql .= "infquota, ";
                    $sql .= "infpatrimonio, ";
                    $sql .= "infcapital, ";
                    $sql .= "infresgate, ";
                    $sql .= "infnumcotas, ";
                    $sql .= "infsequencia, ";     // Número de linhas gravadas
                    $sql .= "infarquivo, ";
                    $sql .= "infordem, ";
                    $sql .= "infprocesso, ";
                    $sql .= "infnumero, ";        // Número de linhas processadas - tem  Cnpj do fundo
                    $sql .= "keyinc, ";
                    $sql .= "datinc ";
                    $sql .= ") value ( ";
                    $sql .= "'" . $cha . "',";
                    $sql .= "'" . limpa_nro($lin[0]) . "',";  
                    if (substr($lin[1], 4, 1) == "-" || substr($lin[1], 4, 1) == "/") {
                         $sql .= "'" . $lin[1] . "',";
                    } else {
                         $sql .= "'" . inverte_dat(1, $lin[1]) . "',";
                    }
                    $sql .= "'" . $lin[2] . "',";  
                    $sql .= "'" . $lin[3] . "',";  // Coluna D - VL_QUOTA - infquota
                    $sql .= "'" . $lin[4] . "',";  
                    $sql .= "'" . $lin[5] . "',";  
                    $sql .= "'" . $lin[6] . "',";
                    $sql .= "'" . $lin[7] . "',";  
                    $sql .= "'" . ($gra + 1) . "',";  
                    $sql .= "'" . $des . "',";  
                    $sql .= "'" . $ord . "',";
                    $sql .= "'" .  $_SESSION['wrknumusu'] . "',";  
                    $sql .= "'" . $pro . "',";
                    $sql .= "'" . $_SESSION['wrkideusu'] . "',";
                    $sql .= "'" . date("Y-m-d H:i:s") . "')";
                    $ret = comando_tab($sql, $nro, $cha, $men);
                    if ($ret == false) {
                         $com = $sql;
                         $men = "Erro na gravação do registro de movto no banco de dados !";
                    }               
                    $gra = $gra + 1;
               }
               $pro = $pro + 1;
          } 
          fclose($csv);     
          return $ret; 
     }

     function linhas_mov ($des) {
          $nro = 0; 
          include_once "dados.php";
          $nro = acessa_reg("Select Count(*) as movqtde from tb_movto_id where infarquivo = '" . $des . "'", $reg);            
          if ($nro != 0) {
               $nro = $reg['movqtde'];
          }          
          return $nro; 
     }

     function processa_sit ($cam, $des, $ord, &$pro, &$gra, &$men, &$com) {
          $ret = 0; 
          $pro = 0; 
          $gra = 0; 
          $atu = 0; 
          $upd = 0; 
          $men = ''; $com = '';
          include_once "dados.php";
          $ret = comando_tab("Update tb_fundos set funstatus = 0", $nro, $cha, $men);
          if ($ret == false) {
               $com = $sql;
               $men = "Erro na atualização do status dos fundos (situação) !";
          }          
          $csv = fopen('upload/' . $cam, "r");  
          while (!feof ($csv)) {
               $lin = explode(";", fgets($csv));     
               if (count($lin) >=2) {
                    $ati = (strpos($lin[2], "NORMAL") > 0 ? 1 : 0);    
                    if ($ati == 0 && trim($lin[4]) == "") {
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
                              $sql .= "opcdessituacao, ";
                              $sql .= "keyinc, ";
                              $sql .= "datinc ";
                              $sql .= ") value ( ";
                              $sql .= "'" . limpa_nro($lin[0]) . "',";
                              $sql .= "'" . '0' . "',";     // 0-não exclusivo, 1-exclusivo  
                              $sql .= "'" . '0' . "',";     // 0-desativado, 1-ativo
                              $sql .= "'" . $des . "',";  
                              $sql .= "'" . $pro . "',";  
                              $sql .= "'" . $ord . "',";
                              $sql .= "'" . $lin[2] . "',";
                              $sql .= "'" . $_SESSION['wrkideusu'] . "',";
                              $sql .= "'" . date("Y-m-d H:i:s") . "')";
                              $ret = comando_tab($sql, $nro, $cha, $men);
                              if ($ret == false) {
                                   $com = $sql;
                                   $men = "Erro na gravação do registro de opção no banco de dados !";
                              }               
                              $gra = $gra + 1;
                         }
                         if ($key != 0) {
                              $sql  = "update tb_opcoes set ";
                              $sql .= "opcativo = '". '2' . "', ";
                              $sql .= "opcdessituacao = '" . $lin[2] . "', ";
                              $sql .= "keyalt = '" . $_SESSION['wrkideusu'] . "', ";
                              $sql .= "datalt = '" . date("Y-m-d H:i:s") . "' ";
                              $sql .= "where idopcao = " . $key;
                              $ret = comando_tab($sql, $nro, $ind, $men);
                              if ($ret == false) {
                                   $com = $sql;
                                   $men = "Erro na regravação da opção solicitada no banco de dados !!!";
                              }               
                              $atu = $atu + 1;
                         } 
                         if ($cha != 0) {
                              $sql  = "update tb_fundos set ";
                              $sql .= "funnormal = '". '0' . "', ";
                              $sql .= "keyalt = '" . $_SESSION['wrkideusu'] . "', ";
                              $sql .= "datalt = '" . date("Y-m-d H:i:s") . "' ";
                              $sql .= "where idfundo = " . $cha;
                              $ret = comando_tab($sql, $nro, $ind, $men);
                              if ($ret == false) {
                                   $com = $sql;
                                   $men = "Erro na regravação do registro de fundo no banco de dados !";
                              }               
                              $upd = $upd + 1;
                         } 
                    }
               }
               $pro = $pro + 1;
          } 
          fclose($csv);     
          return $ret; 
     }

     function processa_exc ($cam, $des, $ord, &$pro, &$gra, &$men, &$com) {
          $ret = 0; 
          $pro = 0; 
          $gra = 0; 
          $atu = 0;
          $upd = 0;
          $men = ''; $com = '';
          include_once "dados.php";
          $csv = fopen('upload/' . $cam, "r");  
          while (!feof ($csv)) {
               $lin = explode(";", fgets($csv));           
               if (count($lin) >=2) {
                    if ($lin[2] == 'S' && trim($lin[4]) == "") {
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
                                   $men = "Erro na gravação do registro de opção no banco de dados !";
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
                              $sql .= "funexclusivo = '". '1' . "', ";
                              $sql .= "keyalt = '" . $_SESSION['wrkideusu'] . "', ";
                              $sql .= "datalt = '" . date("Y-m-d H:i:s") . "' ";
                              $sql .= "where idfundo = " . $cha;
                              $ret = comando_tab($sql, $nro, $ind, $men);
                              if ($ret == false) {
                                   $com = $sql;
                                   $men = "Erro na regravação do registro de fundos no banco de dados !";
                              }               
                              $upd = $upd + 1;
                         } 
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

     function ler_indice ($cpo, $dat) {
          $key = 0; 
          include_once "dados.php";
          $nro = acessa_reg("Select idindice from tb_indice where indcodigo = " . $cpo . " and inddata = '" . $dat . "'", $reg);            
          if ($nro == 1) {
               $key = $reg['idindice'];
          }
          return $key;
     }

     function processa_cla ($cam, $des, $ord, &$pro, &$atu, &$men, &$com) {
          $ret = 0; 
          $pro = 0; 
          $atu = 0;
          $men = ''; $com = '';
          include_once "dados.php";
          $csv = fopen('upload/' . $cam, "r");  
          while (!feof ($csv)) {
               $tip = 0;
               $lin = explode(";", fgets($csv));          
               if (count($lin) >= 2) {
                    if(trim($lin[4]) == "") {
                         $cha = ler_fundo($lin[0], $sta);
                         if ($cha >= 1) {
                              if ($lin[2] == utf8_decode("Fundo Cambial")) {$tip = 1; }
                              if ($lin[2] == utf8_decode("Fundo da Dívida Externa")) {$tip = 2; }
                              if ($lin[2] == utf8_decode("Fundo de Ações")) {$tip = 3; }
                              if ($lin[2] == utf8_decode("Fundo de Curto Prazo")) {$tip = 4; }
                              if ($lin[2] == utf8_decode("Fundo de Renda Fixa")) {$tip = 5; }
                              if ($lin[2] == utf8_decode("Fundo Multimercado")) {$tip = 6; }
                              if ($lin[2] == utf8_decode("Fundo Referenciado")) {$tip = 7; }
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
                    }
               }
               $pro = $pro + 1;
          }
          return $ret;
     }

     function processa_ren ($cam, $des, $ord, &$pro, &$atu, &$men, &$com) {
          $ret = 0; 
          $pro = 0; 
          $atu = 0;
          $men = ''; $com = '';
          include_once "dados.php";
          $csv = fopen('upload/' . $cam, "r");  
          while (!feof ($csv)) {
               $tip = 0;
               $lin = explode(";", fgets($csv));       
               if (count($lin) >= 2) {
                    if(trim($lin[4]) == "") {
                         $cha = ler_fundo($lin[0], $sta);
                         if ($cha >= 1) {
                              if ($lin[2] == utf8_decode("Carteira de ações")){$tip = 1; }
                              if ($lin[2] == utf8_decode("Cota de PIBB")){$tip = 2; } 
                              if ($lin[2] == utf8_decode("DI de um dia")){$tip = 3; } 
                              if ($lin[2] == utf8_decode("Dólar comercial")){$tip = 4; } 
                              if ($lin[2] == utf8_decode("Euro")){$tip = 5; } 
                              if ($lin[2] == utf8_decode("Ibovespa")){$tip = 6; } 
                              if ($lin[2] == utf8_decode("IBrX")){$tip = 7; } 
                              if ($lin[2] == utf8_decode("IBrX-50")){$tip = 8; } 
                              if ($lin[2] == utf8_decode("IEE")){$tip = 9; } 
                              if ($lin[2] == utf8_decode("Índice de Mercado Andima Geral")){$tip = 10; } 
                              if ($lin[2] == utf8_decode("Índice de Mercado Andima LFT")){$tip = 11; } 
                              if ($lin[2] == utf8_decode("Índice de Mercado Andima NTN-B até 5 anos")){$tip = 12; } 
                              if ($lin[2] == utf8_decode("Índice de Mercado Andima NTN-B mais de 5 anos")){$tip = 13; } 
                              if ($lin[2] == utf8_decode("Índice de Mercado Andima todas NTN-B")){$tip = 14; } 
                              if ($lin[2] == utf8_decode("Índice de Mercado Andima todas NTN-C")){$tip = 15; } 
                              if ($lin[2] == utf8_decode("Índice de preços")){$tip = 16; } 
                              if ($lin[2] == utf8_decode("Índice de Preços ao Consumidor (IPC/FIPE)")){$tip = 17; } 
                              if ($lin[2] == utf8_decode("Índice de Preços ao Consumidor Amplo (IPCA/IBGE)")){$tip = 18; } 
                              if ($lin[2] == utf8_decode("Índice Geral de Preços-Disponibilidade Interna (IGP-DI)")){$tip = 19; }
                              if ($lin[2] == utf8_decode("Índice Geral de Preços-Mercado (IGP-M)")){$tip = 20; } 
                              if ($lin[2] == utf8_decode("Índice Nacional de Preços ao Consumidor (INPC/IBGE)")){$tip = 21; } 
                              if ($lin[2] == utf8_decode("IRF-M")){$tip = 22; } 
                              if ($lin[2] == utf8_decode("ITEL")){$tip = 23; } 
                              if ($lin[2] == utf8_decode("Ouro 250 gramas")){$tip = 24; } 
                              if ($lin[2] == utf8_decode("OUTROS")){$tip = 25; } 
                              if ($lin[2] == utf8_decode("Taxa Anbid")){$tip = 26; } 
                              if ($lin[2] == utf8_decode("Taxa Básica Financeira")){$tip = 27; } 
                              if ($lin[2] == utf8_decode("Taxa de Juro de Longo Prazo")){$tip = 28; } 
                              if ($lin[2] == utf8_decode("Taxa de juro prefixada")){$tip = 29; } 
                              if ($lin[2] == utf8_decode("Taxa Referencial")){$tip = 30; } 
                              if ($lin[2] == utf8_decode("Taxa Selic")){$tip = 31; } 
                              if ($tip >= 1) {
                                   $sql  = "update tb_fundos set ";
                                   $sql .= "funrentab = '". $tip . "', ";
                                   $sql .= "fundatainic = '". date('Y-m-d', strtotime($lin[3])) . "', ";
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
                    }
               }
               $pro = $pro + 1;
          }
          return $ret;
     }

     function processa_ind ($cam, $des, $ord, &$pro, &$gra, &$men, &$com) {
          $ret = 0; 
          $gra = 0; 
          $pro = 0; 
          $dat = '';
          $men = ''; $com = '';
          include_once "dados.php";
          $csv = fopen('upload/' . $cam, "r");  
          while (!feof ($csv)) {
               $key = 0; $cpo = 0;
               if ($_SESSION['wrknumcol'] == 2) {
                    $lin = explode(";", fgets($csv));     
                    $dat = inverte_dat(1,$lin[0]);   
                    $cpo = 1;
               } else {
                    $lin = explode(",", fgets($csv));        
                    $dat = $lin[0];
                    $cpo = 0;
               }
               if (is_numeric(substr($lin[0], 0, 1)) == true  ) {
                    $key = ler_indice($cpo, $dat);
               }
               if ($key == 0 && $dat != "Data" && $dat != "Date") {     
                    if (count($lin) >= 2 &&  date('Y', strtotime($dat)) >= 2015) {
                         $sql  = "insert into tb_indice (";
                         $sql .= "indcodigo, ";
                         $sql .= "indtipo, ";
                         $sql .= "inddata, ";
                         $sql .= "indtaxa, ";
                         $sql .= "indmes, ";
                         $sql .= "indano, ";
                         $sql .= "keyinc, ";
                         $sql .= "datinc ";
                         $sql .= ") value ( ";
                         $sql .= "'" . $cpo . "',";
                         $sql .= "'" . '1' . "',";     
                         $sql .= "'" . $dat . "',";     
                         if ($_SESSION['wrknumcol'] == 2) {
                              $ind = str_replace(",", ".", $lin[1]);
                              $sql .= "'" . str_replace(",", ".", $lin[1]) . "',";     
                         } else {
                              $ind = str_replace(",", ".", $lin[4]);
                              $sql .= "'" . str_replace(",", ".", $lin[4]) . "',";     
                         }
                         $sql .= "'" . date('m', strtotime($dat)) . "',";     
                         $sql .= "'" . date('Y', strtotime($dat)) . "',";     
                         $sql .= "'" . $_SESSION['wrkideusu'] . "',";
                         $sql .= "'" . date("Y-m-d H:i:s") . "')";
                         $ret = comando_tab($sql, $nro, $cha, $men);
                         if ($ret == false) {
                              $com = $sql;
                              $men = "Erro na gravação do registro de índice no banco de dados !";
                         }      
                         if ($_SESSION['wrknumcol'] == 2) {
                              $_SESSION['wrkcditax'] = $ind;
                              $_SESSION['wrkcdidat'] = $dat;
                         }   
                         $gra = $gra + 1;
                    }
               }
          $pro = $pro + 1;          
          }
          return $ret;
     }

?>

</html>
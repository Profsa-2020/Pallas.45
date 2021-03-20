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

     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

     <script type="text/javascript" language="javascript"
          src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
     <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

     <script type="text/javascript" language="javascript"
          src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
     <script type="text/javascript" language="javascript"
          src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>

     <script type="text/javascript" src="js/datepicker-pt-BR.js"></script>

     <script type="text/javascript" src="js/jquery.mask.min.js"></script>

     <link href="css/pallas45.css" rel="stylesheet" type="text/css" media="screen" />
     <title>Cálculos - Análise de Investimentos - Profsa Informátda Ltda</title>
</head>

<script>
$(function() {
     $("#cgc").mask("00.000.000/0000-00");
     $("#dti").mask("00/00/0000");
     $("#dtf").mask("00/00/0000");
     $("#dti").datepicker($.datepicker.regional["pt-BR"]);
     $("#dtf").datepicker($.datepicker.regional["pt-BR"]);
});

$(function() {
     $('#nom').autocomplete({
          source: "ajax/mostrar-nom.php",
          minLength: 7,
          select: function(event, ui) {
               $('#cod').val(ui.item.id);
               $('#cgc').val(ui.item.cnpj);
               $('#nom').val(ui.item.label);
          }
     });
});

$(document).ready(function() {
     $('#cgc').blur(function() {
          $('#tab-0 tbody').empty();
          if ($('#cgc').val() == "") {
               $('#nom').val('');
          };
     });

     $('#dti').change(function() {
          $('#tab-0 tbody').empty();
     });

     $('#dtf').change(function() {
          $('#tab-0 tbody').empty();
     });

     $('#dtf').blur(function() {
          let dti = $('#dti').val();
          let dtf = $('#dtf').val();
          if (dtf == "") { $('#dtf').val(dti); }
     });

     $("#cgc").blur(function() {
          var cgc = $('#cgc').val();
          if (cgc != "") {
               $.getJSON("ajax/verifica-cgc.php", {
                         cgc: cgc
                    })
                    .done(function(data) {
                         if (data.men != "") {
                              alert(data.men);
                              $('#cgc').val('');
                              $('#nom').val('');
                         } else {
                              $('#nom').val(data.nom);
                         }
                    }).fail(function(data) {
                         console.log('Erro: ' + JSON.stringify(data));
                         alert("Erro ocorrido no processamento de verificação do cnpj");
                    });
          }
     });

     $("#add").click(function() {
          var cgc = $('#cgc').val();
          var nom = $('#nom').val();
          if (cgc != "") {
               $.getJSON("ajax/adiciona-cgc.php", {
                         cgc: cgc,
                         nom: nom
                    })
                    .done(function(data) {
                         if (data.men != "") {
                              alert(data.men);
                         } else {
                              $('#cgc').val('');
                              $('#nom').val('');
                              $('#qtd').html(data.qtd);
                              $('#tab-0 tbody').empty();
                         }
                    }).fail(function(data) {
                         console.log('Erro: ' + JSON.stringify(data));
                         alert("Erro ocorrido no processamento de adição de cnpj");
                    });
          }
     });

     $("#del").click(function() {
          let res = confirm('Confirma limpar os Cnpj(s) informados até o momento ?');
          if (res == true) {
               $('#dti').val('');
               $('#dtf').val('');
               $('#cgc').val('');
               $('#nom').val('');
               $('#qtd').html('#');
               $('#tab-0 tbody').empty();
               $.get("ajax/limpar-cgc.php");
          }
     });

     $('#tab-0').DataTable({
          "pageLength": 25,
          "aaSorting": [
               [2, 'asc'],
               [0, 'asc']
          ],
          "dom": 'Bfrtip',
          "buttons": [{
               "extend": 'csv',
               "text": ' .CSV ',
               "fieldSeparator": ';'
          }],
          "language": {
               "lengthMenu": "Demonstrar _MENU_ linhas por páginas",
               "zeroRecords": "Não existe registros a demonstar ...",
               "info": "Mostrada página _PAGE_ de _PAGES_",
               "infoEmpty": "Sem registros para Análise ...",
               "sSearch": "Buscar:",
               "infoFiltered": "(Consulta de _MAX_ total de linhas)",
               "oPaginate": {
                    sFirst: "Primeiro",
                    sLast: "Último",
                    sNext: "Próximo",
                    sPrevious: "Anterior"
               }
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
     $err = 0;
     include_once "dados.php"; 
     include_once "profsa.php";
     $_SESSION['wrknompro'] = __FILE__;
     if (isset($_SERVER['HTTP_REFERER']) == true) {
          if (limpa_pro($_SESSION['wrknompro']) != limpa_pro($_SERVER['HTTP_REFERER'])) {
               $_SESSION['wrkproant'] = limpa_pro($_SERVER['HTTP_REFERER']);
               $ret = gravar_log(8, "Entrada na página de análise de fundos do sistema Pallas.45 - MoneyWay");  
          }
     }
     if (isset($_SESSION['wrkopereg']) == false) { $_SESSION['wrkopereg'] = 0; }
     if (isset($_SESSION['wrkcodreg']) == false) { $_SESSION['wrkcodreg'] = 0; }
     if (isset($_SESSION['wrklisfun']) == false) { $_SESSION['wrklisfun'] = array(); }
     if (isset($_REQUEST['ope']) == true) { $_SESSION['wrkopereg'] = $_REQUEST['ope']; }
     if (isset($_REQUEST['cod']) == true) { $_SESSION['wrkcodreg'] = $_REQUEST['cod']; }

     if ($_SESSION['wrkopereg'] == 8) {$_SESSION['wrklisfun'] = array(); }

     $cgc = (isset($_REQUEST['cgc']) == false ? '' : $_REQUEST['cgc']);
     $dti = (isset($_REQUEST['dti']) == false ? '' : $_REQUEST['dti']);
     $dtf = (isset($_REQUEST['dtf']) == false ? '' : $_REQUEST['dtf']);
     $nom = (isset($_REQUEST['nom']) == false ? '' : $_REQUEST['nom']);

     $qtd = count($_SESSION['wrklisfun']);

     if (isset($_REQUEST['consulta']) == true) {
          if ($dti == "" && $dtf == "" && $cgc == "" && count($_SESSION['wrklisfun'] ) == 0)  { 
               echo '<script>alert("Não se pode solicitar consulta sem nenhum campo informado !");</script>'; $err = 1;
          }
          if ($dti == "" && $dtf != "")  { 
               echo '<script>alert("Não se pode solicitar consulta sem nenhum campo informado !");</script>';$err = 1;
          }
          if ($dti != "" && $dtf == "")  { 
               echo '<script>alert("Não se pode solicitar consulta sem nenhum campo informado !");</script>';$err = 1;
          }
     }

?>

<body id="box00">
     <h1 class="cab-0">Analise - MoneyWay Investimentos</h1>
     <?php include_once "cabecalho-1.php"; ?>
     <div class="container-fluid">
          <div class="row">
               <div class="col-md-2">
                    <!-- Menu -->
                    <?php include_once "cabecalho-2.php"; ?>
               </div>
               <div class="col-md-10">
                    <!-- Corpo -->
                    <p class="lit-4">Análise e Exportação de Dados</p>
                    <form class="qua-6" id="frmTelAna" name="frmTelAna" action="analise-exp.php" method="POST">
                         <div class="row">
                              <div class="col-md-1 text-center">
                                   <label>Quantidade</label>
                                   <p id="qtd" class="lit-5"><?php echo $qtd; ?></p>
                              </div>
                              <div class="col-md-2">
                                   <label>Número do Cnpj </label>
                                   <input type="text" class="form-control text-center" maxlength="18" id="cgc"
                                        name="cgc" value="<?php echo $cgc; ?>" />
                              </div>
                              <div class="col-md-6 text-left">
                                   <label>Nome do Fundo</label>
                                   <span>
                                        <input type="text" class="form-control text-left" id="nom" name="nom"
                                             value="<?php echo $nom; ?>" />
                                   </span>
                              </div>
                              <div class="col-md-1 text-center">
                                   <br />
                                   <button type="button" id="add" name="adiciona" class="bot-2"
                                        title="Adiciona fundo a lista para ser efetuada consulta com calculos de análise."><i
                                             class="fa fa-indent fa-2x" aria-hidden="true"></i></button>
                              </div>
                              <div class="col-md-1 text-center">
                                   <br />
                                   <button type="button" id="del" name="limpar" class="bot-2"
                                        title="Limpa lista de número de Cnpj informados para efetuar consultas e calculos de análise."><i
                                             class="fa fa-trash fa-2x" aria-hidden="true"></i></button>
                              </div>
                              <div class="col-md-1 text-center">
                                   <br />
                                   <button type="submit" id="con" name="consulta" class="bot-2"
                                        title="Carrega dados do movimen to conforme parâmetros informados pelo usuário."><i
                                             class="fa fa-search fa-2x" aria-hidden="true"></i></button>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col-md-4"></div>
                              <div class="col-md-2">
                                   <label>Data Inicial</label>
                                   <input type="text" class="form-control text-center" maxlength="10" id="dti"
                                        name="dti" value="<?php echo $dti; ?>" />
                              </div>
                              <div class="col-md-2">
                                   <label>Data Final</label>
                                   <input type="text" class="form-control text-center" maxlength="10" id="dtf"
                                        name="dtf" value="<?php echo $dtf; ?>" />
                              </div>
                              <div class="col-md-4"></div>
                         </div>

                         <input type="hidden" id="cod" name="cod" value="" />
                    </form>
                    <br />
                    <div class="row qua-3">
                         <div class="col-md-12">
                              <div class="tab-1 table-responsive">
                                   <table id="tab-0" class="table table-sm">
                                        <thead>
                                             <tr>
                                                  <th>Seq</th>
                                                  <th>Nro do C.n.p.j.</th>
                                                  <th>Nome do Fundo</th>
                                                  <th>Classe</th>
                                                  <th>Data</th>
                                                  <th>Cota Diaria</th>
                                                  <th>Patrimonio</th>
                                                  <th>Nro Cotistas</th>
                                                  <th>Índice Usado</th>
                                                  <th class="text-center">Retorno 3 anos (a.a%)</th>
                                                  <th class="text-center">Retorno 3 anos - CDI (a.a%)</th>
                                                  <th>Mediana</th>
                                                  <th>Media</th>
                                                  <th>Maximo</th>
                                                  <th>Minimo</th>
                                                  <th class="text-center">% acima do CDI</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             <?php
                                                  $ret = carrega_fun($err, $dti, $dtf, $cgc, $nom);
                                             ?>
                                        </tbody>
                                   </table>
                                   <hr />
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div id="box10">
          <img class="subir" src="img/subir.png" title="Volta a página para o seu topo." />
     </div>
</body>

<?php
function carrega_fun($err, $dti, $dtf, $cgc, $nom) { 
     $seq = 1; $ind = 0; $mdn = 0; $som = 0; $med = 0; $max = 0; $min = 999999; $cdi_n = 0; $cdi_t = 0; $lis_t = array();
     include_once "dados.php";
     include_once "profsa.php";
     if ($err == 1)  { return 1; }
     if ($dti == "" && $dtf == "" && $cgc == "" && count($_SESSION['wrklisfun']) == 0)  { return 2; }
     $ret = 0; $txt = ""; $sql = ""; $cha = "";
     $dti = substr($dti,6,4) . "-" . substr($dti,3,2) . "-" . substr($dti,0,2) . " 00:00:00";
     $dtf = substr($dtf,6,4) . "-" . substr($dtf,3,2) . "-" . substr($dtf,0,2) . " 23:59:59";
     foreach($_SESSION['wrklisfun'] as $cpo => $dad ) {
          $sql .= $cpo . ",";
     }
     if ($sql == "") {
          $sql = limpa_nro($cgc);
     } else {
          $sql = substr($sql, 0, strlen($sql) - 1);
     }     
     $com = "Select M.*, F.funnome, F.fundatainic, F.funclasse from (tb_movto_id M left join tb_fundos F on M.idfundo = F.idfundo) where idmovto > 0 ";
     if ($sql != "0") {
          $com .= " and inffundo in (" . $sql . ") ";
     }
     if ($dti != "" && $dtf != "" && $dti != "-- 00:00:00" && $dtf != "-- 23:59:59") {
          $com .= " and infdata between '" . $dti . "' and '" . $dtf . "' ";
     }
     $com .= " order by M.infdata, M.inffundo";
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $cpo => $lin) {
          $txt = ""; 
          $txt .=  '<tr>'; 
          $txt .= '<td class="text-center">' . $seq . '</td>';
          $txt .= '<td>' . mascara_cpo($lin['inffundo'],"  .   .   /    -  ") . '</td>';
          $txt .= '<td>' . utf8_encode($lin['funnome']) . '</td>';
          $cpo = "*** " . $lin['funclasse'] . ' ***';
          if ($lin['funclasse'] == "") { $cpo = ''; }
          if ($lin['funclasse'] == "0") { $cpo = 'Indefinida'; }
          if ($lin['funclasse'] == "1") { $cpo = 'Cambial'; }
          if ($lin['funclasse'] == "2") { $cpo = 'Dívida Externa'; }
          if ($lin['funclasse'] == "3") { $cpo = 'Ações'; }
          if ($lin['funclasse'] == "4") { $cpo = 'Curto Prazo'; }
          if ($lin['funclasse'] == "5") { $cpo = 'Renda Fixa'; }
          if ($lin['funclasse'] == "6") { $cpo = 'Multimercado'; }
          if ($lin['funclasse'] == "7") { $cpo = 'Referenciado'; }
          $txt .= "<td>" . $cpo . "</td>"; 
          if ($lin['infdata'] == null) {
               $txt .= '<td>' . "**/**/****" . '</td>'; 
          } else {
               $txt .= '<td>' . date('d/m/Y',strtotime($lin['infdata'])) . '</td>';
          }
          $txt .= '<td class="text-right">' . number_format($lin['infquota'], 4, ",", ".") . '</td>';
          $txt .= '<td class="text-right">' . number_format($lin['infpatrimonio'], 2, ",", ".") . '</td>';
          $txt .= '<td class="text-center">' . number_format($lin['infnumcotas'], 0, ",", ".") . '</td>';

          $cdi = cdi_indice($lin['infdata'], $dta); // Pega CDI da mesma data

          $ind = ler_indice(0, $lin['inffundo'], $lin['infdata'], $dat); $cal = 0;
          if ($ind != 0) {
               $cal = (pow(($lin['infquota'] / $ind), 0.333333) - 1) * 100;     // função para calculo de potência (elevado a)
          }
          $txt .= '<td class="text-center">' . number_format($ind, 8, ",", ".") . '<br />' . date('d/m/Y',strtotime($dat)) . '</td>'; 
          $txt .= '<td class="text-right">' . number_format($cal, 8, ",", ".") . '</td>'; 
          $txt .= '<td class="text-right">' . number_format($cal - $cdi, 8, ",", ".") . '</td>'; 
          if ($cal != 0) {
               $lis_t[] = array(round($cal, 8), $seq);
               $lis_c = count($lis_t);
               $nro = round($lis_c / 2, 0) - 1;
               $mdn = $lis_t[$nro][0];
               $som = $som + $cal; $med = $som / $seq; $seq = $seq + 1;
               if ($cal < $min) { $min = $cal; }
               if ($cal > $max) { $max = $cal; }                    
          }
          $txt .= '<td class="text-right">' . number_format($mdn, 8, ",", ".") . '</td>';
          $txt .= '<td class="text-right">' . number_format($med, 8, ",", ".") . '</td>';
          $txt .= '<td class="text-right">' . number_format($max, 8, ",", ".") . '</td>';
          if ($min == 999999) {
               $txt .= '<td class="text-right">' . '0,000000' . '</td>';
          } else {
               $txt .= '<td class="text-right">' . number_format($min, 8, ",", ".") . '</td>';
          }
          $cdi_t = $cdi_t + 1; 
          if (($cal - $cdi) > 0) { $cdi_n = $cdi_n + 1; }
          $txt .= '<td class="text-center">' . number_format($cdi_n / $cdi_t * 100, 0, ",", ".") . '</td>';
          $txt .=  '</tr>'; 
          echo $txt; 
     }
     $_SESSION['wrklisfun'] = array();
     return $ret;
}

function ler_indice($tip, $cgc, $dat, &$dia) {
     $ind = 0; $dia = 0; $dia = "**/**/****";
     include_once "dados.php";
     if ($tip == 0) { $dia = 1095; }
     $dat = date('Y-m-d', strtotime('-' . $dia . ' days', strtotime($dat)));
     $nro = acessa_reg("Select idmovto, infquota, infdata from tb_movto_id where inffundo = '" . $cgc . "' and infdata >= '" . $dat . "' order by infdata, idmovto Limit 1", $reg);            
     if ($nro == 1) {
          $ind = $reg['infquota'];
          $dia = date('d/m/Y',strtotime($reg['infdata']));
     }
     return $ind;
}

function cdi_indice($dat, &$dia) {
     include_once "dados.php";
     $ind = 0; $dia = 0; $dia = "**/**/****";
     $nro = acessa_reg("Select idindice, inddata, indtaxa from tb_indice where indcodigo = 1 and inddata = '" . $dat . "'", $reg);            
     if ($nro == 1) {
          $ind = $reg['indtaxa'];
          $dia = date('d/m/Y',strtotime($reg['inddata']));
     }
     return $ind;
}

?>

</html>
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
     <title>Fundos - Análise de Investimentos - MoneyWay</title>
</head>

<script>
$(document).ready(function() {
     $('#exc').change(function() {
          $('#tab-0 tbody').empty();
     });

     $('#nor').change(function() {
          $('#tab-0 tbody').empty();
     });

     $('#cot').change(function() {
          $('#tab-0 tbody').empty();
     });

     $('#dia').change(function() {
          $('#tab-0 tbody').empty();
     });

     $('#cla').change(function() {
          $('#tab-0 tbody').empty();
     });

     $('#pub').change(function() {
          $('#tab-0 tbody').empty();
     });

     $('#esp').change(function() {
          $('#tab-0 tbody').empty();
     });

     $('#con').change(function() {
          $('#tab-0 tbody').empty();
     });

     $('#tem').change(function() {
          $('#tab-0 tbody').empty();
     });

     $('#pat').change(function() {
          $('#tab-0 tbody').empty();
     });

     $('#anb').change(function() {
          $('#tab-0 tbody').empty();
     });

     /* https://datatables.net/reference/button/csv */

     $('#tab-0').DataTable({
          "pageLength": 25,
          "aaSorting": [
               [0, 'asc'],
               [1, 'asc']
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
               "infoEmpty": "Sem registros de Fundos ...",
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
     include_once "dados.php"; 
     include_once "profsa.php";
     $_SESSION['wrknompro'] = __FILE__;
     if (isset($_SERVER['HTTP_REFERER']) == true) {
          if (limpa_pro($_SESSION['wrknompro']) != limpa_pro($_SERVER['HTTP_REFERER'])) {
               $_SESSION['wrkproant'] = limpa_pro($_SERVER['HTTP_REFERER']);
               $ret = gravar_log(8, "Entrada na página de consulta de fundos do sistema Pallas.45 - MoneyWay");  
          }
     }
     $cla = (isset($_REQUEST['cla']) == false ? 0 : $_REQUEST['cla']);
     $pub = (isset($_REQUEST['pub']) == false ? '' : $_REQUEST['pub']);
     $esp = (isset($_REQUEST['esp']) == false ? '' : $_REQUEST['esp']);
     $con = (isset($_REQUEST['con']) == false ? 'A' : $_REQUEST['con']);
     $tem = (isset($_REQUEST['tem']) == false ? '' : $_REQUEST['tem']);
     $pat = (isset($_REQUEST['pat']) == false ? 0 : $_REQUEST['pat']);
     $anb = (isset($_REQUEST['anb']) == false ? '' : $_REQUEST['anb']);
     $nor = (isset($_REQUEST['nor']) == false ? "0" : $_REQUEST['nor']);
     $exc = (isset($_REQUEST['exc']) == false ? "0" : $_REQUEST['exc']);
     $cot = (isset($_REQUEST['cot']) == false ? "S" : $_REQUEST['cot']);
     $dia = (isset($_REQUEST['dia']) == false ? "S" : $_REQUEST['dia']);

?>

<body id="box00">
     <h1 class="cab-0">Fundos - MoneyWay Investimentos - Profsa Informática</h1>
     <?php include_once "cabecalho-1.php"; ?>
     <div class="container-fluid">
          <div class="form-row">
               <div class="col-md-2">
                    <!-- Menu -->
                    <?php include_once "cabecalho-2.php"; ?>
               </div>
               <div class="col-md-10">
                    <!-- Corpo -->
                    <p class="lit-4">Consulta de Fundos -
                         <?php echo  number_format(numero_reg('tb_fundos'), 0, ",", "."); ?></p>
                    <form class="qua-6" id="frmTelCon" name="frmTelCon" action="con-fundos.php" method="POST">
                         <div class="row">
                         <div class="col-md-2">
                                   <label>Classes</label><br />
                                   <select id="cla" name="cla" class="form-control">
                                        <option value="0" <?php echo ($cla != 0 ? '' : 'selected="selected"'); ?>>
                                             Todas ...</option>
                                        <option value="1" <?php echo ($cla != 1 ? '' : 'selected="selected"'); ?>>
                                             Fundo Cambial (CDI)
                                        </option>
                                        <option value="2" <?php echo ($cla != 2 ? '' : 'selected="selected"'); ?>>
                                             Fundo da Dívida Externa
                                        </option>
                                        <option value="3" <?php echo ($cla != 3 ? '' : 'selected="selected"'); ?>>
                                             Fundo de Açoes (iBovespa)
                                        </option>
                                        <option value="4" <?php echo ($cla != 4 ? '' : 'selected="selected"'); ?>>
                                             Fundo de Curto Prazo
                                        </option>
                                        <option value="5" <?php echo ($cla != 5 ? '' : 'selected="selected"'); ?>>
                                             Fundo de Renda Fixa
                                        </option>
                                        <option value="6" <?php echo ($cla != 6 ? '' : 'selected="selected"'); ?>>
                                             Fundo Multimercado
                                        </option>
                                        <option value="7" <?php echo ($cla != 7 ? '' : 'selected="selected"'); ?>>
                                             Fundo Referenciado
                                        </option>
                                   </select>
                              </div>
                              <div class="col-md-2">
                                   <label>Tempo</label><br />
                                   <select id="tem" name="tem" class="form-control">
                                        <option value="0" <?php echo ($tem != '0' ? '0' : 'selected="selected"'); ?>>
                                             Todos ...</option>
                                        <option value="2" <?php echo ($tem != '2' ? '' : 'selected="selected"'); ?>>
                                             + de 2 anos
                                        </option>
                                        <option value="5" <?php echo ($tem != '5' ? '' : 'selected="selected"'); ?>>
                                             + de 5 anos
                                        </option>
                                        <option value="7" <?php echo ($tem != '7' ? '' : 'selected="selected"'); ?>>
                                             + de 7 anos
                                        </option>
                                        <option value="10" <?php echo ($tem != '10' ? '' : 'selected="selected"'); ?>>
                                             + de 10 anos
                                        </option>
                                        <option value="15" <?php echo ($tem != '15' ? '' : 'selected="selected"'); ?>>
                                             + de 15 anos
                                        </option>
                                   </select>
                              </div>
                              <div class="col-md-2">
                                   <label>Estratégia</label>
                                   <select id="anb" name="anb" class="form-control">
                                        <option value="" <?php echo ($anb != '' ? '' : 'selected="selected"'); ?>>
                                             Todas ...</option>
                                        <option value="A" <?php echo ($anb != 'A' ? '' : 'selected="selected"'); ?>>
                                             Ações
                                        </option>
                                        <option value="F" <?php echo ($anb != 'F' ? '' : 'selected="selected"'); ?>>
                                             Fundo Cambial
                                        </option>
                                        <option value="M" <?php echo ($anb != 'M' ? '' : 'selected="selected"'); ?>>
                                             Multimercado
                                        </option>
                                        <option value="P" <?php echo ($anb != 'P' ? '' : 'selected="selected"'); ?>>
                                             Previdenciária
                                        </option>
                                        <option value="R" <?php echo ($anb != 'R' ? '' : 'selected="selected"'); ?>>
                                             Renda Fixa
                                        </option>
                                   </select>
                              </div>
                              <div class="col-md-2">
                                   <label>Público</label><br />
                                   <select id="pub" name="pub" class="form-control">
                                        <option value="" <?php echo ($pub != '' ? '' : 'selected="selected"'); ?>>
                                             Todas ...</option>
                                        <option value="A" <?php echo ($pub != 'A' ? '' : 'selected="selected"'); ?>>
                                             Profissionais
                                        </option>
                                        <option value="B" <?php echo ($pub != 'B' ? '' : 'selected="selected"'); ?>>
                                             Qualificados
                                        </option>
                                        <option value="C" <?php echo ($pub != 'C' ? '' : 'selected="selected"'); ?>>
                                             Previdenciário
                                        </option>
                                        <option value="D" <?php echo ($pub != 'D' ? '' : 'selected="selected"'); ?>>
                                             Geral
                                        </option>
                                   </select>
                              </div>
                              <div class="col-md-2">
                                   <label>Espelho</label><br />
                                   <select id="esp" name="esp" class="form-control">
                                        <option value="" <?php echo ($esp != '' ? '' : 'selected="selected"'); ?>>
                                             Todas ...</option>
                                        <option value="S" <?php echo ($esp != 'S' ? '' : 'selected="selected"'); ?>>
                                             Sim
                                        </option>
                                        <option value="N" <?php echo ($esp != 'N' ? '' : 'selected="selected"'); ?>>
                                             Não
                                        </option>
                                   </select>
                              </div>
                              <div class="col-md-2 text-center">
                                   <br />
                                   <button type="submit" id="con" name="consulta" class="bot-2"
                                        title="Carrega dados do movimen to conforme parâmetros informados pelo usuário."><i
                                             class="fa fa-search fa-2x" aria-hidden="true"></i></button>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col-md-2">
                                   <label>Exclusivo</label><br />
                                   <select id="exc" name="exc" class="form-control">
                                        <option value="" <?php echo ($exc != '' ? '' : 'selected="selected"'); ?>>
                                             Todos ...</option>
                                        <option value="1" <?php echo ($exc != '1' ? '' : 'selected="selected"'); ?>>
                                             Sim
                                        </option>
                                        <option value="0" <?php echo ($exc != '0' ? '' : 'selected="selected"'); ?>>
                                             Não
                                        </option>
                                   </select>
                              </div>
                              <div class="col-md-2">
                                   <label>Funcionamento</label><br />
                                   <select id="nor" name="nor" class="form-control">
                                        <option value="" <?php echo ($nor != '' ? '' : 'selected="selected"'); ?>>
                                             Todos ...</option>
                                        <option value="0" <?php echo ($nor != '0' ? '' : 'selected="selected"'); ?>>
                                             Normal
                                        </option>
                                        <option value="1" <?php echo ($nor != '1' ? '' : 'selected="selected"'); ?>>
                                             Não Normal
                                        </option>
                                   </select>
                              </div>
                              <div class="col-md-2">
                                   <label>Cota Diária</label><br />
                                   <select id="dia" name="dia" class="form-control">
                                        <option value="" <?php echo ($dia != '' ? '' : 'selected="selected"'); ?>>
                                             Todos ...</option>
                                        <option value="S" <?php echo ($dia != 'S' ? '' : 'selected="selected"'); ?>>
                                             Sim
                                        </option>
                                        <option value="N" <?php echo ($dia != 'N' ? '' : 'selected="selected"'); ?>>
                                             Não 
                                        </option>
                                   </select>
                              </div>
                              <div class="col-md-2">
                                   <label>Fundo de Cotas</label><br />
                                   <select id="cot" name="cot" class="form-control">
                                        <option value="" <?php echo ($cot != '' ? '' : 'selected="selected"'); ?>>
                                             Todos ...</option>
                                        <option value="S" <?php echo ($cot != 'S' ? '' : 'selected="selected"'); ?>>
                                             Sim
                                        </option>
                                        <option value="N" <?php echo ($cot != 'N' ? '' : 'selected="selected"'); ?>>
                                             Não 
                                        </option>
                                   </select>
                              </div>
                              <div class="col-md-2">
                                   <label>Patrimônio</label><br />
                                   <select id="pat" name="pat" class="form-control">
                                        <option value="0" <?php echo ($pat != '0' ? '' : 'selected="selected"'); ?>>
                                             Todos ...</option>
                                        <option value="10000000"
                                             <?php echo ($pat != '1' ? '' : 'selected="selected"'); ?>>
                                             + de 10 milhões</option>
                                        <option value="50000000"
                                             <?php echo ($pat != '2' ? '' : 'selected="selected"'); ?>>
                                             + de 50 milhões</option>
                                        <option value="100000000"
                                             <?php echo ($pat != '3' ? '' : 'selected="selected"'); ?>>
                                             + de 100 milhões</option>
                                        <option value="200000000"
                                             <?php echo ($pat != '4' ? '' : 'selected="selected"'); ?>>
                                             + de 200 milhões</option>
                                        <option value="500000000"
                                             <?php echo ($pat != '5' ? '' : 'selected="selected"'); ?>>
                                             + de 500 milhões</option>
                                        <option value="1000000000"
                                             <?php echo ($pat != '6' ? '' : 'selected="selected"'); ?>>
                                             + de 1 bilhão</option>
                                   </select>
                              </div>
                              <div class="col-md-2">
                                   <label>Condomínio</label><br />
                                   <select id="con" name="con" class="form-control">
                                        <option value="" <?php echo ($con != '' ? '' : 'selected="selected"'); ?>>
                                             Todos ...</option>
                                        <option value="A" <?php echo ($con != 'A' ? '' : 'selected="selected"'); ?>>
                                             Aberto</option>
                                        <option value="F" <?php echo ($con != 'F' ? '' : 'selected="selected"'); ?>>
                                             Fechado</option>
                                   </select>
                              </div>
                         </div>
                    </form>
                    <br />
                    <div class="row qua-3">
                         <div class="col-md-12">
                              <br />
                              <div class="tab-1 table-responsive">
                                   <table id="tab-0" class="table table-sm table-striped">
                                        <thead>
                                             <tr>
                                                  <th>Nome do Fundo</th>
                                                  <th>C.N.P.J.</th>
                                                  <th>Exc</th>
                                                  <th>Nor</th>
                                                  <th>Classe</th>
                                                  <th class="text-center">Início</th>
                                                  <th class="text-center">Patrimônio Líquido</th>
                                                  <th>Público</th>
                                                  <th>Espelho</th>
                                                  <th>Condomínio</th>
                                                  <th>Aplicação Mínima</th>
                                                  <th>Estratégia</th>
                                                  <th class="text-center">Cota Diária</th>
                                                  <th class="text-center">Fundo Cotas</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             <?php $ret = carrega_fun($cla, $pub, $esp, $con, $tem, $pat, $anb, $nor, $exc, $cot, $dia);  ?>
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
function carrega_fun($cla, $pub, $esp, $con, $tem, $pat, $anb, $nor, $exc, $cot, $dia) {
     include_once "dados.php";
     include_once "profsa.php";
     $dti = date('01/01/2000');
     $dtf = date('d/m/Y');
     if ($tem != 0) {
          if ($tem == 2) { $dtf = date('d/m/Y', strtotime('-2 year')); }
          if ($tem == 5) { $dtf= date('d/m/Y', strtotime('-5 year')); }
          if ($tem == 7) { $dtf = date('d/m/Y', strtotime('-7 year')); }
          if ($tem == 10) { $dtf = date('d/m/Y', strtotime('-10 year')); }
          if ($tem == 15) { $dtf = date('d/m/Y', strtotime('-15 year')); }
     }
     $com = "Select idfundo, funexclusivo, funnormal, funnome, funcnpj, funclasse, fundatainic, funpubalvo, funespelho, funcondominio, funaplminima, funclaambima, funcotas, funatuadiaria from tb_fundos where idfundo > 0";
     if ($cla != 0) { $com .= " and funclasse = " . $cla; }
     if ($esp != '') { $com .= " and funespelho = '" . $esp . "'"; }
     if ($pub != '') { $com .= " and funpubalvo = '" . $pub . "'"; }
     if ($con != '') { $com .= " and funcondominio = '" . $con . "'"; }
     if ($anb != '') { $com .= " and funclaambima = '" . $anb . "'"; }
     if ($exc != '') { $com .= " and funexclusivo = '" . $exc . "'"; }
     if ($nor != '') { $com .= " and funnormal = '" . $nor . "'"; }
     if ($cot != '') { $com .= " and funcotas = '" . $cot . "'"; }          // Cota Diária
     if ($dia != '') { $com .= " and funatuadiaria = '" . $dia . "'"; }     // Fundo de Cotas
     if ($tem != 0) { $com .= " and fundatainic between '" . inverte_dat(1, $dti) . "' and '" . inverte_dat(1, $dtf) . "' "; } // ou datainic
     $com .= " order by funnome, idfundo";
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $lin) {
          $flag = 0; $ida = 0;
          if ($lin['fundatainic'] != null) {
               $ida = calcula_idade($lin['fundatainic']);
          }
          $ret = patrimonio_liq($lin['idfundo'], $dat, $val);
          if ($tem != 0) {
               if ($ida < $tem) { $flag = 1; }
          }
          if ($pat != "") {
               if (limpa_vlo($val) < $pat) { $flag = 1; }
          }
          if ($flag == 0) {
               $txt =  '<tr>'; 
               $txt .= "<td>" . utf8_encode($lin['funnome']) . "</td>";
               $txt .= "<td>" . mascara_cpo($lin['funcnpj'],"  .   .   /    -  ") . "</td>";
               $txt .= '<td class="text-center">' . ($lin['funexclusivo'] == 0 ? 'Não' : 'Sim') . '</td>';
               $txt .= '<td class="text-center">' . ($lin['funnormal'] == 1 ? 'Não' : 'Sim') . '</td>';
               $cpo = "*** " . $lin['funclasse'] . ' ***';
               if ($lin['funclasse'] == "") { $cpo = ''; }
               if ($lin['funclasse'] == "0") { $cpo = 'Indefinida'; }
               if ($lin['funclasse'] == "1") { $cpo = 'Fundo Cambial'; }
               if ($lin['funclasse'] == "2") { $cpo = 'Fundo da Dívida Externa'; }
               if ($lin['funclasse'] == "3") { $cpo = 'Fundo de Ações'; }
               if ($lin['funclasse'] == "4") { $cpo = 'Fundo de Curto Prazo'; }
               if ($lin['funclasse'] == "5") { $cpo = 'Fundo de Renda Fixa'; }
               if ($lin['funclasse'] == "6") { $cpo = 'Fundo Multimercado'; }
               if ($lin['funclasse'] == "7") { $cpo = 'Fundo Referenciado'; }
               $txt .= "<td>" . $cpo . "</td>"; 
               if ($lin['fundatainic'] == null) {
                    $txt .= "<td>" . "" . "</td>"; 
               } else {
                    $txt .= '<td class="text-center">' . date('d/m/Y',strtotime($lin['fundatainic'])) . '<br />' . $ida . ' anos' . '</td>';
               }
               $txt .= '<td class="text-center">' . $val . '<br />' . $dat. '</td>';
               $cpo = "*** " . $lin['funpubalvo'] . ' ***';
               if ($lin['funpubalvo'] == "") { $cpo = ''; }
               if ($lin['funpubalvo'] == "A") { $cpo = 'Profissionais'; }
               if ($lin['funpubalvo'] == "B") { $cpo = 'Qualificados'; }
               if ($lin['funpubalvo'] == "C") { $cpo = 'Previdenciário'; }
               if ($lin['funpubalvo'] == "D") { $cpo = 'Geral'; }
               $txt .= "<td>" . $cpo . "</td>"; 
               $cpo = "***";
               if (trim($lin['funespelho']) == "") { $cpo = '***'; }
               if ($lin['funespelho'] == "S") { $cpo = 'Sim'; }
               if ($lin['funespelho'] == "N") { $cpo = 'Não'; }
               $txt .= '<td class="text-center">' . $cpo . '</td>'; 
               $txt .= '<td class="text-center">' . ($lin['funcondominio'] == "A" ? 'Aberto' : 'Fechado' ) . "</td>";
               $txt .= '<td class="text-right">' . number_format($lin['funaplminima'], 2, ",", ".") . '</td>';
               $cpo = "*** " . $lin['funclaambima'] . ' ***';
               if ($lin['funclaambima'] == "") { $cpo = ''; }
               if ($lin['funclaambima'] == "A") { $cpo = 'Açoes'; }
               if ($lin['funclaambima'] == "C") { $cpo = 'Cambial'; }
               if ($lin['funclaambima'] == "M") { $cpo = 'Multimercado'; }
               if ($lin['funclaambima'] == "R") { $cpo = 'Renda Fixa'; }
               if ($lin['funclaambima'] == "P") { $cpo = 'Previdência'; }
               if ($lin['funclaambima'] == "F") { $cpo = 'Fundo Cambial'; }
               $txt .= "<td>" . $cpo . "</td>"; 
               $txt .= '<td class="text-center">' . ($lin['funatuadiaria'] == "N" ? 'Não' : 'Sim' ) . "</td>";
               $txt .= '<td class="text-center">' . ($lin['funcotas'] == "N" ? 'Não' : 'Sim' ) . "</td>";
               $txt .= "</tr>";
               echo $txt;
          }
     }
}

function patrimonio_liq($cod, &$dat, &$val) {
     include_once "dados.php";
     $ret = 0; $dat = '**/**/****'; $val = '0';
     $com = "Select infdata, infpatrimonio from tb_movto_id where idfundo = " . $cod . " order by infdata";
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $lin) {
          $dat = date('d/m/Y',strtotime($lin['infdata']));
          $val = number_format($lin['infpatrimonio'], 2, ",", ".");
     }
     return $ret;
}

?>

</html>
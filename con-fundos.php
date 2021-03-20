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

     $('#cnd').change(function() {
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

     $("#limpa").click(function() {
          $('#cla').val(1);
          $('#tem').val(0);
          $('#anb').val('');
          $('#pub').val('');
          $('#esp').val('');
          $('#exc').val('');
          $('#cot').val('');
          $('#pat').val(0);
          $('#dia').val('');
          $('#nor').val('');
          $('#cnd').val('');
          $('#tab-0 tbody').empty();
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
     if (isset($_SESSION['wrklisfun']) == false) { $_SESSION['wrklisfun'] = array(); }
     $cla = (isset($_REQUEST['cla']) == false ? 0 : $_REQUEST['cla']);
     $pub = (isset($_REQUEST['pub']) == false ? '' : $_REQUEST['pub']);
     $esp = (isset($_REQUEST['esp']) == false ? '' : $_REQUEST['esp']);
     $cnd = (isset($_REQUEST['cnd']) == false ? 'A' : $_REQUEST['cnd']);
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
                                        <option value="01" <?php echo ($anb != '01' ? '' : 'selected="selected"'); ?>>
                                             EM BRANCO (Não Informado ...)</option>
                                        <option value="02" <?php echo ($anb != '02' ? '' : 'selected="selected"'); ?>>
                                             AÇÕES - ATIVO - DIVIDENDOS</option>
                                        <option value="03" <?php echo ($anb != '03' ? '' : 'selected="selected"'); ?>>
                                             AÇÕES - ATIVO - ÍNDICE ATIVO</option>
                                        <option value="04" <?php echo ($anb != '04' ? '' : 'selected="selected"'); ?>>
                                             AÇÕES - ATIVO - LIVRE</option>
                                        <option value="05" <?php echo ($anb != '05' ? '' : 'selected="selected"'); ?>>
                                             AÇÕES - ATIVO - SETORIAIS</option>
                                        <option value="06" <?php echo ($anb != '06' ? '' : 'selected="selected"'); ?>>
                                             AÇÕES - ATIVO - SMALL CAPS</option>
                                        <option value="07" <?php echo ($anb != '07' ? '' : 'selected="selected"'); ?>>
                                             AÇÕES - ATIVO - SUSTENTABILIDADE </option> GOVERNANÇA</option>
                                        <option value="08" <?php echo ($anb != '08' ? '' : 'selected="selected"'); ?>>
                                             AÇÕES - ATIVO - VALOR </option> CRESCIMENTO</option>
                                        <option value="09" <?php echo ($anb != '09' ? '' : 'selected="selected"'); ?>>
                                             AÇÕES - FUNDOS FECHADOS</option>
                                        <option value="10" <?php echo ($anb != '10' ? '' : 'selected="selected"'); ?>>
                                             AÇÕES - INDEXADO - ÍNDICE PASSIVO</option>
                                        <option value="11" <?php echo ($anb != '11' ? '' : 'selected="selected"'); ?>>
                                             AÇÕES - INVESTIMENTO NO EXTERIOR</option>
                                        <option value="12" <?php echo ($anb != '12' ? '' : 'selected="selected"'); ?>>
                                             AÇÕES - MONO AÇÃO</option>
                                        <option value="13" <?php echo ($anb != '13' ? '' : 'selected="selected"'); ?>>
                                             FUNDO CAMBIAL</option>
                                        <option value="14" <?php echo ($anb != '14' ? '' : 'selected="selected"'); ?>>
                                             MULTIMERCADO - ALOCAÇÃO - BALANCEADOS</option>
                                        <option value="15" <?php echo ($anb != '15' ? '' : 'selected="selected"'); ?>>
                                             MULTIMERCADO - ALOCAÇÃO - DINÂMICOS</option>
                                        <option value="16" <?php echo ($anb != '16' ? '' : 'selected="selected"'); ?>>
                                             MULTIMERCADO - ESTRATÉGIA - CAPITAL PROTEGIDO</option>
                                        <option value="17" <?php echo ($anb != '17' ? '' : 'selected="selected"'); ?>>
                                             MULTIMERCADO - ESTRATÉGIA - ESTRATÉGIA ESPECÍFICA</option>
                                        <option value="18" <?php echo ($anb != '18' ? '' : 'selected="selected"'); ?>>
                                             MULTIMERCADO - ESTRATÉGIA - JUROS E MOEDAS</option>
                                        <option value="19" <?php echo ($anb != '19' ? '' : 'selected="selected"'); ?>>
                                             MULTIMERCADO - ESTRATÉGIA - LIVRE</option>
                                        <option value="20" <?php echo ($anb != '20' ? '' : 'selected="selected"'); ?>>
                                             MULTIMERCADO - ESTRATÉGIA - LONG & SHORT DIRECIONAL</option>
                                        <option value="21" <?php echo ($anb != '21' ? '' : 'selected="selected"'); ?>>
                                             MULTIMERCADO - ESTRATÉGIA - LONG & SHORT NEUTRO</option>
                                        <option value="22" <?php echo ($anb != '22' ? '' : 'selected="selected"'); ?>>
                                             MULTIMERCADO - ESTRATÉGIA - MACRO</option>
                                        <option value="23" <?php echo ($anb != '23' ? '' : 'selected="selected"'); ?>>
                                             MULTIMERCADO - ESTRATÉGIA - TRADING</option>
                                        <option value="24" <?php echo ($anb != '24' ? '' : 'selected="selected"'); ?>>
                                             MULTIMERCADO - INVESTIMENTO NO EXTERIOR</option>
                                        <option value="25" <?php echo ($anb != '25' ? '' : 'selected="selected"'); ?>>
                                             PREVIDÊNCIA - AÇÕES ATIVO</option>
                                        <option value="26" <?php echo ($anb != '26' ? '' : 'selected="selected"'); ?>>
                                             PREVIDÊNCIA - BALANCEADOS - ACIMA DE 49</option>
                                        <option value="27" <?php echo ($anb != '27' ? '' : 'selected="selected"'); ?>>
                                             PREVIDÊNCIA - BALANCEADOS - DE 30-49</option>
                                        <option value="28" <?php echo ($anb != '28' ? '' : 'selected="selected"'); ?>>
                                             PREVIDÊNCIA - MULTIMERCADOS LIVRE</option>
                                        <option value="29" <?php echo ($anb != '29' ? '' : 'selected="selected"'); ?>>
                                             PREVIDÊNCIA - RF DURAÇÃO BAIXA - GRAU DE INVESTIMENTO</option>
                                        <option value="30" <?php echo ($anb != '30' ? '' : 'selected="selected"'); ?>>
                                             PREVIDÊNCIA - RF DURAÇÃO LIVRE - GRAU DE INVESTIMENTO</option>
                                        <option value="31" <?php echo ($anb != '31' ? '' : 'selected="selected"'); ?>>
                                             PREVIDÊNCIA - RF DURAÇÃO LIVRE - SOBERANO</option>
                                        <option value="32" <?php echo ($anb != '32' ? '' : 'selected="selected"'); ?>>
                                             PREVIDÊNCIA - RF DURAÇÃO MÉDIA - GRAU DE INVESTIMENTO</option>
                                        <option value="33" <?php echo ($anb != '33' ? '' : 'selected="selected"'); ?>>
                                             PREVIDÊNCIA - RF INDEXADOS</option>
                                        <option value="34" <?php echo ($anb != '34' ? '' : 'selected="selected"'); ?>>
                                             PREVIDÊNCIA AÇÕES</option>
                                        <option value="35" <?php echo ($anb != '35' ? '' : 'selected="selected"'); ?>>
                                             PREVIDÊNCIA BALANCEADOS - ACIMA DE 30</option>
                                        <option value="36" <?php echo ($anb != '36' ? '' : 'selected="selected"'); ?>>
                                             PREVIDÊNCIA BALANCEADOS - ATÉ 15</option>
                                        <option value="37" <?php echo ($anb != '37' ? '' : 'selected="selected"'); ?>>
                                             PREVIDÊNCIA BALANCEADOS - DE 15 A 30</option>
                                        <option value="38" <?php echo ($anb != '38' ? '' : 'selected="selected"'); ?>>
                                             PREVIDÊNCIA DATA ALVO (FIQ)</option>
                                        <option value="39" <?php echo ($anb != '39' ? '' : 'selected="selected"'); ?>>
                                             PREVIDÊNCIA MULTIMERCADO</option>
                                        <option value="40" <?php echo ($anb != '40' ? '' : 'selected="selected"'); ?>>
                                             RENDA FIXA</option>
                                        <option value="41" <?php echo ($anb != '41' ? '' : 'selected="selected"'); ?>>
                                             RENDA FIXA - INV. NO EXTERIOR</option>
                                        <option value="42" <?php echo ($anb != '42' ? '' : 'selected="selected"'); ?>>
                                             RENDA FIXA - INV. NO EXTERIOR - DÍVIDA EXTERNA</option>
                                        <option value="43" <?php echo ($anb != '43' ? '' : 'selected="selected"'); ?>>
                                             RENDA FIXA - PASSIVO - ÍNDICES</option>
                                        <option value="44" <?php echo ($anb != '44' ? '' : 'selected="selected"'); ?>>
                                             RENDA FIXA ALTA DURAÇÃO - CRÉDITO LIVRE</option>
                                        <option value="45" <?php echo ($anb != '45' ? '' : 'selected="selected"'); ?>>
                                             RENDA FIXA ALTA DURAÇÃO - GRAU DE INVESTIMENTO</option>
                                        <option value="46" <?php echo ($anb != '46' ? '' : 'selected="selected"'); ?>>
                                             RENDA FIXA ALTA DURAÇÃO - SOBERANO</option>
                                        <option value="47" <?php echo ($anb != '47' ? '' : 'selected="selected"'); ?>>
                                             RENDA FIXA BAIXA DURAÇÃO - CRÉDITO LIVRE</option>
                                        <option value="48" <?php echo ($anb != '48' ? '' : 'selected="selected"'); ?>>
                                             RENDA FIXA BAIXA DURAÇÃO - GRAU DE INVESTIMENTO</option>
                                        <option value="49" <?php echo ($anb != '49' ? '' : 'selected="selected"'); ?>>
                                             RENDA FIXA BAIXA DURAÇÃO - SOBERANO</option>
                                        <option value="50" <?php echo ($anb != '50' ? '' : 'selected="selected"'); ?>>
                                             RENDA FIXA LIVRE DURAÇÃO - CRÉDITO LIVRE</option>
                                        <option value="51" <?php echo ($anb != '51' ? '' : 'selected="selected"'); ?>>
                                             RENDA FIXA LIVRE DURAÇÃO - GRAU DE INVESTIMENTO</option>
                                        <option value="52" <?php echo ($anb != '52' ? '' : 'selected="selected"'); ?>>
                                             RENDA FIXA LIVRE DURAÇÃO - SOBERANO</option>
                                        <option value="53" <?php echo ($anb != '53' ? '' : 'selected="selected"'); ?>>
                                             RENDA FIXA MÉDIA DURAÇÃO - CRÉDITO LIVRE</option>
                                        <option value="54" <?php echo ($anb != '54' ? '' : 'selected="selected"'); ?>>
                                             RENDA FIXA MÉDIA DURAÇÃO - GRAU DE INVESTIMENTO</option>
                                        <option value="55" <?php echo ($anb != '55' ? '' : 'selected="selected"'); ?>>
                                             RENDA FIXA MÉDIA DURAÇÃO - SOBERANO</option>
                                        <option value="56" <?php echo ($anb != '56' ? '' : 'selected="selected"'); ?>>
                                             RENDA FIXA SIMPLES</option>
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
                                   <i id="limpa" class="cur-1 fa fa-times-circle-o fa-2x" aria-hidden="true"
                                        title="Limpa todos os filtros para pegar todos os fundos cadastrados."></i>
                                   &nbsp; &nbsp;
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
                                   <select id="cnd" name="cnd" class="form-control">
                                        <option value="" <?php echo ($cnd != '' ? '' : 'selected="selected"'); ?>>
                                             Todos ...</option>
                                        <option value="A" <?php echo ($cnd != 'A' ? '' : 'selected="selected"'); ?>>
                                             Aberto</option>
                                        <option value="F" <?php echo ($cnd != 'F' ? '' : 'selected="selected"'); ?>>
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
                                             <?php $ret = carrega_fun($cla, $pub, $esp, $cnd, $tem, $pat, $anb, $nor, $exc, $cot, $dia);  ?>
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
function carrega_fun($cla, $pub, $esp, $cnd, $tem, $pat, $anb, $nor, $exc, $cot, $dia) {
     $qtd = 0;
     include_once "dados.php";
     include_once "profsa.php";
     $dti = date('01/01/2000');
     $dtf = date('d/m/Y');
     $_SESSION['wrklisfun'] = array();     
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
     if ($cnd != '') { $com .= " and funcondominio = '" . $cnd . "'"; }
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
               $_SESSION['wrklisfun'][$lin['funcnpj']]['cha'] = $lin['idfundo']; 
               $_SESSION['wrklisfun'][$lin['funcnpj']]['cgc'] = $lin['funcnpj']; 
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

               if ($lin['funclaambima'] == "01") { $cpo = 'EM BRANCO (Não Informado ...)'; }
               if ($lin['funclaambima'] == "02") { $cpo = 'AÇÕES - ATIVO - DIVIDENDOS'; }
               if ($lin['funclaambima'] == "03") { $cpo = 'AÇÕES - ATIVO - ÍNDICE ATIVO'; }
               if ($lin['funclaambima'] == "04") { $cpo = 'AÇÕES - ATIVO - LIVRE'; }
               if ($lin['funclaambima'] == "05") { $cpo = 'AÇÕES - ATIVO - SETORIAIS'; }
               if ($lin['funclaambima'] == "06") { $cpo = 'AÇÕES - ATIVO - SMALL CAPS'; }
               if ($lin['funclaambima'] == "07") { $cpo = 'AÇÕES - ATIVO - SUSTENTABILIDADE GOVERNANÇA'; }
               if ($lin['funclaambima'] == "08") { $cpo = 'AÇÕES - ATIVO - VALOR CRESCIMENTO'; }
               if ($lin['funclaambima'] == "09") { $cpo = 'AÇÕES - FUNDOS FECHADOS'; }
               if ($lin['funclaambima'] == "10") { $cpo = 'AÇÕES - INDEXADO - ÍNDICE PASSIVO'; }
               if ($lin['funclaambima'] == "11") { $cpo = 'AÇÕES - INVESTIMENTO NO EXTERIOR'; }
               if ($lin['funclaambima'] == "12") { $cpo = 'AÇÕES - MONO AÇÃO'; }
               if ($lin['funclaambima'] == "13") { $cpo = 'FUNDO CAMBIAL'; }
               if ($lin['funclaambima'] == "14") { $cpo = 'MULTIMERCADO - ALOCAÇÃO - BALANCEADOS'; }
               if ($lin['funclaambima'] == "15") { $cpo = 'MULTIMERCADO - ALOCAÇÃO - DINÂMICOS'; }
               if ($lin['funclaambima'] == "16") { $cpo = 'MULTIMERCADO - ESTRATÉGIA - CAPITAL PROTEGIDO'; }
               if ($lin['funclaambima'] == "17") { $cpo = 'MULTIMERCADO - ESTRATÉGIA - ESTRATÉGIA ESPECÍFICA'; }
               if ($lin['funclaambima'] == "18") { $cpo = 'MULTIMERCADO - ESTRATÉGIA - JUROS E MOEDAS'; }
               if ($lin['funclaambima'] == "19") { $cpo = 'MULTIMERCADO - ESTRATÉGIA - LIVRE'; }
               if ($lin['funclaambima'] == "20") { $cpo = 'MULTIMERCADO - ESTRATÉGIA - LONG & SHORT DIRECIONAL'; }
               if ($lin['funclaambima'] == "21") { $cpo = 'MULTIMERCADO - ESTRATÉGIA - LONG & SHORT NEUTRO'; }
               if ($lin['funclaambima'] == "22") { $cpo = 'MULTIMERCADO - ESTRATÉGIA - MACRO'; }
               if ($lin['funclaambima'] == "23") { $cpo = 'MULTIMERCADO - ESTRATÉGIA - TRADING'; }
               if ($lin['funclaambima'] == "24") { $cpo = 'MULTIMERCADO - INVESTIMENTO NO EXTERIOR'; }
               if ($lin['funclaambima'] == "25") { $cpo = 'PREVIDÊNCIA - AÇÕES ATIVO'; }
               if ($lin['funclaambima'] == "26") { $cpo = 'PREVIDÊNCIA - BALANCEADOS - ACIMA DE 49'; }
               if ($lin['funclaambima'] == "27") { $cpo = 'PREVIDÊNCIA - BALANCEADOS - DE 30-49'; }
               if ($lin['funclaambima'] == "28") { $cpo = 'PREVIDÊNCIA - MULTIMERCADOS LIVRE'; }
               if ($lin['funclaambima'] == "29") { $cpo = 'PREVIDÊNCIA - RF DURAÇÃO BAIXA - GRAU DE INVESTIMENTO'; }
               if ($lin['funclaambima'] == "30") { $cpo = 'PREVIDÊNCIA - RF DURAÇÃO LIVRE - GRAU DE INVESTIMENTO'; }
               if ($lin['funclaambima'] == "31") { $cpo = 'PREVIDÊNCIA - RF DURAÇÃO LIVRE - SOBERANO'; }
               if ($lin['funclaambima'] == "32") { $cpo = 'PREVIDÊNCIA - RF DURAÇÃO MÉDIA - GRAU DE INVESTIMENTO'; }
               if ($lin['funclaambima'] == "33") { $cpo = 'PREVIDÊNCIA - RF INDEXADOS'; }
               if ($lin['funclaambima'] == "34") { $cpo = 'PREVIDÊNCIA AÇÕES'; }
               if ($lin['funclaambima'] == "35") { $cpo = 'PREVIDÊNCIA BALANCEADOS - ACIMA DE 30'; }
               if ($lin['funclaambima'] == "36") { $cpo = 'PREVIDÊNCIA BALANCEADOS - ATÉ 15'; }
               if ($lin['funclaambima'] == "37") { $cpo = 'PREVIDÊNCIA BALANCEADOS - DE 15 A 30'; }
               if ($lin['funclaambima'] == "38") { $cpo = 'PREVIDÊNCIA DATA ALVO (FIQ)'; }
               if ($lin['funclaambima'] == "39") { $cpo = 'PREVIDÊNCIA MULTIMERCADO'; }
               if ($lin['funclaambima'] == "40") { $cpo = 'RENDA FIXA'; }
               if ($lin['funclaambima'] == "41") { $cpo = 'RENDA FIXA - INV. NO EXTERIOR'; }
               if ($lin['funclaambima'] == "42") { $cpo = 'RENDA FIXA - INV. NO EXTERIOR - DÍVIDA EXTERNA'; }
               if ($lin['funclaambima'] == "43") { $cpo = 'RENDA FIXA - PASSIVO - ÍNDICES'; }
               if ($lin['funclaambima'] == "44") { $cpo = 'RENDA FIXA ALTA DURAÇÃO - CRÉDITO LIVRE'; }
               if ($lin['funclaambima'] == "45") { $cpo = 'RENDA FIXA ALTA DURAÇÃO - GRAU DE INVESTIMENTO'; }
               if ($lin['funclaambima'] == "46") { $cpo = 'RENDA FIXA ALTA DURAÇÃO - SOBERANO'; }
               if ($lin['funclaambima'] == "47") { $cpo = 'RENDA FIXA BAIXA DURAÇÃO - CRÉDITO LIVRE'; }
               if ($lin['funclaambima'] == "48") { $cpo = 'RENDA FIXA BAIXA DURAÇÃO - GRAU DE INVESTIMENTO'; }
               if ($lin['funclaambima'] == "49") { $cpo = 'RENDA FIXA BAIXA DURAÇÃO - SOBERANO'; }
               if ($lin['funclaambima'] == "50") { $cpo = 'RENDA FIXA LIVRE DURAÇÃO - CRÉDITO LIVRE'; }
               if ($lin['funclaambima'] == "51") { $cpo = 'RENDA FIXA LIVRE DURAÇÃO - GRAU DE INVESTIMENTO'; }
               if ($lin['funclaambima'] == "52") { $cpo = 'RENDA FIXA LIVRE DURAÇÃO - SOBERANO'; }
               if ($lin['funclaambima'] == "53") { $cpo = 'RENDA FIXA MÉDIA DURAÇÃO - CRÉDITO LIVRE'; }
               if ($lin['funclaambima'] == "54") { $cpo = 'RENDA FIXA MÉDIA DURAÇÃO - GRAU DE INVESTIMENTO'; }
               if ($lin['funclaambima'] == "55") { $cpo = 'RENDA FIXA MÉDIA DURAÇÃO - SOBERANO'; }
               if ($lin['funclaambima'] == "56") { $cpo = 'RENDA FIXA SIMPLES'; }
                              
               $txt .= "<td>" . $cpo . "</td>"; 
               $txt .= '<td class="text-center">' . ($lin['funatuadiaria'] == "N" ? 'Não' : 'Sim' ) . "</td>";
               $txt .= '<td class="text-center">' . ($lin['funcotas'] == "N" ? 'Não' : 'Sim' ) . "</td>";
               $txt .= "</tr>";
               echo $txt; $qtd += 1;
          }
     }
     return $qtd;
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
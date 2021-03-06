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
     <title>Movimento - Análise de Investimentos - MoneyWay</title>
</head>

<script>
$(function() {
     $("#cgc").mask("00.000.000/0000-00");
     $("#dti").mask("00/00/0000");
     $("#dtf").mask("00/00/0000");
     $("#dti").datepicker($.datepicker.regional["pt-BR"]);
     $("#dtf").datepicker($.datepicker.regional["pt-BR"]);
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
               "infoEmpty": "Sem registros de Movimento ...",
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

     $("#fun-d").click(function() {
          var cgc = $('#cgc').val();
          if (cgc != "") {
               $.getJSON("ajax/carrega-fun.php", {
                    cgc: cgc
               })
               .done(function(data) {
                    if (data.men != "") {
                         alert(data.men);
                    } else {
                         $('#dad_fun').html(data.txt);          
                         $('#fun-dad').modal('show');          
                    }
               }).fail(function(data) {
                    console.log('Erro: ' + JSON.stringify(data));
                    alert("Erro ocorrido no processamento de demonstração do fundo");
               });
          }

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
               $ret = gravar_log(8, "Entrada na página de consulta de movimento do sistema Pallas.45 - MoneyWay");  
          }
     }
     if (isset($_SESSION['wrknomfun']) == false) { $_SESSION['wrknomfun'] = ""; }
     if (isset($_SESSION['wrkopereg']) == false) { $_SESSION['wrkopereg'] = 0; }
     if (isset($_SESSION['wrkcodreg']) == false) { $_SESSION['wrkcodreg'] = 0; }
     if (isset($_REQUEST['ope']) == true) { $_SESSION['wrkopereg'] = $_SESSION['wrknomfun'] = ""; }

     $dti = date('d/m/Y', strtotime('-30 days'));
     $dtf = date('d/m/Y');
     $cgc = (isset($_REQUEST['cgc']) == false ? '' : $_REQUEST['cgc']);
     $nom = (isset($_REQUEST['nom']) == false ? $_SESSION['wrknomfun'] : $_REQUEST['nom']);
     $dti = (isset($_REQUEST['dti']) == false ? $dti : $_REQUEST['dti']);
     $dtf = (isset($_REQUEST['dtf']) == false ? $dtf : $_REQUEST['dtf']);
     if ($_SESSION['wrknomfun'] == "") { $_SESSION['wrknomfun'] = $nom; }
     if ($dti == "" && $dtf == "" && $cgc == "")  { 
          if (isset($_REQUEST['consulta']) == true) {
               echo '<script>alert("Não se pode efetuar consulta sem Cnpj e Periodo informado !");</script>';
               $dti = "01" . "/" . substr(date('d/m/Y'), 3, 7); $dtf = date('d/m/Y');          
          }
     }

?>

<body id="box00">
     <h1 class="cab-0">Movimento - MoneyWay Investimentos - Profsa Informática</h1>
     <?php include_once "cabecalho-1.php"; ?>
     <div class="container-fluid">
          <div class="form-row">
               <div class="col-md-2">
                    <!-- Menu -->
                    <?php include_once "cabecalho-2.php"; ?>
               </div>
               <div class="col-md-10">
                    <!-- Corpo -->
                    <p class="lit-4">Consulta de Movimento -
                         <?php echo  number_format(numero_reg('tb_movto_id'), 0, ",", "."); ?></p>

                    <form class="qua-6" id="frmTelCon" name="frmTelCon" action="con-movto.php" method="POST">
                         <div class="form-row">
                              <div class="col-md-2">
                                   <label>Data Inicial</label>
                                   <input type="text" class="form-control text-center" maxlength="10" id="dti"
                                        name="dti" value="<?php echo $dti; ?>" />
                              </div>
                              <div class="col-md-2">
                                   <label>Data Final</label>
                                   <input type="text" class="form-control text-center" maxlength="10" id="dtf"
                                        name="dtf" value="<?php echo $dtf; ?>"  />
                              </div>
                              <div class="col-md-2">
                                   <label>Número do Cnpj </label> &nbsp; &nbsp; <span id="fun-d" class="cur-1" title="Abre janela com dados de cadastro do fundo solicitado"><i class="fa fa-building fa-1g" aria-hidden="true"></i></span>
                                   <input type="text" class="form-control text-center" maxlength="18" id="cgc"
                                        name="cgc" value="<?php echo $cgc; ?>" />
                              </div>
                              <div class="col-md-5 text-center">
                              <label>Nome do Fundo</label>
                                   <span>
                                        <input type="text" class="form-control text-center" id="nom"
                                             name="nom" value="<?php echo $_SESSION['wrknomfun']; ?>" disabled />
                                   </span>
                              </div>
                              <div class="col-md-1 text-center">
                                   <br />
                                   <button type="submit" id="con" name="consulta" class="bot-2"
                                        title="Carrega dados do movimen to conforme parâmetros informados pelo usuário."><i
                                             class="fa fa-search fa-2x" aria-hidden="true"></i></button>
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
                                                  <th>Seq</th>
                                                  <th>C.n.p.j.</th>
                                                  <th>Nome do Fundo</th>
                                                  <th>Data</th>
                                                  <th>Total</th>
                                                  <th>Cota Diária</th>
                                                  <th>Patrimônio</th>
                                                  <th>Capital</th>
                                                  <th>Resgate</th>
                                                  <th>Cotas</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             <?php 
                                             if (isset($_REQUEST['consulta']) == true) {
                                                  $ret = carrega_mov($cgc, $dti, $dtf);  
                                             }
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

     <!----------------------------------------------------------------------------------->
     <div class="modal fade" id="fun-dad" tabindex="-1" role="dialog" aria-labelledby="tel-fun" aria-hidden="true"
          data-backdrop="true">
          <div class="modal-dialog modal-lg" role="document"> <!-- modal-sm modal-lg modal-xl -->
               <form id="frmMosFun" name="frmMosFun" action="con-movto.php" method="POST">
                    <div class="modal-content">
                         <div class="modal-header bg-primary text-white">
                              <h5 class="modal-title" id="tel-exc">Informações Cadastrais do Fundo</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                   <span aria-hidden="true">&times;</span>
                              </button>
                         </div>
                         <div class="modal-body">
                              <div class="row">
                                   <div class="col-md-12 text-center">
                                        <div id="dad_fun"></div>
                                   </div>
                              </div>
                              <br />
                         </div>
                         <div class="modal-footer">
                              <button type="button" id="clo" name="close" class="btn btn-outline-danger"
                                   data-dismiss="modal">Fechar</button>
                         </div>
                    </div>
               </form>
          </div>
     </div>
     <!----------------------------------------------------------------------------------->

</body>

<?php
function carrega_mov($cgc, $dti, $dtf) {
     $seq = 1;
     include_once "dados.php";
     include_once "profsa.php";
     if ($dti == "" && $dtf == "" && $cgc == "")  { return 1; }
     if ($dti != "") {
          $dti = substr($dti,6,4) . "-" . substr($dti,3,2) . "-" . substr($dti,0,2) . " 00:00:00";
     }
     if ($dtf != "") {
          $dtf = substr($dtf,6,4) . "-" . substr($dtf,3,2) . "-" . substr($dtf,0,2) . " 23:59:59";
     }
     $com = "Select M.*, F.funnome from (tb_movto_id M left join tb_fundos F on M.idfundo = F.idfundo) where idmovto > 0 ";
     if ($dti != "" && $dtf != "") { $com .= " and infdata between '" . $dti . "' and '" . $dtf . "' "; }
     if ($cgc != "") { $com .= " and inffundo = '" . limpa_nro($cgc) . "'"; }
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $lin) {
          $txt =  '<tr>';
          $txt .= '<td class="text-center">' . $seq . '</td>';
          $txt .= "<td>" . mascara_cpo($lin['inffundo'], "  .   .   /    -  ") . "</td>";
          $txt .= "<td>" . $lin['funnome'] . "</td>";
          $txt .= "<td>" . date('d/m/Y',strtotime($lin['infdata'])) . "</td>";
          $txt .= '<td class="text-right">' . number_format($lin['inftotal'], 2, ",", ".") . '</td>';
          $txt .= '<td class="text-right">' . number_format($lin['infquota'], 6, ",", ".") . '</td>';
          $txt .= '<td class="text-right">' . number_format($lin['infpatrimonio'], 2, ",", ".") . '</td>';
          $txt .= '<td class="text-right">' . number_format($lin['infcapital'], 2, ",", ".") . '</td>';
          $txt .= '<td class="text-right">' . number_format($lin['infresgate'], 2, ",", ".") . '</td>';
          $txt .= '<td class="text-right">' . number_format($lin['infnumcotas'], 0, ",", ".") . '</td>';
          $txt .= "</tr>";
          echo $txt; $seq += 1;
     }
}

?>

</html>
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
     <title>Movimento - Análise de Investimentos - Profsa Informátda Ltda</title>
</head>

<script>
$(function() {
     $("#cgc").mask("00.000.000/0000-00");
});

$(document).ready(function() {
     $('#cgc').blur(function() {
          $('#tab-0 tbody').empty();
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
                         }
                    }).fail(function(data) {
                         console.log('Erro: ' + JSON.stringify(data));
                         alert("Erro ocorrido no processamento de adição de cnpj");
                    });
          }
     });

     $('#tab-0').DataTable({
          "pageLength": 25,
          "aaSorting": [
               [1, 'asc'],
               [2, 'asc']
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
     include_once "dados.php"; 
     if (isset($_SESSION['wrkopereg']) == false) { $_SESSION['wrkopereg'] = 0; }
     if (isset($_SESSION['wrkcodreg']) == false) { $_SESSION['wrkcodreg'] = 0; }
     if (isset($_SESSION['wrklisfun']) == false) { $_SESSION['wrklisfun'] = array(); }

     $dti = date('d/m/Y', strtotime('-90 days'));
     $dtf = date('d/m/Y');
     $cgc = (isset($_REQUEST['cgc']) == false ? '' : $_REQUEST['cgc']);
     $dti = (isset($_REQUEST['dti']) == false ? $dti : $_REQUEST['dti']);
     $dtf = (isset($_REQUEST['dtf']) == false ? $dtf : $_REQUEST['dtf']);
     $nom = (isset($_REQUEST['nom']) == false ? '' : $_REQUEST['nom']);

?>

<body id="box00">
     <h1 class="cab-0">Movimento - MoneyWay Investimentos - Profsa Informática</h1>
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
                    <form class="qua-6" id="frmTelAna" name="frmTelAna" action="con-movto.php" method="POST">
                         <div class="form-row">
                              <div class="col-md-1 text-center">
                                   <label>Quantidade</label>
                                   <p id="qtd" class="lit-5">0</p>
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
                    </form>
                    <br />
                    <div class="row qua-3">
                         <div class="col-md-12">
                              <div class="tab-1 table-responsive">
                                   <table id="tab-0" class="table table-sm">
                                        <thead>
                                             <tr>
                                                  <th>Nº do C.n.p.j.</th>
                                                  <th>Nome do Fundo</th>
                                                  <th>Data</th>
                                                  <th>Cota Diária</th>
                                                  <th>Patrimônio</th>
                                                  <th>Nº Cotistas</th>
                                                  <th>Mediana</th>
                                                  <th>Média</th>
                                                  <th>Máximo</th>
                                                  <th>% acima do CDI</th>
                                             </tr>
                                        </thead>
                                        <tbody>

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

?>

</html>
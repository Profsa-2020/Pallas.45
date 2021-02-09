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

     <link href="css/pallas45.css" rel="stylesheet" type="text/css" media="screen" />
     <title>Fundos - Análise de Investimentos - Profsa Informátda Ltda</title>
</head>

<script>
$(document).ready(function() {
     $('#tab-0').DataTable({
          "pageLength": 25,
          "aaSorting": [
               [2, 'asc'],
               [1, 'asc']
          ],
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

<?php include_once "dados.php"; ?>

<body id="box00">
     <h1 class="cab-0">Fundos - MoneyWay Investimentos - Profsa Informática</h1>
     <?php include_once "cabecalho-1.php"; ?>
     <div class="container-fluid">
          <div class="row">
               <div class="col-md-2">
                    <!-- Menu -->
                    <?php include_once "cabecalho-2.php"; ?>
               </div>
               <div class="col-md-10">
                    <!-- Corpo -->
                    <p class="lit-4">Consulta de Fundos - <?php echo  number_format(numero_reg('tb_fundos'), 0, ",", "."); ?></p>
                    <div class="row qua-3">
                         <div class="col-md-12">
                              <br />
                              <div class="tab-1 table-responsive">
                                   <table id="tab-0" class="table table-sm table-striped">
                                        <thead>
                                             <tr>
                                                  <th width="5%">Código</th>
                                                  <th>C.N.P.J.</th>
                                                  <th>Nome do Fundo</th>
                                                  <th>Cadastro</th>
                                                  <th>Status</th>
                                                  <th>Aplicação Mínima</th>
                                                  <th>Inclusão</th>
                                                  <th>Alteração</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             <?php $ret = carrega_fun();  ?>
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
function carrega_fun() {
     include_once "dados.php";
     include_once "profsa.php";
     $com = "Select * from tb_fundos order by funnome, idfundo";
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $lin) {
         $txt =  '<tr>';
         $txt .= '<td class="text-center">' . $lin['idfundo'] . '</td>';
         $txt .= "<td>" . mascara_cpo($lin['funcnpj'],"  .   .   /    -  ") . "</td>";
         $txt .= "<td>" . $lin['funnome'] . "</td>";
         $txt .= "<td>" . date('d/m/Y',strtotime($lin['fundatacomp'])) . "</td>";
         if ($lin['funstatus'] == 0) {$txt .= "<td>" . "Normal" . "</td>";}
         if ($lin['funstatus'] == 1) {$txt .= "<td>" . "Bloqueado" . "</td>";}
         if ($lin['funstatus'] == 2) {$txt .= "<td>" . "Suspenso" . "</td>";}
         if ($lin['funstatus'] == 3) {$txt .= "<td>" . "Cancelado" . "</td>";}
         $txt .= '<td class="text-right">' . number_format($lin['funaplminima'], 2, ",", ".") . '</td>';
         if ($lin['datinc'] == null) {
               $txt .= "<td>" . '' . "</td>";
          }else{
               $txt .= "<td>" . date('d/m/Y H:m:s',strtotime($lin['datinc'])) . "</td>";
         }
         if ($lin['datalt'] == null) {
             $txt .= "<td>" . '' . "</td>";
         }else{
             $txt .= "<td>" . date('d/m/Y H:m:s',strtotime($lin['datalt'])) . "</td>";
         }
         $txt .= "</tr>";
         echo $txt;
     }
}

?>

</html>
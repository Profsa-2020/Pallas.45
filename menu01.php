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

     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js"></script>

     <script type="text/javascript" src="js/profsa.js"></script>

     <link href="css/pallas45.css" rel="stylesheet" type="text/css" media="screen" />
     <title>Menu - Análise de Investimentos - Profsa Informátda Ltda</title>
</head>

<script>
$(document).ready(function() {

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

     $tab = array(); 
     $ret = carrega_das($tab);

?>

<body id="box00">
     <h1 class="cab-0">Menu Principal - MoneyWay Investimentos - Profsa Informática</h1>
     <?php include_once "cabecalho-1.php"; ?>
     <div class="container-fluid">
          <div class="row">
               <!---------- Menu ---------->
               <div class="col-md-2">

                    <?php include_once "cabecalho-2.php"; ?>

               </div>

               <!---------- Corpo ---------->
               <div class="col-md-10">
                    <div class="row">

                         <div class="col-md-12 text-center">
                              <span class="lit-3">DashBoard</span> &nbsp; &nbsp; &nbsp; <i
                                   class="fa fa-tachometer fa-3x" aria-hidden="true"></i>
                         </div>
                    </div>
                    <br />
                    <div class="row">
                         <div class="col-md-2"></div>
                         <div class="qua-5 col-md-2 text-center">
                              <p>Usuários</p>
                              <span><?php echo number_format($tab['usu'], 0, ",", "."); ?></span>
                         </div>
                         <div class="qua-5 col-md-2 text-center">
                              <p>Fundos</p>
                              <span><?php echo number_format($tab['fun'], 0, ",", "."); ?></span>
                         </div>
                         <div class="qua-5 col-md-2 text-center">
                              <p>Movimento</p>
                              <span><?php echo number_format($tab['mv0'], 0, ",", "."); ?></span>
                         </div>
                         <div class="qua-5 col-md-2 text-center">
                              <p>Opções</p>
                              <span><?php echo number_format($tab['opc'], 0, ",", "."); ?></span>
                         </div>
                         <div class="col-md-2"></div>
                    </div>
                    <br /><br />
                    <div class="row">
                         <div class="col-md-12 text-center">
                              <img class="ima-2 img-fluid  animated zoomInUp" src="img/logo-05.png" />
                         </div>
                    </div>
               </div>
          </div>
          <div id="box10">
               <img class="subir" src="img/subir.png" title="Volta a página para o seu topo." />
          </div>
</body>
<?php
function carrega_das(&$tab) {
     $sta = 0;
     $tab['usu'] = 0;
     $tab['fun'] = 0;
     $tab['opc'] = 0;
     $tab['mv0'] = 0;
     include_once "dados.php";
     date_default_timezone_set("America/Sao_Paulo");
     $com = 'Select count(*) as qtdlinhas from tb_usuario';
     $nro = acessa_reg($com, $reg);
     if ($nro == 1) {
          $tab['usu'] = $reg['qtdlinhas'];
     }        
     $com = 'Select count(*) as qtdlinhas from tb_fundos';
     $nro = acessa_reg($com, $reg);
     if ($nro == 1) {
          $tab['fun'] = $reg['qtdlinhas'];
     }        
     $com = 'Select count(*) as qtdlinhas from tb_opcoes';
     $nro = acessa_reg($com, $reg);
     if ($nro == 1) {
          $tab['opc'] = $reg['qtdlinhas'];
     }        
     $com = 'Select count(*) as qtdlinhas from tb_movto_id';
     $nro = acessa_reg($com, $reg);
     if ($nro == 1) {
          $tab['mv0'] = $reg['qtdlinhas'];
     }        

     return $sta;
}

?>

</html>
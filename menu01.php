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
     if (isset($_SESSION['wrkinddat']) == false) { $_SESSION['wrkinddat'] = ""; }
     if (isset($_SESSION['wrkindtax']) == false) { $_SESSION['wrkindtax'] = '0'; }
     if (isset($_SESSION['wrkcdidat']) == false) { $_SESSION['wrkcdidat'] = ""; }
     if (isset($_SESSION['wrkcditax']) == false) { $_SESSION['wrkcditax'] = '0'; }

     $cdi = 0; $dat = date('Y-m-d');
     if ($_SESSION['wrkinddat'] == "") {
          $ret = carrega_ind($dat, $tax);
     }
     if ($_SESSION['wrkcdidat'] == "") {
          for ($ind = 0; $ind <= 10; $ind++) {
               $dta = date('Y-m-d', strtotime('-' . $ind . ' days'));
               $nro = acessa_reg("Select * from tb_indice where indcodigo = 1 and inddata = '" . $dta . "'", $reg);            
               if ($nro == 1) {
                    $cdi = $reg['indtaxa']; break;
               }     
          }
          $_SESSION['wrkcditax'] = $cdi;
          $_SESSION['wrkcdidat'] = $dta;
     }
     $tab = array(); 
     $ret = carrega_das($tab);

?>

<body id="box00">
     <h1 class="cab-0">Menu Principal - MoneyWay Investimentos - Profsa Informática</h1>
     <?php include_once "cabecalho-1.php"; ?>
     <div class="container-fluid">
          <div class="form-row">
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
                    <div class="form-row">
                         <div class="qua-5 col-md-2 text-center">
                              <p>Usuários</p>
                              <span><?php echo number_format($tab['usu'], 0, ",", "."); ?></span>
                         </div>
                         <div class="qua-5 col-2 text-center">
                              <p>Fundos</p>
                              <span><?php echo number_format($tab['fun'], 0, ",", "."); ?></span>
                         </div>
                         <div class="qua-5 col-2 text-center">
                              <p>Movimento</p>
                              <span><?php echo number_format($tab['mv0'], 0, ",", "."); ?></span>
                         </div>
                         <div class="qua-5 col-2 text-center">
                              <p>Opções</p>
                              <span><?php echo number_format($tab['opc'], 0, ",", "."); ?></span>
                         </div>
                         <div class="qua-5 col-2 text-center">
                              <p>Índices</p>
                              <span><?php echo number_format($tab['ind'], 0, ",", "."); ?></span>
                         </div>
                    </div>
                    <br />
                    <div class="row">
                         <div class="col-md-3"><h4><strong>Classes dos Fundos</strong></h4></div>
                         <div class="col-md-6">
                              <?php echo $tab['cla']; ?>
                         </div>
                         <div class="col-md-3 text-center">
                              <span> <?php echo "CDI: " . date('d/m/Y', strtotime($_SESSION['wrkcdidat'])) . " - " .  number_format($_SESSION['wrkcditax'], 6, ",", "."); ?> </span><br />
                              <span> <?php echo "iBovespa: " . date('d/m/Y', strtotime($_SESSION['wrkinddat'])) . " - " .  number_format($_SESSION['wrkindtax'], 4, ",", "."); ?> </span>
                              <br />
                         </div>
                    </div>
                    <br /><br />
                    <div class="row">
                         <div class="col-md-12 text-center">
                              <img class="ima-2 img-fluid  animated zoomInUp" src="img/logo-03.png" />
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
     $tab['ind'] = 0;
     $tab['mv0'] = 0;
     $tab['cla'] = '';
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
     $com = 'Select count(*) as qtdlinhas from tb_indice';
     $nro = acessa_reg($com, $reg);
     if ($nro == 1) {
          $tab['ind'] = $reg['qtdlinhas'];
     }        
     $com = 'Select count(*) as qtdlinhas from tb_movto_id';
     $nro = acessa_reg($com, $reg);
     if ($nro == 1) {
          $tab['mv0'] = $reg['qtdlinhas'];
     }        
     $nro = leitura_reg("Select funclasse, Count(*) as funqtde from tb_fundos group by funclasse", $reg);
     if ($nro > 0) {
          $tab['cla'] .= '<table class="table">';
          $tab['cla'] .= '<tbody>';
     }
     foreach ($reg as $lin) {
          $des = "**********";
          if ($lin['funclasse'] == 1) { $des = "Fundo Cambial"; }
          if ($lin['funclasse'] == 2) { $des = "Fundo da Dívida Externa"; }
          if ($lin['funclasse'] == 3) { $des = "Fundo de Açoes"; }
          if ($lin['funclasse'] == 4) { $des = "Fundo de Curto Prazo"; }
          if ($lin['funclasse'] == 5) { $des = "Fundo de Renda Fixa"; }
          if ($lin['funclasse'] == 6) { $des = "Fundo Multimercado"; }
          if ($lin['funclasse'] == 7) { $des = "Fundo Referenciado"; }
          $tab['cla'] .= '<tr>';
          $tab['cla'] .= "<td>" . $des . "</td>";
          $tab['cla'] .= "<td>" . number_format($lin['funqtde'], 0, ",", ".") . "</td>";
          $tab['cla'] .= "<td>" . round($lin['funqtde'] / $tab['fun'] * 100, 2) . " %</td>";
          $tab['cla'] .= '</tr>';
     }
     if ($nro > 0) {
          $tab['cla'] .= '</tbody>';
          $tab['cla'] .= '</table>';
     }
     return $sta;
}

function carrega_ind(&$dta, &$tax) {      // Carrega indice Ibovespa e CDI via API
     include_once "dados.php";
     $ret = 0; $con = 0; $dat = ""; $ind = ""; $tax = "0";
     $url = "https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol=IBOV.SA&outputsize=full&apikey=N9RZJIE9K8ENIYET";
     $ibo = file_get_contents($url);
     $tab = json_decode($ibo, true);    // Transforma a string em array (true) ou stdClass (false)
     foreach ($tab as $cpo => $dad) {
          if ($cpo != "Meta Data") {
               foreach ($dad as $tip => $inf) {        
                    $dat = $tip;  
                    $ind = $inf["4. close"];
                    $con = $con + 1;
                    if ($tax == "0") { $tax = $ind; $dta = $dat; }
                    $num = acessa_reg("Select idindice from tb_indice where inddata = '" . $dat . "'", $reg);            
                    if ($num == 0) {
                         $sql  = "insert into tb_indice (";
                         $sql .= "indstatus, ";
                         $sql .= "indcodigo, ";
                         $sql .= "indtipo, ";
                         $sql .= "inddata, ";
                         $sql .= "indtaxa, ";
                         $sql .= "indmes, ";
                         $sql .= "indano, ";
                         $sql .= "keyinc, ";
                         $sql .= "datinc ";
                         $sql .= ") value ( ";
                         $sql .= "'" . '0' . "',";
                         $sql .= "'" . '0' . "',";     // Codigo: iBovespa
                         $sql .= "'" . '1' . "',";
                         $sql .= "'" . $dat . "',";
                         $sql .= "'" . $ind . "',";
                         $sql .= "'" . date("m", strtotime($dat)) . "',";
                         $sql .= "'" . date("Y", strtotime($dat)) . "',";
                         $sql .= "'" . $_SESSION['wrkideusu'] . "',";
                         $sql .= "'" . date("Y/m/d H:i:s") . "')";
                         $ret = comando_tab($sql, $nro, $ult, $men);
                         if ($ret == false) {
                              print_r($sql);
                              echo '<script>alert("Erro na gravação do índice solicitado !");</script>';
                         }                    
                    }      
                    if ($con >= 9) { break; }         
               }
          }
     }
     $_SESSION['wrkinddat'] = $dta; $_SESSION['wrkindtax'] = $tax;
     if ($_SESSION['wrkinddat'] == "") {
          $nro = acessa_reg('Select idindice, inddata, indtaxa from tb_indice where indtipo = 0 order by idindice desc Limit 1', $reg);
          if ($nro == 1) {
               $_SESSION['wrkinddat'] = $reg['inddata'];
               $_SESSION['wrkindtax'] = $reg['indtaxa'];
          }             
     }

     $ret = 0; $con = 0; $dat = ""; $ind = ""; $tax = "0";   // Buscar CDI
     $url = "http://www.portaldefinancas.com/cdidiaria.htm";     // "https://api.bcb.gov.br/dados/serie/bcdata.sgs.12/dados?formato=json";      
     $cdi = file_get_contents($url);


     return $ret;
}

?>

</html>
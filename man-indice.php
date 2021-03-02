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
     <title>Índices - Análise de Investimentos - MoneyWay</title>
</head>

<script>
$(function() {
     $("#tax").mask("999,999999");
     $("#dat").mask("99/99/9999");
     $("#dat").datepicker($.datepicker.regional["pt-BR"]);
});

$(document).ready(function() {
     $('#dti').change(function() {
          $('#tab-0 tbody').empty();
     });

     $('#dtf').change(function() {
          $('#tab-0 tbody').empty();
     });

     /* https://datatables.net/reference/button/csv */

     $('#tab-0').DataTable({
          "pageLength": 25,
          "aaSorting": [
               [4, 'asc'],
               [5, 'asc']
          ],
          "language": {
               "lengthMenu": "Demonstrar _MENU_ linhas por páginas",
               "zeroRecords": "Não existe registros a demonstar ...",
               "info": "Mostrada página _PAGE_ de _PAGES_",
               "infoEmpty": "Sem registros de Índices ...",
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
     $ret = 00;
     $per = "";
     $del = "";
     $bot = "Salvar";
     include_once "dados.php";
     include_once "profsa.php";
     $_SESSION['wrknompro'] = __FILE__;
     date_default_timezone_set("America/Sao_Paulo");
     $_SESSION['wrkdatide'] = date ("d/m/Y H:i:s", getlastmod());
     $_SESSION['wrknomide'] = get_current_user();
     if (isset($_SERVER['HTTP_REFERER']) == true) {
          if (limpa_pro($_SESSION['wrknompro']) != limpa_pro($_SERVER['HTTP_REFERER'])) {
               $_SESSION['wrkproant'] = limpa_pro($_SERVER['HTTP_REFERER']);
               $ret = gravar_log(6,"Entrada na página de manutenção de índices do sistema Pallas.45 - MoneyWay");  
          }
     }
     if (isset($_SESSION['wrkopereg']) == false) { $_SESSION['wrkopereg'] = 0; }
     if (isset($_SESSION['wrkcodreg']) == false) { $_SESSION['wrkcodreg'] = 0; }
     if (isset($_REQUEST['ope']) == true) { $_SESSION['wrkopereg'] = $_REQUEST['ope']; }
     if (isset($_REQUEST['cod']) == true) { $_SESSION['wrkcodreg'] = $_REQUEST['cod']; }
     $cod = (isset($_REQUEST['cod']) == false ? 0 : $_REQUEST['cod']);
     $sta = (isset($_REQUEST['sta']) == false ? 0 : $_REQUEST['sta']);
     $ind = (isset($_REQUEST['ind']) == false ? '' : $_REQUEST['ind']);
     $dat = (isset($_REQUEST['dat']) == false ? '' : $_REQUEST['dat']);
     $tax = (isset($_REQUEST['tax']) == false ? '' : $_REQUEST['tax']);
     if ($_SESSION['wrkopereg'] == 1) { 
          $cod = ultimo_cod();
     }
     if ($_SESSION['wrkopereg'] >= 2) {
          if (isset($_REQUEST['salvar']) == false) { 
               $cha = $_SESSION['wrkcodreg']; 
               $ret = ler_indice($cha, $dat, $sta, $ind, $tax); 
          }
     }
     if ($_SESSION['wrkopereg'] == 3) { 
          $bot = 'Deletar'; 
          $del = "cor-3";
          $per = ' onclick="return confirm(\'Confirma exclusão de Índice de Moeda informado em tela ?\')" ';
     }

 if (isset($_REQUEST['salvar']) == true) {
      if ($_SESSION['wrkopereg'] == 1) {
           $sta = consiste_ind();
           if ($sta == 0) {
                $ret = incluir_ind();
                $cod = ultimo_cod();
                $ret = gravar_log(11,"Inclusão de novo Índice de Moeda de campo: " . $dat); 
                $dat = ''; $tax = ''; $sta = 0; $ind = 0; $_SESSION['wrkopereg'] = 1; $_SESSION['wrkcodreg'] = 0;
           }
      }
      if ($_SESSION['wrkopereg'] == 2) {
           $sta = consiste_ind();
           if ($sta == 0) {
                $ret = alterar_ind();
                $cod = ultimo_cod(); 
                $ret = gravar_log(12,"Alteração de Índice de Moeda cadastrado: " . $dat); 
                $dat = ''; $tax = ''; $sta = 0;  $ind = 0; $_SESSION['wrkopereg'] = 1; $_SESSION['wrkcodreg'] = 0;
           }
      }
      if ($_SESSION['wrkopereg'] == 3) {
           $ret = excluir_ind(); $bot = 'Salvar'; $per = '';
           $cod = ultimo_cod(); 
           $ret = gravar_log(13,"Exclusão de Índice de Moeda cadastrado: " . $dat); 
           $dat = ''; $tax = ''; $sta = 0;  $ind = 0;  $_SESSION['wrkopereg'] = 1; $_SESSION['wrkcodreg'] = 0;
      }
}
?>

<body id="box00">
     <h1 class="cab-0">Índices - MoneyWay Investimentos - Profsa Informática</h1>
     <?php include_once "cabecalho-1.php"; ?>
     <div class="container-fluid">
          <div class="row">
               <div class="col-md-2">
                    <!-- Menu -->
                    <?php include_once "cabecalho-2.php"; ?>
               </div>
               <div class="col-md-10">
                    <!-- Corpo -->
                    <p class="lit-4">Manutenção de Índices - <?php echo  number_format(numero_reg('tb_indice'), 0, ",", "."); ?></p>
                    <form class="tel-1" name="frmTelMan" action="" method="POST">
                         <div class="row">
                              <div class="col-md-1"></div>
                              <div class="col-md-2">
                                   <label>Número</label>
                                   <input type="text" class="form-control text-center" maxlength="6" id="cod" name="cod"
                                        value="<?php echo $cod; ?>" disabled />
                              </div>
                              <div class="col-md-2">
                                   <label>Índice</label><br />
                                   <select id="ind" name="ind" class="form-control">
                                        <option value="0" <?php echo ($ind != 0 ? '' : 'selected="selected"'); ?>>
                                             iBovespa
                                        </option>
                                        <option value="1" <?php echo ($ind != 1 ? '' : 'selected="selected"'); ?>>
                                             CDI
                                        </option>
                                        <option value="2" <?php echo ($ind != 2 ? '' : 'selected="selected"'); ?>>
                                             IFHA
                                        </option>
                                        <option value="3" <?php echo ($ind != 3 ? '' : 'selected="selected"'); ?>>
                                             IFMM
                                        </option>
                                        <option value="4" <?php echo ($ind != 4 ? '' : 'selected="selected"'); ?>>
                                             IQT
                                        </option>
                                   </select>
                              </div>
                              <div class="col-md-2">
                                   <label>Data do Índice</label>
                                   <input type="text" class="form-control text-center" maxlength="10" id="dat" name="dat"
                                        value="<?php echo $dat; ?>" required />
                              </div>
                              <div class="col-md-2">
                                   <label>Taxa do Índice</label>
                                   <input type="text" class="form-control text-right" maxlength="10" id="tax" name="tax"
                                        value="<?php echo $tax; ?>" required />
                              </div>
                              <div class="col-md-2">
                                   <label>Status</label><br />
                                   <select id="sta" name="sta" class="form-control">
                                        <option value="0" <?php echo ($sta != 0 ? '' : 'selected="selected"'); ?>>
                                             Normal
                                        </option>
                                        <option value="1" <?php echo ($sta != 1 ? '' : 'selected="selected"'); ?>>
                                             Bloqueado
                                        </option>
                                        <option value="2" <?php echo ($sta != 2 ? '' : 'selected="selected"'); ?>>
                                             Suspenso
                                        </option>
                                        <option value="3" <?php echo ($sta != 3 ? '' : 'selected="selected"'); ?>>
                                             Cancelado
                                        </option>
                                   </select>
                              </div>
                              <div class="col-md-1"></div>
                         </div>
                         <br />
                         <div class="row text-center">
                              <div class="col-md-3"></div>
                              <div class="col-md-6 text-center">
                                   <button type="submit" name="salvar" <?php echo $per; ?>
                                        class="bot-1 <?php echo $del; ?> "><?php echo $bot; ?></button>
                              </div>
                              <div class="col-md-3"></div>
                         </div>
                         <br />
                    </form>
                    <br />
                    <hr /><br />
                    <div class="col-md-12 text-center">
                         <div class="tab-1 table-responsive">
                              <table id="tab-0" class="table table-sm table-striped">
                                   <thead>
                                        <tr>
                                             <th width="5%">Alterar</th>
                                             <th width="5%">Excluir</th>
                                             <th width="5%">Número</th>
                                             <th>Status</th>
                                             <th>Nome do Índice</th>
                                             <th>Data do Índice</th>
                                             <th>Taxa</th>
                                             <th>Inclusão</th>
                                             <th>Alteração</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php $ret = carrega_ind();  ?>
                                   </tbody>
                              </table>
                         </div>
                         <br />
                    </div>
               </div>
          </div>
     </div>
     <div id="box10">
          <img class="subir" src="img/subir.png" title="Volta a página para o seu topo." />
     </div>
</body>

<?php
if ($_SESSION['wrkopereg'] == 1 && $_SESSION['wrkcodreg'] == $cod) {
     exit('<script>location.href = "man-indice.php?ope=1&cod=0"</script>');
}

function ultimo_cod() {
     $cod = 1;
     include_once "dados.php";
     $nro = acessa_reg('Select idindice from tb_indice order by idindice desc Limit 1', $reg);
     if ($nro == 1) {
          $cod = $reg['idindice'] + 1;
     }        
     return $cod;
}

function consiste_ind() {
     $sta = 0;
     if (trim($_REQUEST['dat']) == "") {
          echo '<script>alert("Data do Índice de Moeda não pode estar em branco");</script>';
          return 1;
     }
     if (trim($_REQUEST['tax']) == "") {
          echo '<script>alert("Taxa do Índice de Moeda não pode estar em branco");</script>';
          return 1;
     }
     return $sta;
 }

function carrega_ind() {
     include_once "dados.php";
     $com = "Select * from tb_indice where indtipo = 1 order by indcodigo, inddata";
     $nro = leitura_reg($com, $reg);
     foreach ($reg as $lin) {
          $txt =  '<tr>';
          $txt .= '<td class="text-center"><a href="man-indice.php?ope=2&cod=' . $lin['idindice'] . '" title="Efetua alteração do registro informado na linha"><i class="large material-icons">healing</i></a></td>';
          $txt .= '<td class="lit-d text-center"><a href="man-indice.php?ope=3&cod=' . $lin['idindice'] . '" title="Efetua exclusão do registro informado na linha"><i class="cor-2 large material-icons">delete_forever</i></a></td>';
          $txt .= '<td class="text-center">' . $lin['idindice'] . '</td>';
          if ($lin['indstatus'] == 0) {$txt .= "<td>" . "Normal" . "</td>";}
          if ($lin['indstatus'] == 1) {$txt .= "<td>" . "Bloqueado" . "</td>";}
          if ($lin['indstatus'] == 2) {$txt .= "<td>" . "Suspenso" . "</td>";}
          if ($lin['indstatus'] == 3) {$txt .= "<td>" . "Cancelado" . "</td>";}
          if ($lin['indcodigo'] == 0) {$txt .= "<td>" . "iBovespa" . "</td>";}
          if ($lin['indcodigo'] == 1) {$txt .= "<td>" . "CDI" . "</td>";}
          if ($lin['indcodigo'] == 2) {$txt .= "<td>" . "IFHA" . "</td>";}
          if ($lin['indcodigo'] == 3) {$txt .= "<td>" . "IFMM" . "</td>";}
          if ($lin['indcodigo'] == 3) {$txt .= "<td>" . "IQT" . "</td>";}
          $txt .= '<td class="text-center">' . date('d/m/Y',strtotime($lin['inddata'])) . "</td>";
          $txt .= '<td class="text-center">' . number_format($lin['indtaxa'], 6, ",", ".") . "</td>";
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

function incluir_ind() {
     $ret = 0;
     include_once "dados.php";
     $sql  = "insert into tb_indice (";
     $sql .= "indstatus, ";
     $sql .= "indcodigo, ";
     $sql .= "indtipo, ";
     $sql .= "inddata, ";
     $sql .= "indtaxa, ";
     $sql .= "keyinc, ";
     $sql .= "datinc ";
     $sql .= ") value ( ";
     $sql .= "'" . $_REQUEST['sta'] . "',";
     $sql .= "'" . $_REQUEST['ind'] . "',";
     $sql .= "'" . '1' . "',";
     $sql .= "'" . inverte_dat(1, $_REQUEST['dat']) . "',";
     $sql .= "'" . str_replace(",", ".", $_REQUEST['tax']) . "',";
     $sql .= "'" . $_SESSION['wrkideusu'] . "',";
     $sql .= "'" . date("Y/m/d H:i:s") . "')";
     $ret = comando_tab($sql, $nro, $ult, $men);
     if ($ret == false) {
          print_r($sql);
          echo '<script>alert("Erro na gravação do registro solicitado !");</script>';
     }
     return $ret;
}

function ler_indice(&$cha, &$dat, &$sta, &$ind, &$tax) {
     include_once "dados.php";
     $nro = acessa_reg("Select * from tb_indice where idindice = " . $cha, $reg);            
     if ($nro == 0) {
          echo '<script>alert("Código do Índice de Moeda informado não cadastrado no sistema");</script>';
     } else {
          $cha = $reg['idindice'];
          $ind = $reg['indcodigo'];
          $sta = $reg['indstatus'];
          $dat = date('d/m/Y',strtotime($reg['inddata']));
          $tax = number_format($reg['indtaxa'], 6, ",", ".");
     }
     return $cha;
 }

 function alterar_ind() {
     $ret = 0;
     include_once "dados.php";
     $sql  = "update tb_indice set ";
     $sql .= "indstatus = '". $_REQUEST['sta'] . "', ";
     $sql .= "inddata = '". inverte_dat(1, $_REQUEST['dat']) . "', ";
     $sql .= "indtaxa = '". str_replace(",", ".", $_REQUEST['tax']) . "', ";
     $sql .= "indcodigo = '". $_REQUEST['ind'] . "', ";
     $sql .= "keyalt = '" . $_SESSION['wrkideusu'] . "', ";
     $sql .= "datalt = '" . date("Y/m/d H:i:s") . "' ";
     $sql .= "where idindice = " . $_SESSION['wrkcodreg'];
     $ret = comando_tab($sql, $nro, $ult, $men);
     if ($ret == false) {
          print_r($sql);
          echo '<script>alert("Erro na regravação do registro solicitado !");</script>';
     }
     return $ret;
 } 

 function excluir_ind() {
     $ret = 0;
     include_once "dados.php";
     $sql  = "delete from tb_indice where idindice = " . $_SESSION['wrkcodreg'] ;
     $ret = comando_tab($sql, $nro, $ult, $men);
     if ($ret == false) {
          print_r($sql);
          echo '<script>alert("Erro na exclusão do registro solicitado !");</script>';
     }
     return $ret;
 }


?>

</html>
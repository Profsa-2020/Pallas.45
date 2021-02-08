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
     $('.pre-1').hide();

     $('#upload').bind("click", function() {
          let arq = $('#arq').val();
          if (arq == 0) {
               alert("Não foi informada uma opção de arquivo para efetuar UpLoad");
          } else {
               $('#arq-up').click();
          }
     });

     $('#arq-up').change(function() {
          var arqu = $(this)[0].files[0].name;
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

          }
     });

     $('#frmTelImp').submit(function() {
          let arq = $('#arq').val();          
          let sta = $('#sta_a').val();
          let reg = $('#reg_a').val();
          if (sta == 0) {
               alert("Não há arquivo informado para efetuar UpLoad e Importação");
          } else {
               $('.pre-1').show();
               form = $(this);
               var formulario = new FormData(form[0]);               
               $.ajax({
                    url: 'ajax/upload-csv.php?arq=' + arq + '&reg=' + reg, 
                    data: formulario,
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function (data) {
                         if (data.men != "") {
                              alert(data.men);
                         } else {
                              $('#sta_a').val(0);
                              $('#nom_a').text('UpLoad do arquivo processado com sucesso !');
                              $('#dat_a').text('');
                              $('#lin_a').text('');
                              $('#tam_a').text('');
                              $('#max_a').text('');
                              $('#reg_a').text(0);
                         }
                    },
                    error: function(data){
                         console.log("Erro: " + JSON.stringify(data));	
                         alert('Um erro ocorreu no processamento do UpLoad do arquivo');
                    }
               });
               $('.pre-1').hide();
               return false;
          }
          return false;
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
     $max = ini_get('upload_max_filesize');
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

                    <form class="qua-4" id="frmTelImp" name="frmTelImp" action="processo-imp.php" method="POST"
                         enctype="multipart/form-data">
                         <br /><br />
                         <div class="row">
                              <div class="col-md-2"></div>
                              <div class="cpo-1 col-md-8">
                                   <label>Arquivo .Csv a ser importado</label>
                                   <select id="arq" name="arq" class="form-control">
                                        <option value="0">Selecione o arquivo a ser importado ...
                                        </option>
                                        <option value="1">Informações Cadastrais</option>
                                        <option value="2">Informações Diárias (movimento)</option>
                                   </select>
                              </div>
                              <div class="col-md-2"></div>
                         </div>
                         <br />
                         <div class="row">
                              <div class="col-md-12 text-center">
                                   <strong>
                                        <span id="nom_a">Nome do Arquivo: </span><br />
                                        <span id="dat_a">Data do Arquivo: </span><br />
                                        <span id="tam_a">Tamanho do Arquivo: </span><br />
                                        <span id="lin_a">Número de Linhas: </span><br />
                                        <span id="max_a">Tamanho Máximo: </span><br />
                                   </strong>
                              </div>
                         </div>
                         <br /><br />
                         <div class="row text-center">
                              <div class="col-md-3"></div>
                              <div class="col-md-3">
                                   <button type="button" id="upload" name="upload" class="bot-1"> <i
                                             class="cur-1 fa fa-upload fa-1g" aria-hidden="true"></i> UpLoad</button>
                              </div>
                              <div class="col-md-3">
                                   <button type="submit" id="processa" name="processa" class="bot-1"> <i
                                             class="cur-1 fa fa-cogs fa-1g" aria-hidden="true"></i> Processar</button>
                              </div>
                              <div class="col-md-3"></div>
                         </div>
                         <br />
                         <input type="hidden" id="sta_a" name="sta_a" value="0" />
                         <input type="hidden" id="reg_a" name="reg_a" value="0" />
                         <input type="hidden" id="tam_m" name="tam_m" value="<?php echo ini_get('upload_max_filesize'); ?>" />
                         <input name="arq-up" type="file" id="arq-up" class="bot-3" accept=".csv" />
                    </form>

                    <div class="pre-1" class="row text-center">
                         <div class="col-md-12">
                              <img id="pre-2" class="img-fluid" src="img/preloader2.gif">
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div id="box10">
          <img class="subir" src="img/subir.png" title="Volta a página para o seu topo." />
     </div>
</body>

</html>
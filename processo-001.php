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

     $('#bot_11').bind("click", function() {
          $('#bot_a1').click();
     });

     $('#bot_21').bind("click", function() {
          $('#bot_a2').click();
     });

     $('#bot_a1').change(function() {
          var nro = 0;
          var max = parseInt($('#tam_m').val().replace(/[^0-9]/g, ''), 10) * 1024;
          var arqu = $(this)[0].files[0];
          var path = $('#bot_a1').val();
          var data = $(this)[0].files[0].lastModifiedDate;
          data = ((data.getDate())) + "/" + ((data.getMonth() + 1)) + "/" + data.getFullYear();
          tam = $(this)[0].files[0]['size'] / 1024;
          if (tam >= max) {
               $('#dat_a').val(''); $('#nom_a').val(''); $('#dat_11').text('');
               alert("Arquivo a ser feito UpLoad (" + Math.round(tam,0) + "kb) é maior que o permitido");
          } else {
               $('#nom_a').val(path);
               $('#dat_a').val(data);
               $('#nom_11').text(path);
               $('#dat_11').text(data);
               $('#tam_11').text(tam.toFixed(0) + ' kb');

               var fileReader = new FileReader();
               fileReader.onload = function() {
                    const lines = fileReader.result.split('\n').map(function(line) {
                         return line.split(';');
                    })
                    $('#qtd_l').val(lines.length - 2);
                    $('#lin_11').empty().text(lines.length - 2);
               }
               fileReader.readAsText($(this)[0].files[0]);
          }
     });

     $('#bot_a2').change(function() {
          var nro = 0;
          var max = parseInt($('#tam_m').val().replace(/[^0-9]/g, ''), 10) * 1024;
          var arqu = $(this)[0].files[0];
          var path = $('#bot_a2').val();
          var data = $(this)[0].files[0].lastModifiedDate;
          data = ((data.getDate())) + "/" + ((data.getMonth() + 1)) + "/" + data.getFullYear();
          tam = $(this)[0].files[0]['size'] / 1024;
          if (tam >= max) {
               $('#dat_a').val(''); $('#nom_a').val('');$('#dat_21').text('');
               alert("Arquivo a ser feito UpLoad (" + Math.round(tam,0) + "kb) é maior que o permitido");
          } else {
               $('#nom_a').val(path);
               $('#dat_a').val(data);
               $('#nom_21').text(path);
               $('#dat_21').text(data);
               $('#tam_21').text(tam.toFixed(0) + ' kb');

               var fileReader = new FileReader();
               fileReader.onload = function() {
                    const lines = fileReader.result.split('\n').map(function(line) {
                         return line.split(';');
                    })
                    $('#qtd_l').val(lines.length - 2);
                    $('#lin_21').empty().text(lines.length - 2);
               }
               fileReader.readAsText($(this)[0].files[0]);
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
                    <form id="frmTelImp" name="frmTelImp" action="processo-imp.php" method="POST" enctype="multipart/form-data">
                         <table class="table table-sm">
                              <thead>
                                   <tr>
                                        <th class="text-center">Abrir Janela</th>
                                        <th>Tipo de Dado</th>
                                        <th>Nome do Arquivo</th>
                                        <th class="text-center">Data</th>
                                        <th class="text-center">Tamanho</th>
                                        <th class="text-center">Linhas</th>
                                        <th class="text-center">Processamento</th>
                                        <th class="text-center">Processar</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <tr>
                                        <td id="bot_11" class="text-center"><i class="cur-1 fa fa-upload fa-3x"
                                                  aria-hidden="true"></i></td>
                                        <th>Informações Cadastrais</th>
                                        <th id="nom_11"></th>
                                        <th id="dat_11" class="text-center"></th>
                                        <th id="tam_11" class="text-center"></th>
                                        <th id="lin_11" class="text-center"></th>
                                        <th id="pro_11" class="text-center"><progress id="bar_11" value="1"
                                                  max="100"></progress></th>
                                        <th id="gra_11" class="text-center"><button type="submit" id="sal_11"
                                                  name="sal_11" class="bot-4">Salvar</button></th>
                                   </tr>
                                   <tr>
                                        <td id="bot_21" class="text-center"><i class="cur-1 fa fa-upload fa-3x"
                                                  aria-hidden="true"></i></td>
                                        <th>Informações Diárias</th>
                                        <th id="nom_21"></th>
                                        <th id="dat_21" class="text-center"></th>
                                        <th id="tam_21" class="text-center"></th>
                                        <th id="lin_21" class="text-center"></th>
                                        <th id="pro_21" class="text-center"><progress id="bar_21" value="2"
                                                  max="100"></progress></th>
                                        <th id="gra_21" class="text-center"><button type="submit" id="sal_21"
                                                  name="sal_21" class="bot-4">Salvar</button></th>
                                   </tr>
                              </tbody>
                         </table>
                         <input type="hidden" id="qtd_l" name="qtd_l" value="0" />
                         <input type="hidden" id="nom_a" name="nom_a" value="" />
                         <input type="hidden" id="dat_a" name="dat_a" value="" />
                         <input type="hidden" id="tam_m" name="tam_m" value="<?php echo ini_get('upload_max_filesize'); ?>" />
                         <input name="arq-a1" type="file" id="bot_a1" class="bot-3" accept=".csv" />
                         <input name="arq-a2" type="file" id="bot_a2" class="bot-3" accept=".csv" />
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

<script>
$(document).on('submit', 'form', function(e) {
     $('.pre-1').show();    
     e.preventDefault();
     $form = $(this);

     var bot_1 = document.getElementById('bot_a1').files;
     var bot_2 = document.getElementById('bot_a2').files;

     var formdata = new FormData($form[0]);
     var request = new XMLHttpRequest();
     request.upload.addEventListener('progress', function(e){
          var percent = Math.round(e.loaded / e.total + 100);
          if (bot_1 != undefined) { $('#bar_11').val(percent) };
          if (bot_2 != undefined) { $('#bar_21').val(percent) };
     });
     request.addEventListener('load', function(e){
          $form.find('.progress-bar').text('upload completo ...');
          $('#qtd_l').val(0);
          $('#nom_a').val('');
          $('#dat_a').val('');
          if (bot_1 != undefined) {
               $('#nom_11').text('');
               $('#dat_11').text('');
               $('#lin_11').text('');
               $('#tam_11').text('kb');         
          }
          if (bot_2 != undefined) {
               $('#nom_21').text('');
               $('#dat_21').text('');
               $('#lin_21').text('');
               $('#tam_21').text('kb');         
          }
          $('.pre-1').hide();     
          //setTimeout("window.open(self.location, '_self');",1000);
     });
     request.open('POST', 'ajax/upload-csv.php');
     request.send(formdata);
})

</script>

</html>

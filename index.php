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

     <link rel="icon" href="https://moneyway.com.br/wp-content/uploads/2020/11/cropped-money-way-favicon-32x32.png" sizes="32x32" />
     <link rel="icon" href="https://moneyway.com.br/wp-content/uploads/2020/11/cropped-money-way-favicon-192x192.png" sizes="192x192" />
     <link rel="apple-touch-icon" href="https://moneyway.com.br/wp-content/uploads/2020/11/cropped-money-way-favicon-180x180.png" />
     <meta name="msapplication-TileImage" content="https://moneyway.com.br/wp-content/uploads/2020/11/cropped-money-way-favicon-270x270.png" />     

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

     <link href="css/pallas45.css" rel="stylesheet" type="text/css" media="screen" />
     <title>Login - Análise de Investimentos - Profsa Informátda Ltda</title>
</head>

<script>
$(document).ready(function() {
     $('#frmLogin').submit(function() {
          var ema = $('#ema').val();
          var sen = $('#sen').val();
          $.getJSON("ajax/verifica-ace.php", {
                    ema: ema,
                    sen: sen
               })
               .done(function(data) {
                    if (data.err != "") {
                         $('#ema').val('');
                         $('#sen').val('');
                         alert(data.err);
                    } else {
                         if (data.men != "") {
                              alert(data.men);
                         }
                         location.href = "menu01.php";
                    }
               }).fail(function(data) {
                    console.log('Erro: ' + JSON.stringify(data));
                    alert("Erro ocorrido no processamento de login e senha de acesso");
               });
          return false;
     });

});
</script>

<body class="login">
<h1 class="cab-0">Login inicial sistema de Análise de Investimentos - Profsa Informática</h1>
     <div class="entrada">
          <div class="qua-1 animated bounceInDown">
               <form class="cpo-0" id="frmLogin" name="frmLogin" action="" method="POST">
                    <br />
                    <div class="row">
                         <a href="http://www.moneyway.com.br/">
                              <img class="ima-1" src="img/logo-02.png" alt="Logotipo da empresa Profsa Informática"
                                   title="Acesso ao site principal da empresa Profsa Informática" />
                         </a>
                    </div>
                    <br />
                    <div class="row">
                         <div class="col s1"></div>
                         <div class="input-field col s10">
                              <i class="cor-1 material-icons prefix">email</i>
                              <input type="email" class="center" id="ema" name="ema" maxlength="75" value="" required >
                              <label for="nome">E-mail do usuário para acesso ...</label>
                         </div>
                         <div class="col s1"></div>
                    </div>

                    <div class="row">
                         <div class="col s1"></div>
                         <div class="input-field col s10">
                              <i class="cor-1 material-icons prefix">lock</i>
                              <input type="password" class="center" id="sen" name="sen" maxlength="15" value="" required >
                              <label for="senha">Senha de acesso ao sistema ...</label>
                         </div>
                         <div class="col s1"></div>
                    </div>

                    <div class="row">
                         <input class="bot-1" type="submit" id="ent" name="entrar" value="Entrar" />
                         <br /><br />
                         <input type="checkbox" id="lem" name="lembrete" value="S" />
                         <label class="tit-1" for="lem">Lembrar Login</label>
                         <br /><br />
                         <span class="tit-2"><a href="recupera.php">Esqueci a senha</a></span>
                    </div>
                    <br />
               </form>
          </div>
     </div>
</body>

</html>

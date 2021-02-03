<?php
     function acessa_ema($ema, &$reg) {
          $nro_r = 0; $reg = array(); 
          include_once "lerinformacao.inc";
          $sql = mysqli_query($conexao,"Select usustatus, usunome, usuemail, ususenha, usuvalidade, usuacessos from tb_usuario where usuemail = '" . $ema . "'");
          $nro_r = mysqli_num_rows($sql);
          if (mysqli_num_rows($sql) == 1) {
               $reg = mysqli_fetch_array($sql);
          }
          return $nro_r;
     }

     function comando_tab($sql, &$nro, &$cha, &$men) {
          $men = "";
          include "lerinformacao.inc";
          $ret = mysqli_query($conexao, $sql);
          $nro = mysqli_affected_rows($conexao);  // Número de linhas afetadas pelo comando
          $cha = mysqli_insert_id($conexao); // Auto Increment Id
          if ($ret == false) {
               $men = "Erro no processamento do comando do registro solicitado !";
          }
          return $ret;
     } 

     function acessa_ini($ema, $sen, &$reg) {
          $nro_r = 0; $reg = array(); $sen = base64_encode($sen);
          include_once "lerinformacao.inc";
          $sql = mysqli_query($conexao,"Select * from tb_usuario where usuemail = '" . $ema . "' and ususenha = '" . $sen . "'");
          $nro_r = mysqli_num_rows($sql);
          if (mysqli_num_rows($sql) == 1) {
               $reg = mysqli_fetch_array($sql);
          }
          return $nro_r;
     }

?>

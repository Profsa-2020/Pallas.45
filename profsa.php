<?php

function envia_email($end_ema, $asu_ema, $tex_env, $nom_usu, $anexo_1, $anexo_2) {
     if ($_SESSION['wrkendser'] == '127.0.0.1') { return 1; }
      ini_set("smtp_port", 25);    // 25 - 143 - 110 - 587 - 465
     if ($asu_ema == "") {
          $asu_ema ="Re-envio de login e senha a usuário do sistema !";
     }
     $headers  = 'From: e-commerce@pdvcontrol.com.br' . "\r\n";
     $headers .= 'MIME-Version: 1.0' . "\r\n";
     $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
     $envio = mail($end_ema, $asu_ema, $tex_env, $headers);
     if ($envio == true):
          return 1;
     else:
          return 0;
     endif;
}

function gravar_log($ope = 0, $obs = "", $cod = "") {
     date_default_timezone_set("America/Sao_Paulo");
     $ser = substr(getenv("REMOTE_ADDR") . "|" . getenv("HTTP_USER_AGENT") . "|" . getenv("REMOTE_HOST") . "|" . getenv("SERVER_NAME") . "|" . getenv("SERVER_SOFTWARE") ,0,255) ; 
     $ip  = getenv("REMOTE_ADDR");
     $nav = getenv("HTTP_USER_AGENT");
     $nom = "";
     $cid = "";
     $est = "";
     $sta = "";
     $sen = 00;
     $emp = 00;
     $nro = 00;
     $doc = 00;
     $ema = "";
     $ant = "";
     $cam = "";
     $prg = "";
     $tam = 00;
     $mod = 01;
     $ext = "";
     $end = buscar_ip($ip);
     $pro = getenv("SERVER_SOFTWARE");
     $tip = 00;
     $gap = 00;
 
     if (isset($_SESSION['wrkcodloj']) == true) {$emp = $_SESSION['wrkcodloj'];}
     if (isset($_SESSION['wrkstasen']) == true) {$sta = $_SESSION['wrkstasen'];}
     if (isset($_SESSION['wrknomusu']) == true) {$nom = $_SESSION['wrknomusu'];}
     if (isset($_SESSION['wrkideusu']) == true) {$sen = $_SESSION['wrkideusu'];}
     if (isset($_SESSION['wrktipusu']) == true) {$tip = $_SESSION['wrktipusu'];}
     if (isset($_SESSION['wrkemausu']) == true) {$ema = $_SESSION['wrkemausu'];}
     if (isset($_SESSION['wrknompro']) == true) {$prg = $_SESSION['wrknompro'];}
     if (isset($_SESSION['wrknomant']) == true) {$ant = $_SESSION['wrknomant'];}
     if (isset($_SESSION['wrknumdoc']) == true) {$doc = $_SESSION['wrknumdoc'];}
     if (isset($_SESSION['wrknumcha']) == true) {$nro = $_SESSION['wrknumcha'];}
     if (isset($_SESSION['wrkcidusu']) == true) {$cid = $_SESSION['wrkcidusu'];}
     if (isset($_SESSION['wrkestusu']) == true) {$est = $_SESSION['wrkestusu'];} 
     if ($nom == "") { $nom = substr(get_current_user(), 0, 50); }
 
     if ($tam == "") { $tam = 0; }
     $prg = str_replace(__DIR__ . "\\", "", $prg);
 
     $dat = date("Y/m/d H:i:s");
     $sql = "Insert into tb_log ";
     $sql .= "(logdatahora, logempresa, logmodulo, lognumero, logdocto, logusuario, logtipo, logidsenha, logemail, logip, lognavegador, logprovedor, logoperacao,  logprograma, loganterior, logcidade, logestado, logobservacao)";
     $sql .= " values " . "(";
     $sql .= "'" . $dat . "',";
     $sql .= "'" . $emp . "',";
     $sql .= "'" . $mod . "',";
     $sql .= "'" . $nro . "',";
     $sql .= "'" . $doc . "',";
     $sql .= "'" . $nom . "',";
     $sql .= "'" . $tip . "',";
     $sql .= "'" . $sen . "',";
     $sql .= "'" . $ema . "',";
     $sql .= "'" . $ip  . "',";		
     $sql .= "'" . $nav . "',";
     $sql .= "'" . $pro . "',";
     $sql .= "'" . $ope . "',";
     $sql .= "'" . limpa_pro($prg) . "',";
     $sql .= "'" . limpa_pro($ant) . "',";
     $sql .= "'" . $cid . "',";
     $sql .= "'" . $est . "',";
     $sql .= "'" . $obs . "')";
     $ret = comando_tab($sql, $nro, $cha, $men); 
     if ($ret == false) {
          print_r($sql);
          echo '<script>alert("Erro na gravação de Log de acessos ao sistema !");</script>'; exit();
     } 
 }
 
 function buscar_ip($ip) {
     $end = curl_init('http://ipinfo.io/' . $ip . '/json');
     curl_setopt($end, CURLOPT_RETURNTRANSFER, true);    
     curl_setopt($end, CURLOPT_SSL_VERIFYPEER, false);
     $ret = curl_exec($end);
     $dad = json_decode($ret);
     curl_close($end);    
     $_SESSION['wrkcidusu'] = 'niteroi';
     $_SESSION['wrkestusu'] = 'rj';
     if (isset($dad->bogon) == true) {
          $_SESSION['wrkcidusu'] = 'Niteroi';
          $_SESSION['wrkestusu'] = 'Rj';
     } else if (isset($dad->city) == true) {
          $_SESSION['wrkcidusu'] = $dad->city;
          $_SESSION['wrkestusu'] = $dad->region;
          if ($_SESSION['wrkestusu'] == "São Paulo") { $_SESSION['wrkestusu'] = "SP"; }
          if ($_SESSION['wrkestusu'] == "Sao Paulo") { $_SESSION['wrkestusu'] = "SP"; }
          if ($_SESSION['wrkestusu'] == "Paraná") { $_SESSION['wrkestusu'] = "PR"; }
          if ($_SESSION['wrkestusu'] == "Parana") { $_SESSION['wrkestusu'] = "PR"; }
          if ($_SESSION['wrkestusu'] == "Minas Gerais") { $_SESSION['wrkestusu'] = "MG"; }
          if ($_SESSION['wrkestusu'] == "Rio de Janeiro") { $_SESSION['wrkestusu'] = "RJ"; }
          if ($_SESSION['wrkestusu'] == "Espirito Santo") { $_SESSION['wrkestusu'] = "ES"; }
          if ($_SESSION['wrkestusu'] == "Espírito Santo") { $_SESSION['wrkestusu'] = "ES"; }
     }
     return $dad;
}

function limpa_pro($nom)  {
     $ind = strrpos ($nom,"/");
     if ($ind > 0) {
          $nom = substr($nom,$ind + 1);  
          $ind = strrpos ($nom,".php");
          $nom = substr($nom,0, $ind);  
     } 
     $ind = strrpos ($nom,"\\");
     if ($ind > 0) {
          $nom = substr($nom,$ind + 1);  
          $ind = strrpos ($nom,".php");
          $nom = substr($nom,0, $ind);  
     }
     return $nom;
 }

 function primeiro_nom($nom) {
     $pos = strpos($nom," "); 
     if ($pos > 0) {
          $nom = trim(substr($nom, 0, $pos));
     }
     return $nom;
 }

 function diferenca_dat($dat_i = "", $dat_f = "") {
     $dia = 0;
     if ($dat_i == "") { $dat_i = date("Y-m-d"); }
     if (substr($dat_f, 2, 1) == '-' || substr($dat_f, 2, 1) == '/') {
          $dat_f = substr($dat_f, 6, 4) . "-" . substr($dat_f, 3, 2) . "-" . substr($dat_f, 0, 2);
     }
     $data1 = new DateTime($dat_i);
     $data2 = new DateTime($dat_f);
     $intervalo = $data1->diff($data2);
     $dia = $intervalo->days;
     if ($dat_i > $dat_f) { $dia = $dia * -1; }
     return $dia;
 }
 
 function valida_ent($sen,$ema){
     $nro = 0;
     $nro += stripos($ema,"'");
     $nro += stripos($sen,"'");
     $nro += stripos($ema,"=");
     $nro += stripos($sen,"=");
     $nro += stripos($ema,";");
     $nro += stripos($sen,";");
     $nro += stripos($ema,"\"");
     $nro += stripos($sen,"\"");
     $nro += stripos($ema,"<");
     $nro += stripos($sen,"<");
     $nro += stripos($ema,"\/");
     $nro += stripos($sen,"\/");
     $nro += stripos($ema,">");
     $nro += stripos($sen,">");
     $nro += stripos(strtoupper($ema),"DROP");
     $nro += stripos(strtoupper($sen),"DROP");
     $nro += stripos(strtoupper($ema),"UNION");
     $nro += stripos(strtoupper($sen),"UNION");
     $nro += stripos(strtoupper($ema),"SELECT");
     $nro += stripos(strtoupper($sen),"SELECT");
     $nro += stripos(strtoupper($ema),"DELETE");
     $nro += stripos(strtoupper($sen),"DELETE");
     $nro += stripos(strtoupper($ema),"WHERE");
     $nro += stripos(strtoupper($sen),"WHERE");
     return $nro;
 }
 
?>

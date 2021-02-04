<?php
     if (isset($_SESSION['wrknomusu']) == false) {
          exit('<script>location.href = "index.php"</script>');   
     } elseif ($_SESSION['wrknomusu'] == "") {
          exit('<script>location.href = "index.php"</script>');   
     } elseif ($_SESSION['wrknomusu'] == "*") {
          exit('<script>location.href = "index.php"</script>');   
     } elseif ($_SESSION['wrknomusu'] == "#") {
          exit('<script>location.href = "index.php"</script>');   
     }   
     date_default_timezone_set("America/Sao_Paulo");
     if (isset($_SESSION['wrknomemp']) == false) { $_SESSION['wrknomemp'] = '*.*.*.*.*.*.*.*.*.*.*.*.*.*.*.*.*.*.*.*'; }
?>
<div class="row qua-2">
     <div class="col-md-2 text-center">
          <a href="menu01.php"> <img src="img/logo-03.png"
                    title="Sistema de Análise de Investimentos - MoneyWay Investimentos"></a>
     </div>
     <div class="col-md-8 text-center">
          <?php
                    echo '<div class="lit-1">';
                    echo '<span>' . $_SESSION['wrknomemp'] . '</span>';
                    echo '</div>';
               ?>
     </div>
     <div class="col-md-2 text-center">
          <?php
                    echo '<strong>' . $_SESSION['wrknomusu'] . '</strong>' . '<br />' ;
                    echo '<div class="lit-2">' . $_SESSION['wrkemausu'] . '</div>' . '' ;
                    echo '<div class="lit-2">' . date('d/m/Y H:i:s')  . '</div>' . '';
                    echo '</a>';
               ?>
     </div>
</div>
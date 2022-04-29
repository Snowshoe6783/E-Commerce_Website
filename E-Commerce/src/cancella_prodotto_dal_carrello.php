<!-- 
  Sposta file nella cartella immagini.  
!-->
<?php

include("connessione_database.php");

session_start();
if (isset($_SESSION['utente_ID'])) {
  echo "Benvenuto " . $_SESSION['utente_ID'];
}

$link_cartella_immagini = "../public/assets/img/quadri/";
?>

<?php
    $query = "DELETE FROM acquisto
              WHERE ordine_ID = '" . $_GET['ordine_ID'] . "'
                AND quadro_ID = '" . $_GET['quadro_ID'] . "';";
    $result = $conn->query($query);
    //$result = $conn->query($query);
  header("location: ../public/html/carrello.php");




?>

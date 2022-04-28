<?php
$link_cartella_immagini = "../assets/img/quadri/";
include("../../src/connessione_database.php");

session_start();
if (isset($_SESSION['utente_ID']) && ($_SESSION['ruolo_ID'] == '1' || $_SESSION['ruolo_ID'] == '2')) {
  echo "Benvenuto " . $_SESSION['utente_ID'];
}else{
    http_response_code(403);
    die('Non hai accesso a questa pagina.');
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>PHP File Upload</title>
</head>

<body>
  <a href="index.php">Home</a><br>
  <?php
  if (isset($_POST['cancella_prodotto'])) {
    $query = "UPDATE quadro
              SET archiviato = '1'
              WHERE quadro_ID = '" . $_GET['quadro_ID'] . "';";

    echo $query;
    $result = $conn->query($query);
  }
  ?>

</body>

</html>
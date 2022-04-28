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
  if (isset($_SESSION['message']) && $_SESSION['message']) {
    printf('<b>%s</b>', $_SESSION['message']);
    unset($_SESSION['message']);
  }
  ?>
  <form method="POST" action="../../src/upload.php" enctype="multipart/form-data">
    <div>
      <span>Upload a File:</span>
      <input type="file" name="uploadedFile" />
    </div>

    Nome quadro: <input type="text" name="dati_prodotto_da_aggiungere[nome_quadro]" required><br>
    Nome autore: <input type="text" name="dati_prodotto_da_aggiungere[nome_autore]" required><br>
    Genere: <input type="text" name="dati_prodotto_da_aggiungere[genere]" required><br>
    Nazione di Origine: <input type="text" name="dati_prodotto_da_aggiungere[nazione_di_origine]" required><br>
    Descrizione breve: <input type="text" name="dati_prodotto_da_aggiungere[descrizione_breve]" required><br>
    Descrizione dettagliata: <input type="text" name="dati_prodotto_da_aggiungere[descrizione_dettagliata]" required><br>
    Prezzo: <input type="text" name="dati_prodotto_da_aggiungere[prezzo]" required><br>
    Quantità in magazzino: <input type="text" name="dati_prodotto_da_aggiungere[quantita_in_magazzino]" required><br>


    <input type="submit" name="submit_cambiamento" value="Upload" />
  </form>
</body>

</html>
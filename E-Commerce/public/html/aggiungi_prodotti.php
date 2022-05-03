<?php
$link_cartella_immagini = "../assets/img/quadri/";
include("../../src/connessione_database.php");

session_start();
if (isset($_SESSION['utente_ID']) && ($_SESSION['ruolo_ID'] == '1' || $_SESSION['ruolo_ID'] == '2')) {
  echo "Utente: " . $_SESSION['username'];
}else{
    http_response_code(403);
    die('Non hai accesso a questa pagina.');
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>aggiungi prodotto</title>
  <link rel="stylesheet" href="../assets/css/style_generale.css" type="text/css">
  <link rel="stylesheet" href="../assets/css/modifica_prodotti.css" type="text/css">
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
  <div class="grid_input">

    Nome quadro: <input type="text" name="dati_prodotto_da_aggiungere[nome_quadro]" required>
    Nome autore: <input type="text" name="dati_prodotto_da_aggiungere[nome_autore]" required>
    Genere: <input type="text" name="dati_prodotto_da_aggiungere[genere]" required>
    Nazione di Origine: <input type="text" name="dati_prodotto_da_aggiungere[nazione_di_origine]" required>
    Descrizione breve: <input type="text" name="dati_prodotto_da_aggiungere[descrizione_breve]" required>
    Descrizione dettagliata: <input type="text" name="dati_prodotto_da_aggiungere[descrizione_dettagliata]" required>
    Prezzo: <input type="text" name="dati_prodotto_da_aggiungere[prezzo]" required>
    Quantità in magazzino: <input type="text" name="dati_prodotto_da_aggiungere[quantita_in_magazzino]" required>
    
      <span>Upload a File:</span>
      <input type="file" name="uploadedFile" required/>
    
</div>
    <input type="submit" name="submit_cambiamento" value="Upload" />
  </form>
</body>

</html>
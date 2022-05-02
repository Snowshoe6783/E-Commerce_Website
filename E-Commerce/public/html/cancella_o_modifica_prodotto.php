<?php
$link_cartella_immagini = "../assets/img/quadri/";
include("../../src/connessione_database.php");

session_start();
if (isset($_SESSION['utente_ID']) && ($_SESSION['ruolo_ID'] == '1' || $_SESSION['ruolo_ID'] == '2')) {
  echo "Utente " . $_SESSION['utente_ID'];
}else{
    http_response_code(403);
    die('Non hai accesso a questa pagina.');
}
?>

<!DOCTYPE html>
<html>

<head>
  <link rel="icon" type="image/x-icon" href="../assets/ico/carrello.ico">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="../assets/css/style_generale.css" type="text/css">
  <title>Modifica Prodotto</title>

</head>
<a href="index.php">Home</a><br>

<body>

  <h1>
    Modifica Prodotto
  </h1>

  <?php
  $query = "SELECT quadro_ID AS 'Quadro ID', 
                         nome_quadro AS 'Nome Quadro', 
                         nome_autore AS 'Nome Autore', 
                         nazione_di_origine AS 'Nazione di Origine', 
                         genere AS 'Genere', 
                         descrizione_breve AS 'Descrizione Breve', 
                         descrizione_dettagliata AS 'Descrizione Dettagliata', 
                         prezzo AS 'Prezzo', 
                         quantita_in_magazzino AS 'Quantità', 
                         link_quadro AS 'Link Quadro' 
				    FROM quadro
            WHERE quadro_ID = '" . $_GET['quadro_ID'] . "'";


  $result = $conn->query($query);





  foreach ($result as $row) {

    $quadro_ID = $row['Quadro ID'];
    $nome_quadro = $row['Nome Quadro'];
    $nome_autore = $row['Nome Autore'];
    $nazione_di_origine = $row['Nazione di Origine'];
    $genere = $row['Genere'];
    $descrizione_breve = $row['Descrizione Breve'];
    $descrizione_dettagliata = $row['Descrizione Dettagliata'];
    $prezzo = $row['Prezzo'];
    $quantita = $row['Quantità'];
    $link_quadro = $row['Link Quadro'];

    //cambia tutta sta roba


    //echo "<a href = "cancella_o_modifica_prodotto.php?quadro_ID=$quadro_ID">Cancella/Modifica";


  }
  ?>
  <form method="POST" action="../../src/upload.php?quadro_ID=<?= $quadro_ID ?>" enctype="multipart/form-data">

    <br>ID quadro: <?= $quadro_ID ?>
    <br>Nome Quadro: <input type="text" name="dati_prodotto_da_modificare[nome_quadro]" value="<?= $nome_quadro ?>">
    <br>Nome Autore: <input type="text" name="dati_prodotto_da_modificare[nome_autore]" value="<?= $nome_autore ?>">
    <br>Nazione di origine: <input type="text" name="dati_prodotto_da_modificare[nazione_di_origine]" value="<?= $nazione_di_origine ?>">
    <br>Genere: <input type="text" name="dati_prodotto_da_modificare[genere]" value="<?= $genere ?>">
    <br>Descrizione Breve<input type="text" name="dati_prodotto_da_modificare[descrizione_breve]" value="<?= $descrizione_breve ?>">
    <br>Descrizione Dettagliata<input type="text" name="dati_prodotto_da_modificare[descrizione_dettagliata]" value="<?= $descrizione_dettagliata ?>">
    <br>Prezzo<input type="text" name="dati_prodotto_da_modificare[prezzo]" value="<?= $prezzo ?>">
    <br>Quantità<input type="text" name="dati_prodotto_da_modificare[quantita]" value="<?= $quantita ?>">
    <div>
      <span>Upload a File:</span>
      <input type="file" name="uploadedFile" />
    </div>

    <input type='submit' onclick="return confirm('Are you sure?')" name="submit_cambiamento" value="Upload"/>
    



  </form>

  <?php
 
  ?>

  <form method="POST" action="cancella_prodotto.php?quadro_ID=<?= $quadro_ID ?>">
    <input type='submit' onclick="return confirm('Are you sure?')" name="cancella_prodotto" value="Cancella prodotto"/>

  </form>



</body>

</html>
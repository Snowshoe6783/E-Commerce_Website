<?php
session_start();
if (isset($_SESSION['utente_ID'])) {
  echo "Benvenuto " . $_SESSION['utente_ID'];
}
?>

<?php
include("../../../../Connessione_Database/connessione_database.php");
?>

<!DOCTYPE html>
<html>

<head>
  <link rel="icon" type="image/x-icon" href="../../Immagini/Icone/carrello.ico">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>carrello</title>
  <link href="style.css" rel="stylesheet" type="text/css" />

</head>
<a href="../Index/index.php">Home</a><br>
<a href="../Ordina/Indirizzo/indirizzo.php">Indirizzo</a><br>

<body>
  <h1>
    Carrello
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

  //echo $query;

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
  <form method="POST" action="upload.php?quadro_ID=<?=$quadro_ID?>" enctype="multipart/form-data">
    
    <br>ID quadro: <?=$quadro_ID?>
    <br>Nome Quadro: <input type = "text" name = "dati_prodotto_da_modificare[nome_quadro]" value = <?=$nome_quadro?>>
    <br>Nome Autore: <input type = "text" name = "dati_prodotto_da_modificare[nome_autore]" value = <?=$nome_autore?>>
    <br>Nazione di origine: <input type = "text" name = "dati_prodotto_da_modificare[nazione_di_origine]" value = <?=$nazione_di_origine?>>
    <br>Genere: <input type = "text" name = "dati_prodotto_da_modificare[genere]" value = <?=$genere?>>
    <br>Descrizione Breve<input type = "text" name = "dati_prodotto_da_modificare[descrizione_breve]" value = <?=$descrizione_breve?>>
    <br>Descrizione Dettagliata<input type = "text" name = "dati_prodotto_da_modificare[descrizione_dettagliata]" value = <?=$descrizione_dettagliata?>>
    <br>Prezzo<input type = "text" name = "dati_prodotto_da_modificare[prezzo]" value = <?=$prezzo?>>
    <br>Quantità<input type = "text" name = "dati_prodotto_da_modificare[quantita]" value = <?=$quantita?>>
    <br>Link Quadro<input type = "text" name = "dati_prodotto_da_modificare[link_quadro]" value = <?=$link_quadro?>>
    <div>
      <span>Upload a File:</span>
      <input type="file" name="uploadedFile" />
    </div>

    <input type="submit" name="submit_cambiamento" value="Upload" />

    

  </form>

  <form method = "POST" action = "cancella_prodotto.php?quadro_ID=<?=$quadro_ID?>">
    <input type="submit" name="cancella_prodotto" value="Cancella prodotto" />
  </form>



</body>

</html>
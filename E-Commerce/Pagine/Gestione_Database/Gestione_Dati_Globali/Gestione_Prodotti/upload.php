
<!-- 
  Sposta file nella cartella immagini.  
!-->
<?php
session_start();
include("../../../../Connessione_Database/connessione_database.php");

$message = ''; 
if (isset($_POST['submit_cambiamento']) && $_POST['submit_cambiamento'] == 'Upload')
{
  if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK)
  {
    // get details of the uploaded file
    $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
    $fileName = $_FILES['uploadedFile']['name'];
    $fileSize = $_FILES['uploadedFile']['size'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // sanitize file-name
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

    // check if file has one of the following extensions
    $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');

    if (in_array($fileExtension, $allowedfileExtensions))
    {
      // directory in which the uploaded file will be moved
      $uploadFileDir = '../../../../Immagini/Quadri/';
      $dest_path = $uploadFileDir . $newFileName;

      if(move_uploaded_file($fileTmpPath, $dest_path)) 
      {
        $message ='File is successfully uploaded.';
      }
      else 
      {
        $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
      }
    }
    else
    {
      $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
    }
  }
  else
  {
    $message = 'There is some error in the file upload. Please check the following error.<br>';
    $message .= 'Error:' . $_FILES['uploadedFile']['error'];
  }
}
$_SESSION['message'] = $message;


//sposta sta roba in un altro file
if(isset($_POST['dati_prodotto_da_aggiungere'])){
  echo $newFileName;
  inserimento_nuovo_prodotto($newFileName);
}else if (isset($_POST['dati_prodotto_da_modificare'])){
  modifica_prodotto($newFileName);
}



function inserimento_nuovo_prodotto($newFileName){
  include("../../../../Connessione_Database/connessione_database.php");
  echo "DENTRO";
  $query = "INSERT INTO quadro VALUES ('0', 
                                      '".$_POST['dati_prodotto_da_aggiungere']['nome_quadro']."',
                                      '".$_POST['dati_prodotto_da_aggiungere']['nome_autore']."',
                                      '".$_POST['dati_prodotto_da_aggiungere']['nazione_di_origine']."',
                                      '".$_POST['dati_prodotto_da_aggiungere']['genere']."',
                                      '".$_POST['dati_prodotto_da_aggiungere']['descrizione_breve']."',
                                      '".$_POST['dati_prodotto_da_aggiungere']['descrizione_dettagliata']."',
                                      '".$_POST['dati_prodotto_da_aggiungere']['prezzo']."',
                                      '".$_POST['dati_prodotto_da_aggiungere']['quantita_in_magazzino']."',
                                      '$newFileName');";
  echo $query;
  $result = $conn -> query($query);	  

  header("location: aggiungi_prodotti.php");
}


function modifica_prodotto($newFileName){
  include("../../../../Connessione_Database/connessione_database.php");
  echo "DENTRO";
  $query = "UPDATE quadro 
            SET nome_quadro = '".$_POST['dati_prodotto_da_modificare']['nome_quadro']."',
                nome_autore = '".$_POST['dati_prodotto_da_modificare']['nome_autore']."',
                nazione_di_origine = '".$_POST['dati_prodotto_da_modificare']['nazione_di_origine']."',
                genere = '".$_POST['dati_prodotto_da_modificare']['genere']."',
                descrizione_breve = '".$_POST['dati_prodotto_da_modificare']['descrizione_breve']."',
                descrizione_dettagliata = '".$_POST['dati_prodotto_da_modificare']['descrizione_dettagliata']."',
                prezzo = '".$_POST['dati_prodotto_da_modificare']['prezzo']."',
                quantita_in_magazzino = '".$_POST['dati_prodotto_da_modificare']['quantita']."',
                link_quadro = '$newFileName'
                WHERE quadro_ID = '".$_GET['quadro_ID']."';";

  
  
  echo $query;
  $result = $conn -> query($query);	  

  header("location: cancella_o_modifica.php");
}



?>


<!-- 
  Aggiungi prodotto nel database.
>

<?php
session_start(); 
include("../../../../Connessione_Database/connessione_database.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>PHP File Upload</title>
</head>
<body>
  <?php
  if(isset($_POST['cancella_prodotto'])){
    $query = "UPDATE quadro
              SET archiviato = '1'
              WHERE quadro_ID = '".$_GET['quadro_ID']."';";

    echo $query;
    $result = $conn->query($query);
  }
  ?>
  
</body>
</html>

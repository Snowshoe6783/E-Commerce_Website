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
<html>
    <head>
    <link rel="stylesheet" href="../assets/css/style_generale.css" type="text/css">
    </head>
<body class="body_menu_gestione">
    <a class="menu_gestione" href="index.php">Home</a><br>
    <a class="menu_gestione" href="gestione_prodotti.php">Gestione Prodotti</a>
    <a class="menu_gestione" href="gestione_ordini.php">Gestione Ordini</a><br>
</body>

</html>
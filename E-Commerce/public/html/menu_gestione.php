<?php
$link_cartella_immagini = "../assets/img/quadri/";
include("../../src/connessione_database.php");

session_start();
if (isset($_SESSION['utente_ID'])) {
    echo "Benvenuto " . $_SESSION['utente_ID'];
}
?>

<html>

<head>
    <link rel="stylesheet" href="../assets/css/menu_gestione.css" type="text/css">

    <link rel="stylesheet" href="../assets/css/style_generale.css" type="text/css">

</head>

<body class="body_menu_gestione">
    <a class="menu_gestione" href="index.php">Home</a><br>
    <a class="menu_gestione" href="gestione_dati_propri.php">Gestione Dati Propri</a>
    <?php
    if (isset($_SESSION['utente_ID']) && ($_SESSION['ruolo_ID'] == '1' || $_SESSION['ruolo_ID'] == '2')) {
        echo "<a class=\"menu_gestione\" href=\"menu_gestione_dati_globali.php\">Gestione Dati Globali</a><br>";
    }
    ?>

</body>

</html>
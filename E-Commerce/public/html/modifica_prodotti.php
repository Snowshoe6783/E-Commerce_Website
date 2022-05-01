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
	<link rel="icon" type="image/x-icon" href="../assets/ico/carrello.ico">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>carrello</title>
	<link rel="stylesheet" href="../assets/css/style_generale.css" type="text/css">

</head>
<a href="index.php">Home</a><br>

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
				WHERE archiviato = '0'";


	$result = $conn->query($query);

	echo "<table border = 1>";

	foreach ($result as $row) {
		echo "<tr>";
		foreach ($row as $key => $value) {
			echo "<th>$key</th>";
		}
		echo "<th>Cancella/Modifica</th>";
		echo "</tr>";
		break;
	}

	foreach ($result as $row) {
		echo "<tr>";
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

		echo "<td>$quadro_ID</td>";
		echo "<td>$nome_quadro</td>";
		echo "<td>$nome_autore</td>";
		echo "<td>$nazione_di_origine</td>";
		echo "<td>$genere</td>";
		echo "<td>$descrizione_breve</td>";
		echo "<td>$descrizione_dettagliata</td>";
		echo "<td>$prezzo</td>";
		echo "<td>$quantita</td>";
		echo "<td>$link_quadro</td>";
		echo "<td><a href = \"cancella_o_modifica_prodotto.php?quadro_ID=$quadro_ID\">Cancella/Modifica</td>";

		echo "</tr>";
	}
	echo "</table>";










	?>
</body>

</html>
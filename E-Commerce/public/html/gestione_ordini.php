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
	<link rel="icon" type="image/x-icon" href="../assets/ico/carrello.ico">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>Gestione Ordini</title>
	<link rel="stylesheet" href="../assets/css/style_generale.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/gestione_ordini.css" type="text/css">
</head>
<a href="index.php">Home</a><br>

<body>
	<h1>
		Gestione Ordini
	</h1>
	<?php
	$query = "SELECT o.ordine_ID AS 'ID Ordine', SUM(a.quantita*q.prezzo) AS 'Importo Totale'
				  FROM ordine AS o JOIN (quadro AS q JOIN acquisto AS a ON q.quadro_ID = a.quadro_ID) ON o.ordine_ID = a.ordine_ID
				  WHERE o.data_annullamento IS NULL
				  AND o.data_conferma IS NOT NULL
				  AND o.indirizzo_spedizione IS NOT NULL
				  AND o.metodo_spedizione_ID IS NOT NULL
				  GROUP BY o.ordine_ID";

	
	$result = $conn->query($query);

	$n_rows = $result->num_rows;


	echo "<table border = 1>";

	foreach ($result as $row) {
		echo "<tr>";
		foreach ($row as $key => $value) {
			echo "<th>$key</th>";
		}
		echo "<th>Dettagli Ordine</th>";
		echo "</tr>";
		break;
	}

	foreach ($result as $row) {

		echo "<tr>";
		$ordine_ID = $row['ID Ordine'];

		$importo_totale = $row['Importo Totale'];

		echo "<td>$ordine_ID</td>";

		echo "<td>" . $importo_totale . "</td>";
		echo "<td><a href = \"gestione_ordine_specifico.php?ordine_ID=$ordine_ID\">Visualizza Dettagli</a></td>";

		echo "</tr>";
	}
	echo "</table>";





	?>
</body>

</html>
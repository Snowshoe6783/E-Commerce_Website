<?php
include("../../src/connessione_database.php");

session_start();
if (isset($_SESSION['utente_ID'])) {
	echo "Benvenuto " . $_SESSION['utente_ID'];
}

$link_cartella_immagini = "../assets/img/quadri/";
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
<a href="indirizzo.php">Indirizzo</a><br>

<body>
	<h1>
		Lista ordini in corso
	</h1>
	<?php
	$query = "SELECT o.ordine_ID AS 'ID Ordine', SUM(a.quantita*q.prezzo) AS 'Importo Totale'
				  FROM ordine AS o JOIN (quadro AS q JOIN acquisto AS a ON q.quadro_ID = a.quadro_ID) ON o.ordine_ID = a.ordine_ID
				  WHERE utente_ID = '" . $_SESSION['utente_ID'] . "'
				    AND o.data_annullamento IS NULL
					AND o.data_conferma IS NOT NULL
				  GROUP BY o.ordine_ID";

	echo $query;
	$result = $conn->query($query);

	$n_rows = $result->num_rows;

	echo $n_rows;

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
		echo "<td><a href = \"ordine_specifico.php?ordine_ID=$ordine_ID\">Visualizza Dettagli</a></td>";

		echo "</tr>";
	}
	echo "</table>";


	?>
</body>

</html>
<?php
$link_cartella_immagini = "../assets/img/quadri/";
include("../../src/connessione_database.php");

session_start();
if (isset($_SESSION['utente_ID'])) {
	echo "Benvenuto " . $_SESSION['utente_ID'];
} else {
	http_response_code(403);
	die('Non hai accesso a questa pagina.');
}
?>
<?php
$_SESSION['prezzo_prodotti_totale'] = 0;
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
		Carrello
	</h1>
	<?php
	$query = "SELECT ordine_ID
				FROM ordine
				WHERE data_conferma IS NULL
				AND utente_ID = '" . $_SESSION['utente_ID'] . "';";

	echo $query;
	$result = $conn->query($query);

	$n_rows = $result->num_rows;


	if ($n_rows != 0) {
		foreach ($result as $row) { //togli il for each se possibile
			$ordine_ID = $row['ordine_ID'];
		}

		$_SESSION['ordine_ID'] = $ordine_ID;

		$query = "SELECT quadro_ID
					FROM acquisto
					WHERE ordine_ID = $ordine_ID;";


		$result = $conn->query($query);

		$n_rows = $result->num_rows;

		$flag = 0;

		echo "<table border = \"1\">";

	?>



	<?php

		foreach ($result as $row) {

			$quadro_ID = $row['quadro_ID'];
			if ($flag == 0) {
				$query = "SELECT nome_quadro AS 'Nome Quadro', nome_autore AS Autore, genere AS Genere, descrizione_breve AS Descrizione, prezzo as Prezzo, quantita AS Quantità, q.quantita_in_magazzino AS quantita_in_magazzino, a.quadro_ID AS quadro_ID
							 FROM quadro AS q JOIN acquisto AS a
							 ON q.quadro_ID = a.quadro_ID
							 WHERE q.quadro_ID = '$quadro_ID'
							  AND a.ordine_ID = '$ordine_ID'
							  AND q.quantita_in_magazzino >= a.quantita;";


				$flag = 1;
				//echo "<br><br>start".$query;

			} else {
				$query = "SELECT nome_quadro AS 'Nome Quadro', nome_autore AS Autore, genere AS Genere, descrizione_breve AS Descrizione, prezzo as Prezzo, quantita AS Quantità, q.quantita_in_magazzino AS quantita_in_magazzino, a.quadro_ID AS quadro_ID
						  FROM quadro AS q JOIN acquisto AS a
						  ON q.quadro_ID = a.quadro_ID
						  WHERE q.quadro_ID = '$quadro_ID'
							AND a.ordine_ID = '$ordine_ID'
							AND q.quantita_in_magazzino >= a.quantita
						  UNION
						  $query";

				//echo "<br><br>big".$query;

				//non so perchè funziona sta roba

			}
		}


		$prezzo_totale = 0;
		$result = $conn->query($query);
		$result_quadri_in_carrello = $result;

		foreach ($result as $row) {
			echo "<tr>";
			foreach ($row as $key => $value) {
				if (($key != "quantita_in_magazzino") && ($key != "quadro_ID")) {
					echo "<th>$key</th>";
				}
			}
			echo "<th>Prezzo Totale</th>";
			echo "<th>Cancella Prodotto</th>";
			echo "</tr>";
			break;
		}
		echo "<form method=\"post\" name=\"inizia_ordine\">";
		foreach ($result as $row) {
			echo "<tr>";
			$quadro_ID = $row['quadro_ID'];
			$nome_quadro = $row['Nome Quadro'];
			$nome_autore = $row['Autore'];
			$genere = $row['Genere'];
			$descrizione_breve = $row['Descrizione'];
			$prezzo = $row['Prezzo'];
			$quantita = $row['Quantità'];
			$quantita_in_magazzino = $row['quantita_in_magazzino'];

			echo "<td>$nome_quadro</td>";
			echo "<td>$nome_autore</td>";
			echo "<td>$genere</td>";
			echo "<td>$descrizione_breve</td>";
			echo "<td>$prezzo</td>";
			echo "<td>
				<select name = \"$quadro_ID\" id = \"quantita\">";


			for ($i = 1; $i < $quantita_in_magazzino; $i++) {
				if ($i == $quantita) {
					echo "<option value = " . $quantita . " selected>" . $quantita . "</option>";
				} else {
					echo "<option value = " . $i . ">" . $i . "</option>";
				}
			}
			echo "<td>" . $prezzo * $quantita . "</td>";
			echo "<td><a href = \"../../src/cancella_prodotto_dal_carrello.php?quadro_ID=$quadro_ID&ordine_ID=$ordine_ID\">Cancella Prodotto</a>";

			echo "</tr>";

			$prezzo_totale += $prezzo * $quantita;
		}
		echo "</table>";


		echo "prezzo totale = " . $prezzo_totale;
	} else {
		echo "Carrello vuoto.";
	}


	?>
	<input type="submit" name="submit_inizio_ordine" value="Procedi con l'ordine">
	</form>

	<?php
	if (isset($_POST['submit_inizio_ordine'])) {
		foreach ($result_quadri_in_carrello as $row) {
			$quadro_ID = $row['quadro_ID'];
			$query = "UPDATE acquisto
					      SET quantita = '" . $_POST[$quadro_ID] . "'
						  WHERE quadro_ID = '$quadro_ID'
						  AND ordine_ID = '" . $_SESSION['ordine_ID'] . "'";;

			$result = $conn->query($query);
			//echo $query . "<br>";
		}
		//header("location:carrello.php");
		echo ("<script>location.href = 'indirizzo.php';</script>");
	}
	?>
</body>

</html>
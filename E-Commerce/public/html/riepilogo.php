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
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>replit</title>
	<link rel="stylesheet" href="../assets/css/style_generale.css" type="text/css">
</head>
<a href="index.php">Home</a><br>

<body>
	<h1>
		RIEPILOGO
	</h1>
	<?php
	$query = "SELECT ordine_ID
				FROM ordine AS o
				WHERE data_conferma IS NULL
				AND utente_ID = '" . $_SESSION['utente_ID'] . "';";


	$result = $conn->query($query);


	$n_rows = $result->num_rows;
	$num_rows_ordine_ID = $n_rows;


	if ($n_rows != 0) {
		foreach ($result as $row) { //togli il for each se possibile
			$ordine_ID = $row['ordine_ID'];
		}

		$query = "SELECT quadro_ID
					FROM acquisto
					WHERE ordine_ID = $ordine_ID;";


		$result = $conn->query($query);


		$n_rows = $result->num_rows;

		$flag = 0;

		echo "<table border = \"1\">";

		$result->fetch_all(MYSQLI_ASSOC);
		foreach ($result as $row) {


			$quadro_ID = $row['quadro_ID'];
			if ($flag == 0) {
				$query = "SELECT nome_quadro AS 'Nome Quadro', nome_autore AS Autore, genere AS Genere, descrizione_breve AS Descrizione, prezzo as Prezzo, quantita AS Quantità
							 FROM quadro AS q JOIN acquisto AS a
							 ON q.quadro_ID = a.quadro_ID
							 WHERE q.quadro_ID = '$quadro_ID'
							   AND a.ordine_ID = '$ordine_ID'
							   AND q.quantita_in_magazzino >= a.quantita;";

				$flag = 1;
				//echo "<br><br>start".$query;

			} else {
				$query = "SELECT nome_quadro AS 'Nome Quadro', nome_autore AS Autore, genere AS Genere, descrizione_breve AS Descrizione, prezzo as Prezzo, quantita AS Quantità
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

		foreach ($result as $row) {
			echo "<tr>";
			foreach ($row as $key => $value) {
				echo "<th>$key</th>";
			}
			echo "<th>Prezzo Totale</th>";
			echo "</tr>";
			break;
		}

		foreach ($result as $row) {
			echo "<tr>";
			$nome_quadro = $row['Nome Quadro'];
			$nome_autore = $row['Autore'];
			$genere = $row['Genere'];
			$descrizione_breve = $row['Descrizione'];
			$prezzo = $row['Prezzo'];
			$quantita = $row['Quantità'];

			echo "<td>$nome_quadro</td>";
			echo "<td>$nome_autore</td>";
			echo "<td>$genere</td>";
			echo "<td>$descrizione_breve</td>";
			echo "<td>$prezzo</td>";
			echo "<td>$quantita</td>";
			echo "<td>" . $prezzo * $quantita . "</td>";

			echo "</tr>";

			$prezzo_totale += $prezzo * $quantita;
		}
		echo "</table>";


		
		echo "prezzo prodotti = " . $prezzo_totale;
		
		echo "<br>prezzo spedizione = " . $_SESSION['prezzo_prodotti_totale'];

		echo "<br>prezzo totale = " . $prezzo_totale + $_SESSION['prezzo_prodotti_totale'];


		
	} else {
		echo "Carrello vuoto.";
	}


	?>
	<br>
	<br>
	<div>
		<?php


		echo "Indirizzo: " . $_SESSION['indirizzo_inserito'] . "";
		?>
	</div>



	<div>
		<?php


		$query = "SELECT nome
							FROM metodo_spedizione
							WHERE metodo_ID = '" . $_SESSION['ID_metodo_spedizione'] . "';";



		$result = $conn->query($query);

		$n_rows = $result->num_rows;

		if ($n_rows != 0) {
			foreach ($result as $row) {
				$nome_metodo_spedizione = $row['nome'];
			}
		}



		echo "Metodo di Spedizione: $nome_metodo_spedizione";
		?>
	</div>



	<div>
		<?php


		$query = "SELECT nome
							FROM metodo_pagamento
							WHERE metodo_ID = '" . $_SESSION['ID_metodo_pagamento'] . "';";



		$result = $conn->query($query);

		$n_rows = $result->num_rows;

		if ($n_rows != 0) {
			foreach ($result as $row) {
				$nome_metodo_pagamento = $row['nome'];
			}
		}



		echo "Metodo di Pagamento: $nome_metodo_pagamento";
		?>
	</div>


	<form id="form_conferma_ordine" action="" method="post">
		<div>
			<input type="submit" name="conferma_ordine" value="Conferma Ordine">
		</div>
	</form>

	<?php
	if (isset($_POST['conferma_ordine'])) {

		$query = "SELECT q.quadro_ID AS quadroID, quantita
						FROM acquisto AS a LEFT JOIN quadro AS q
						ON a.quadro_ID = q.quadro_ID
						WHERE a.ordine_ID = '" . $_SESSION['ordine_ID'] . "'
						  AND a.quantita <= q.quantita_in_magazzino";

		$result = $conn->query($query);
		$n_rows = $result->num_rows;

		if ($n_rows > 0 && $num_rows_ordine_ID > 0) {

			foreach ($result as $row) {
				$quadroID = $row['quadroID'];
				$quantita = $row['quantita'];
				$query = "UPDATE quadro
								SET quantita_in_magazzino = quantita_in_magazzino - $quantita
								WHERE quadro_ID = $quadroID";
				$result = $conn->query($query);
				echo $query;
			}


			$query = "UPDATE ordine
							SET metodo_spedizione_ID = '" . $_SESSION['ID_metodo_pagamento'] . "', 
							metodo_pagamento_ID  = '" . $_SESSION['ID_metodo_spedizione'] . "',
							indirizzo_spedizione = '" . $_SESSION['indirizzo_inserito'] . "'
							WHERE ordine_ID = '" . $_SESSION['ordine_ID'] . "';";

			echo $query;
			$result = $conn->query($query);


			$date = date('Y-m-d H:i:s');
			echo $date;


			$query = "UPDATE ordine
							SET data_conferma = '$date', data_pagamento = '$date'
							WHERE ordine_ID = '" . $_SESSION['ordine_ID'] . "';";

			echo "<br><br>" . $query;
			$result = $conn->query($query);


			header("location:riepilogo.php");
		} else {
			echo "carrello vuoto";
		}
	}
	?>

</body>

</html>
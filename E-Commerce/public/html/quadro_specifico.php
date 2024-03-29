<?php
include("../../src/connessione_database.php");

session_start();
if (isset($_SESSION['utente_ID'])) {
	$utente_ID = $_SESSION['utente_ID'];
	echo "Utente: " . $_SESSION['username'];
} else {
	$utente_ID = NULL;
}

$link_cartella_immagini = "../assets/img/quadri/";
?>
<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>quadro</title>
	<link rel="icon" type="image/x-icon" href="../assets/ico/carrello.ico">
	<link rel="stylesheet" href="../assets/css/quadro.css" type="text/css">
	<link rel="stylesheet" href="../assets/css/style_generale.css" type="text/css">
	<script type="text/javascript" src="../assets/js/quadro.js"></script>
</head>

<body class="body_quadro">
	<a href="index.php">Home</a><br>
	<?php
	$quantita_nel_carrello = 0;
	$query = "SELECT * 
				FROM quadro 
				WHERE quadro_ID = '" . $_GET['quadro_ID'] . "';";

	$result = $conn->query($query);

	foreach ($result as $row) {
		$quadro_ID = $row['quadro_ID'];
		$link_quadro = $row['link_quadro'];
		$nome_quadro = $row['nome_quadro'];
		$prezzo = $row['prezzo'];
		$nome_autore = $row['nome_autore'];
		$descrizione_breve = $row['descrizione_breve'];
		$descrizione_dettagliata = $row['descrizione_dettagliata'];
		$quantita_in_magazzino = $row['quantita_in_magazzino'];
		$genere = $row['genere'];
		$nazione_di_origine = $row['nazione_di_origine'];

		if (isset($_SESSION['utente_ID'])) {
			$query = "SELECT ordine_ID 
					FROM ordine AS o
					WHERE utente_ID = '" . $_SESSION['utente_ID'] . "' 
					AND data_conferma IS NULL;";


			$result = $conn->query($query);


			$n_rows = $result->num_rows;

			if ($n_rows != 0) {
				foreach ($result as $row) { //togli il for each se possibile
					$ordine_ID = $row['ordine_ID'];
				}

				$query = "SELECT quantita
					FROM acquisto AS a
					WHERE a.quadro_ID = '" . $_GET['quadro_ID'] . "'
					AND a.ordine_ID = $ordine_ID;";

				$result = $conn->query($query);

				foreach ($result as $row) { //togli il for each se possibile
					$quantita_nel_carrello = $row['quantita'];
				}
			}
		}

		//$result = $conn -> query($query);


	?>



		<div class="container">
			<div class="singolo_quadro">
				<img src="<?= $link_cartella_immagini . $link_quadro ?>" alt="<?= $nome_quadro ?>" class="singolo_quadro">
			</div>

			<div class="dettagli_quadro">
				<span class="Titolo_singolo_Quadro"><?= $nome_quadro ?></span><br>
				<div class="div_autore_quadro">
					<span style="color:grey">Di</span>
					<span class="Autore_singolo_Quadro">
						<?= $nome_autore ?>
					</span>
				</div>

				<div class="grid_info_extra">
					<label class="titolo_categoria">Genere:</label>
					<?= $genere ?>

					<label class="titolo_categoria">Nazione di Origine:</label>
					<?= $nazione_di_origine ?>

					<label class="titolo_categoria">Descrizione breve:</label>
					<?= $descrizione_breve ?>


				</div>
				<div class="grid_prezzo_quantita">
					<div class="elemento_grid_prezzo_quantita">
						<span class="Testo_singolo_Quadro">Prezzo: </span>
						€ <?= $prezzo ?>
					</div>

					<div class="elemento_grid_prezzo_quantita">
						<span class="Testo_singolo_Quadro">Nel magazzino:</span>
						<?= $quantita_in_magazzino ?>

					</div>

					<div class="elemento_grid_prezzo_quantita">
						<span class="Testo_singolo_Quadro">Nel carrello:</span>
						<?= $quantita_nel_carrello ?>
					</div>
					</div>
					<div id="form_aggiungi_quadro_al_carrello">

					</div>
				
			</div>
			<div class="des_quadro">
				<span style="color:grey;font-style:italic">Descrizione Dettagliata</span><br>
				<span class="Descrizione_singolo_Quadro"><?= $descrizione_dettagliata ?></span>
				<form method="post" name="myform" class="form_quadro">



				</form>

			</div>
		</div>
	<?php
	}
	?>


	<script>
		var quantitaAcquistabile = <?php echo (json_encode($quantita_in_magazzino - $quantita_nel_carrello)); ?>;

		const form_da_creare = document.getElementById('form_aggiungi_quadro_al_carrello');
		if (<?php echo (json_encode($utente_ID)); ?>) {
			if (quantitaAcquistabile > 0) {
				form_da_creare.innerHTML =
					`
							<form method = "post" name = "myform" class="aggiungiOtogli">
							<div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
							<input type="number" id="number" class = "quantita_inserita" name = "quantita_inserita" value="1" min = "1" max= '` + quantitaAcquistabile + `'/>
							<div class="value-button" id="increase" onclick="increaseValue(` + quantitaAcquistabile + `)" value="Increase Value">+</div>
							
							<input type = "submit" name = "aggiungi_al_carrello" class="aggiungi_quadro" value = "Aggiungi al carrello">
							</form>
							`;

			} else {
				form_da_creare.innerHTML =
					`
											Il prodotto non è più disponibile, o hai inserito troppi quadri nel carrello.
											`;
			}
		} else {

			form_da_creare.innerHTML =
				`
										Non sei loggato.
										`;
		}
	</script>



	<?php
	if (isset($_POST['aggiungi_al_carrello'])) {
		if ($_POST['quantita_inserita'] > ($quantita_in_magazzino - $quantita_nel_carrello)) {
			echo "Quantita troppo alta";
		} else if (isset($_SESSION['utente_ID'])) {
			$query = "SELECT ordine_ID
						FROM ordine AS o
						WHERE utente_ID = '" . $_SESSION['utente_ID'] . "' 
						AND data_conferma IS NULL;";


			$result = $conn->query($query);


			foreach ($result as $row) { //togli il for each se possibile
				$ordine_ID = $row['ordine_ID'];
			}


			$n_rows = $result->num_rows;

			if ($n_rows == 0) {
				echo "Nessun ordine trovato oppure l'ordine e' gia' stato confermato, quindi creo nuovo ordine";

				$query = "SHOW TABLE STATUS LIKE 'ordine'"; //trovo l'ID del prossimo ordine
				$result = $conn->query($query);
				foreach ($result as $row) { //togli il for each se possibile
					$auto_increment_value_ordine_ID = $row['Auto_increment'];
				}

				$date = date('Y-m-d H:i:s');
				echo $date;

				$query = "INSERT INTO ordine VALUES('0', '" . $_SESSION['utente_ID'] . "', NULL, NULL, NULL, '$date', NULL, NULL, NULL, NULL);";

				$result = $conn->query($query);




				$query = "INSERT INTO acquisto VALUES('0', '$auto_increment_value_ordine_ID', '" . $_GET['quadro_ID'] . "', " . $_POST['quantita_inserita'] . ");";

				$result = $conn->query($query);
			} else {
				echo "Ordine Trovato, aggiungo un altro quadro.";
				$query = "SELECT quadro_ID 
						FROM acquisto
						WHERE quadro_ID = '" . $_GET['quadro_ID'] . "'
						AND ordine_ID = '$ordine_ID';";


				$result = $conn->query($query);


				$n_rows = $result->num_rows;

				if ($n_rows == 0) {
					echo "Ordine trovato, ma il quadro non è nel carrello quindi lo aggiungo";
					$query = "INSERT INTO acquisto VALUES('0', $ordine_ID, '" . $_GET['quadro_ID'] . "', " . $_POST['quantita_inserita'] . ");";

					$result = $conn->query($query);
				} else {
					echo "Ordine con lo stesso quadro trovato, aumento quantita di 1";
					$query = "UPDATE acquisto SET quantita = quantita + " . $_POST['quantita_inserita'] . " WHERE ordine_ID = $ordine_ID AND quadro_ID = '" . $_GET['quadro_ID'] . "';";

					$result = $conn->query($query);
				}
			}
		} else {
			echo "Devi essere loggato per poter aggiungere un prodotto al carrello.";
		}


		$quadro_id2 = $_GET['quadro_ID'];
		echo ("<script>location.href = 'quadro_specifico.php?quadro_ID=$quadro_id2';</script>");
	}
	?>




	<script>
		//serve per cancellare il form dopo che e' stato inserito nel DB
		if (window.history.replaceState) {
			window.history.replaceState(null, null, window.location.href);
		}
	</script>

</body>

</html>
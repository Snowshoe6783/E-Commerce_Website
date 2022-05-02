<?php
$link_cartella_immagini = "../assets/img/quadri/";
include("../../src/connessione_database.php");

session_start();
if (isset($_SESSION['utente_ID'])) {
	echo "Utente " . $_SESSION['utente_ID'];
} else {
	http_response_code(403);
	die('Non hai accesso a questa pagina.');
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>replit</title>
	<link rel="stylesheet" href="../assets/css/style_generale.css" type="text/css">
	<link rel="stylesheet" href="../assets/css/carrello.css" type="text/css">
	<link rel="stylesheet" href="../assets/css/riepilogo.css" type="text/css">
</head>
<a href="index.php">Home</a><br>

<body>
	<h1>
		RIEPILOGO
	</h1>
	<br>
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
				$query = "SELECT link_quadro AS 'Immagine Prodotto', nome_quadro AS 'Nome Quadro', nome_autore AS Autore, genere AS Genere, descrizione_breve AS Descrizione, prezzo as Prezzo, quantita AS Quantità
							 FROM quadro AS q JOIN acquisto AS a
							 ON q.quadro_ID = a.quadro_ID
							 WHERE q.quadro_ID = '$quadro_ID'
							   AND a.ordine_ID = '$ordine_ID'
							   AND q.quantita_in_magazzino >= a.quantita;";

				$flag = 1;
				//echo "<br><br>start".$query;

			} else {
				$query = "SELECT link_quadro AS 'Immagine Prodotto', nome_quadro AS 'Nome Quadro', nome_autore AS Autore, genere AS Genere, descrizione_breve AS Descrizione, prezzo as Prezzo, quantita AS Quantità
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
	?>

		<div class="shopping-cart">

			<div class="column-labels">
				<label class="product-image">Image</label>
				<label class="product-details">Product</label>
				<label class="product-price">Price</label>
				<label class="product-quantity">Quantity</label>
				<label class="product-removal">&nbsp</label>
				<label class="product-line-price">Total</label>
			</div>

			<form method="post" name="inizia_ordine">
				<?php





				foreach ($result as $row) {

					$link_quadro = $link_cartella_immagini . $row['Immagine Prodotto'];
					$nome_quadro = $row['Nome Quadro'];
					$nome_autore = $row['Autore'];
					$genere = $row['Genere'];
					$descrizione_breve = $row['Descrizione'];
					$prezzo = $row['Prezzo'];
					$quantita = $row['Quantità'];
				?>

					<div class="product">

						<div class="product-image">
							<img src="<?= $link_quadro ?>">
						</div>
						<div class="product-details">
							<div class="product-title"><?= $nome_quadro ?> - <?= $nome_autore ?></div>
							<p class="product-description"><?= $descrizione_breve ?></p>
						</div>
						<div class="product-price"><?= $prezzo ?></div>

						<div class="product-quantity">
							<?= $quantita ?>
						</div>

						<div class="product-line-price">
							<?= $prezzo * $quantita ?>
						</div>
					</div>
			<?php
					$prezzo_totale += $prezzo * $quantita;
				}
			} else {
				echo "Carrello vuoto.";
			}



			?>
			<br>
			<br>
			<div>
				<?php
				//echo "Indirizzo: " . $_SESSION['indirizzo_inserito'] . "";
				?>
			</div>



			<div>
				<?php


				$query = "SELECT nome, costo
							FROM metodo_spedizione
							WHERE metodo_ID = '" . $_SESSION['ID_metodo_spedizione'] . "';";



				$result = $conn->query($query);

				$n_rows = $result->num_rows;

				if ($n_rows != 0) {
					foreach ($result as $row) {
						$nome_metodo_spedizione = $row['nome'];
						$costo_metodo_spedizione = $row['costo'];
					}
				}



				//echo "Metodo di Spedizione: $nome_metodo_spedizione";
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



				//echo "Metodo di Pagamento: $nome_metodo_pagamento";
				?>


			</div>

			


			<div class="grid_info_ordine">


				<div class="grid_info_extra">
					<label class="nome_categoria">Indirizzo di Spedizione: </label>
					<span class="dati_categoria"><?= $_SESSION['indirizzo_inserito'] ?></span>

					<label class="nome_categoria">Metodo di Spedizione: </label>
					<span class="dati_categoria"><?= $nome_metodo_spedizione ?></span>

					<label class="nome_categoria">Metodo di Pagamento: </label>
					<span class="dati_categoria"><?= $nome_metodo_pagamento ?></span>

				</div>
				<div class="grid_prezzi">
					<label class="nome_categoria">Prezzo Prodotti: </label>
					<span class="dati_categoria"><?= $prezzo_totale ?></span>

					<label class="nome_categoria">Prezzo Spedizione: </label>
					<span class="dati_categoria"><?= $costo_metodo_spedizione ?></span>

					<label class="nome_categoria">Prezzo Totale: </label>
					<span class="dati_categoria"><?= $prezzo_totale + $costo_metodo_spedizione ?></span>
				</div>
			</div>
			<br><input class="checkout" type="submit" name="conferma_ordine" value="Conferma l'ordine">		


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
					}


					$query = "UPDATE ordine
							SET metodo_spedizione_ID = '" . $_SESSION['ID_metodo_pagamento'] . "', 
							metodo_pagamento_ID  = '" . $_SESSION['ID_metodo_spedizione'] . "',
							indirizzo_spedizione = '" . $_SESSION['indirizzo_inserito'] . "'
							WHERE ordine_ID = '" . $_SESSION['ordine_ID'] . "';";


					$result = $conn->query($query);
					echo $query;


					$date = date('Y-m-d H:i:s');
					echo $date;


					$query = "UPDATE ordine
							SET data_conferma = '$date', data_pagamento = '$date'
							WHERE ordine_ID = '" . $_SESSION['ordine_ID'] . "';";

					echo "<br><br>" . $query;
					$result = $conn->query($query);


					header("location:index.php");
				} else {
					echo "carrello vuoto";
				}
			}

			?>

</body>

</html>
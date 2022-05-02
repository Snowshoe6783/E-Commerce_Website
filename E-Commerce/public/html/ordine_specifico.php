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
	<link rel="icon" type="image/x-icon" href="../assets/ico/carrello.ico">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>carrello</title>
	<link rel="stylesheet" href="../assets/css/style_generale.css" type="text/css">
	<link rel="stylesheet" href="../assets/css/carrello.css" type="text/css">
	<link rel="stylesheet" href="../assets/css/ordine_specifico.css" type="text/css">

</head>
<a href="index.php">Home</a><br>

<body>
	<h1>
		Ordine Numero: <?= $_GET['ordine_ID'] ?>
	</h1>
	<br>
	<?php
	$ordine_ID = $_GET['ordine_ID'];


	$query = "";
	$flag = 0;
	if ($flag == 0) {
		$query = "SELECT  q.quadro_ID AS 'Quadro ID', q.link_quadro AS 'Immagine Prodotto', nome_quadro AS 'Nome Quadro', nome_autore AS Autore, genere AS Genere, descrizione_breve AS Descrizione, prezzo as Prezzo, quantita AS Quantità
							FROM (quadro AS q JOIN acquisto AS a  ON q.quadro_ID = a.quadro_ID) JOIN ordine AS o ON a.ordine_ID = o.ordine_ID
							WHERE a.ordine_ID = $ordine_ID
							;";

		$flag = 1;
		//echo "<br><br>start".$query;

	} else {
		$query = "SELECT  q.quadro_ID AS 'Quadro ID', q.link_quadro AS 'Immagine Prodotto', nome_quadro AS 'Nome Quadro', nome_autore AS Autore, genere AS Genere, descrizione_breve AS Descrizione, prezzo as Prezzo, quantita AS Quantità
							FROM (quadro AS q JOIN acquisto AS a  ON q.quadro_ID = a.quadro_ID) JOIN ordine AS o ON a.ordine_ID = o.ordine_ID
							WHERE a.ordine_ID = $ordine_ID
							  UNION
							  $query";
	}



	$prezzo_totale = 0;

	$result = $conn->query($query);

	$result_dettagli_quadri_ordinati = $result;

	$counter = 0;
	?>
	<div class="shopping-cart">

		<div class="column-labels">
			<label class="product-image">Image</label>
			<label class="product-details">Product</label>
			<label class="product-price">Price</label>
			<label class="product-quantity">Quantity</label>
			<label class="product-removal">Remove</label>
			<label class="product-line-price">Total</label>
		</div>



		<?php

		foreach ($result as $row) {
			echo "<tr>";
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
			/*echo "<td><img src = \"$link_quadro\">";
		echo "<td>$nome_quadro</td>";
		echo "<td>$nome_autore</td>";
		echo "<td>$genere</td>";
		echo "<td>$descrizione_breve</td>";
		echo "<td>$prezzo</td>";
		echo "<td>$quantita</td>";
		echo "<td>" . $prezzo * $quantita . "</td>";

		echo "</tr>";*/

			$prezzo_totale += $prezzo * $quantita;
		}





		$query = "SELECT ms.nome AS nome_metodo_spedizione, ms.metodo_ID AS ms_metodo_ID, mp.nome AS nome_metodo_pagamento, o.indirizzo_spedizione AS indirizzo_spedizione, data_inserimento_ordine, data_conferma, data_pagamento, data_spedizione, data_annullamento
					  FROM ordine AS o JOIN metodo_pagamento AS mp ON o.metodo_pagamento_ID = mp.metodo_ID JOIN metodo_spedizione AS ms ON o.metodo_spedizione_ID = ms.metodo_ID
					  WHERE o.ordine_ID = $ordine_ID";



		$result = $conn->query($query);



		foreach ($result as $row) {
			$nome_metodo_spedizione = $row['nome_metodo_spedizione'];
			$nome_metodo_pagamento = $row['nome_metodo_pagamento'];
			$indirizzo_spedizione = $row['indirizzo_spedizione'];
			$data_inserimento_ordine = $row['data_inserimento_ordine'];
			$data_conferma = $row['data_conferma'];
			$data_pagamento = $row['data_pagamento'];
			$data_spedizione = $row['data_spedizione'];
			$data_annullamento = $row['data_annullamento'];
			$ms_metodo_ID = $row['ms_metodo_ID'];
		}
		echo "<br>";
		$query = "SELECT costo
			  FROM metodo_spedizione
			  WHERE metodo_ID = $ms_metodo_ID";
		$result = $conn->query($query);

		foreach ($result as $row) {
			$costo_spedizione = $row['costo'];
		}


		?>

		<div class="grid_info_ordine">

			
			<div class  = "grid_info_extra">
				<label class="nome_categoria">Indirizzo di Spedizione: </label>
				<span class="dati_categoria"><?= $indirizzo_spedizione ?></span>

				<label class="nome_categoria">Metodo di Spedizione: </label>
				<span class="dati_categoria"><?= $nome_metodo_spedizione ?></span>

				<label class="nome_categoria">Metodo di Pagamento: </label>
				<span class="dati_categoria"><?= $nome_metodo_pagamento ?></span>

				<label class="nome_categoria">Data inserimento ordine: </label>
				<span class="dati_categoria"><?= $data_inserimento_ordine ?></span>

				<label class="nome_categoria">Data conferma ordine: </label>
				<span class="dati_categoria"><?= $data_conferma ?></span>

				<label class="nome_categoria">Data pagamento ordine: </label>
				<span class="dati_categoria"><?= $data_pagamento ?></span>

				<label class="nome_categoria">Data spedizione ordine: </label>
				<span class="dati_categoria"><?= $data_spedizione ?></span>

				<label class="nome_categoria">Data annullamento ordine: </label>
				<span class="dati_categoria"><?= $data_annullamento ?></span>
			</div>
			<div class = "grid_info_extra">
				<label class="nome_categoria">Prezzo Prodotti: </label>
				<span class="dati_categoria"><?= $prezzo_totale ?></span>

				<label class="nome_categoria">Prezzo Spedizione: </label>
				<span class="dati_categoria"><?= $costo_spedizione ?></span>

				<label class="nome_categoria">Prezzo Totale: </label>
				<span class="dati_categoria"><?= $prezzo_totale + $costo_spedizione ?></span>
			</div>
		</div>



		<?php
		if (!$data_spedizione && !$data_annullamento) {
			echo "<form method='POST' name='annulla_ordine'>

			<input type='submit' onclick=\"return confirm('Are you sure?')\" name='submit_annulla_ordine' value = 'Annulla'/>

		</form>	";
		}

		?>


		<?php
		$counter = 0;
		if (isset($_POST['submit_annulla_ordine'])) {
			foreach ($result_dettagli_quadri_ordinati as $row) {
				$counter++;
				$quadro_ID = $row['Quadro ID'];
				$quantita_ordinata = $row['Quantità'];

				$query = "UPDATE quadro
							  SET quantita_in_magazzino = quantita_in_magazzino + $quantita_ordinata
							  WHERE quadro_ID = $quadro_ID;";

				echo "<br>Query aggiungi quadro: " . $query . " aggiungo" . $quantita_ordinata . " quadri";
				$result = $conn->query($query);
			}

			$date = date('Y-m-d H:i:s');




			$query = "UPDATE ordine
				  SET data_annullamento = '$date'
				  WHERE ordine_ID = $ordine_ID;";


			$result = $conn->query($query);



			header("location:ordine_specifico.php?ordine_ID=$ordine_ID", true, 303);
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
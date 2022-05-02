<?php
include("../../src/connessione_database.php");

session_start();
if (isset($_SESSION['utente_ID'])) {
	echo "Utente " . $_SESSION['utente_ID'];
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
	<link rel="stylesheet" href="../assets/css/carrello.css" type="text/css">


</head>
<a href="index.php">Home</a><br>

<body>
	<h1>
		Carrello
	</h1>
	<?php
	$ordine_ID = $_GET['ordine_ID'];

	echo "<table border = \"1\">";
	$query = "";
	$flag = 0;
	if ($flag == 0) {
		$query = "SELECT q.link_quadro AS 'Immagine Prodotto', q.quadro_ID AS 'Quadro ID', nome_quadro AS 'Nome Quadro', nome_autore AS Autore, genere AS Genere, descrizione_breve AS Descrizione, prezzo as Prezzo, quantita AS Quantità
							FROM (quadro AS q JOIN acquisto AS a  ON q.quadro_ID = a.quadro_ID) JOIN ordine AS o ON a.ordine_ID = o.ordine_ID
							WHERE a.ordine_ID = $ordine_ID
							;";

		$flag = 1;
		//echo "<br><br>start".$query;

	} else {
		$query = "SELECT q.link_quadro AS 'Immagine Prodotto', q.quadro_ID AS 'Quadro ID', nome_quadro AS 'Nome Quadro', nome_autore AS Autore, genere AS Genere, descrizione_breve AS Descrizione, prezzo as Prezzo, quantita AS Quantità
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
						<?=$quantita?>
					</div>

					<div class="product-line-price">
						<?= $prezzo * $quantita ?>
					</div>
				</div>


<?php
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

	echo "prezzo prodotti = " . $prezzo_totale . "<br>";

	echo "prezzo spedizione = " . $costo_spedizione . "<br>";

	echo "prezzo totale = " . $prezzo_totale + $costo_spedizione . "<br>";


	echo "Indirizzo di Spedizione: " . $indirizzo_spedizione . "<br>";
	echo "Metodo di Spedizione: " . $nome_metodo_spedizione . "<br>";
	echo "Metodo di Pagamento: " . $nome_metodo_pagamento . "<br>";

	echo "Data inserimento ordine: " . $data_inserimento_ordine . "<br>";
	echo "Data conferma ordine: " . $data_conferma . "<br>";
	echo "Data pagamento ordine: " . $data_pagamento . "<br>";

	echo "Data spedizione ordine: " . $data_spedizione . "<br>";
	echo "Data annullamento ordine: " . $data_annullamento . "<br>";

	?>
	<?php 
	if($data_spedizione == NULL){
		echo "<form method=\"POST\" name=\"annulla_ordine\">
				<input type=\"submit\" name=\"submit_data_spedizione\" value=\"Spedisci\">
			</form>";
	}
	?>

	
	<?php
	if (isset($_POST['submit_data_spedizione'])) {

		$date = date('Y-m-d H:i:s');

		$query = "UPDATE ordine
				  SET data_spedizione = '$date'
				  WHERE ordine_ID = $ordine_ID;";

		echo "<br>Query aggiungi data_spedizione: " . $query;

		$result = $conn->query($query);



		header("Refresh:2; url = gestione_ordini.php", true, 303);
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
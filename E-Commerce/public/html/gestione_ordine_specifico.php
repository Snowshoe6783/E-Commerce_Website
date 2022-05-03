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
	<title>Gestione Ordine Specifico</title>
	<link rel="stylesheet" href="../assets/css/style_generale.css" type="text/css">
	<link rel="stylesheet" href="../assets/css/carrello.css" type="text/css">
	<link rel="stylesheet" href="../assets/css/ordine_specifico.css" type="text/css">


</head>
<a href="index.php">Home</a><br>

<body>
	<h1>
		Gestione Ordine Specifico
	</h1>
	<br>
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
		<label class="product-removal">&nbsp</label>
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

		$prezzo_totale+=$prezzo*$quantita;
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
<div class = "grid_prezzi">
	<label class="nome_categoria">Prezzo Prodotti: </label>
	<span class="dati_categoria"><?= $prezzo_totale ?></span>

	<label class="nome_categoria">Prezzo Spedizione: </label>
	<span class="dati_categoria"><?= $costo_spedizione ?></span>

	<label class="nome_categoria">Prezzo Totale: </label>
	<span class="dati_categoria"><?= $prezzo_totale + $costo_spedizione ?></span>
</div>
</div>


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



		
		header("location:gestione_ordine_specifico.php?ordine_ID=$ordine_ID");
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
<?php
$link_cartella_immagini = "../assets/img/quadri/";
include("../../src/connessione_database.php");

session_start();
if (isset($_SESSION['utente_ID'])) {
	echo "Utente: " . $_SESSION['username'];
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
	<title>Carrello</title>
	<link rel="stylesheet" href="../assets/css/style_generale.css" type="text/css">
	<link rel="stylesheet" href="../assets/css/carrello.css" type="text/css">

</head>
<a href="index.php">Home</a><br>


<body>
	<h1>
		Carrello
	</h1>
	<br>
	<?php
	$query = "SELECT ordine_ID
				FROM ordine
				WHERE data_conferma IS NULL
				AND utente_ID = '" . $_SESSION['utente_ID'] . "';";

	$result = $conn->query($query);

	$n_rows = $result->num_rows;
	echo $n_rows;


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
		if ($n_rows != 0) {
			$flag = 0;



	?>
			<?php

			foreach ($result as $row) {

				$quadro_ID = $row['quadro_ID'];
				if ($flag == 0) {
					$query = "SELECT link_quadro AS 'Immagine Prodotto', nome_quadro AS 'Nome Quadro', nome_autore AS Autore, genere AS Genere, descrizione_breve AS Descrizione, prezzo as Prezzo, quantita AS Quantità, q.quantita_in_magazzino AS quantita_in_magazzino, a.quadro_ID AS quadro_ID
								FROM quadro AS q JOIN acquisto AS a
								ON q.quadro_ID = a.quadro_ID
								WHERE q.quadro_ID = '$quadro_ID'
								AND a.ordine_ID = '$ordine_ID'
								AND q.quantita_in_magazzino >= a.quantita;";


					$flag = 1;
					//echo "<br><br>start".$query;

				} else {
					$query = "SELECT link_quadro AS 'Immagine Prodotto', nome_quadro AS 'Nome Quadro', nome_autore AS Autore, genere AS Genere, descrizione_breve AS Descrizione, prezzo as Prezzo, quantita AS Quantità, q.quantita_in_magazzino AS quantita_in_magazzino, a.quadro_ID AS quadro_ID
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

				<form method="post" name="inizia_ordine">
					<?php





					foreach ($result as $row) {

						$link_quadro = $link_cartella_immagini . $row['Immagine Prodotto'];
						$quadro_ID = $row['quadro_ID'];
						$nome_quadro = $row['Nome Quadro'];
						$nome_autore = $row['Autore'];
						$genere = $row['Genere'];
						$descrizione_breve = $row['Descrizione'];
						$prezzo = $row['Prezzo'];
						$quantita = $row['Quantità'];
						$quantita_in_magazzino = $row['quantita_in_magazzino'];
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

							<div class="product-quantity"><select name="<?= $quadro_ID ?>" id="quantita">
									<?php

									for ($i = 1; $i <= $quantita_in_magazzino; $i++) {
										if ($i == $quantita) {
											echo "<option value = " . $quantita . " selected>" . $quantita . "</option>";
										} else {
											echo "<option value = " . $i . ">" . $i . "</option>";
										}
									}
									?>
								</select>
							</div>

							<div class="product-removal">
								<input type="button" onclick="location.href='../../src/cancella_prodotto_dal_carrello.php?quadro_ID=<?= $quadro_ID ?>&ordine_ID=<?= $ordine_ID ?>'" value="Cancella" />

							</div>
							<div class="product-line-price">
								<?= $prezzo * $quantita ?>
							</div>
						</div>

					<?php
						$prezzo_totale += $prezzo * $quantita;
					}
					?>
					<div class="totals">
						<div class="totals-item totals-item-total">
							<label>Prezzo Totale</label>
							<div class="totals-value" id="cart-total"><?= $prezzo_totale ?></div>
						</div>
					</div>

					<br><input class="checkout" type="submit" name="submit_inizio_ordine" value="Procedi con l'ordine">

			<?php

		} else {
			echo "Carrello vuoto.";
		}
	} else {
		echo "Carrello vuoto.";
	}


			?>




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
						echo $query . "<br>";
					}
					//header("location:carrello.php");
					echo ("<script>location.href = 'indirizzo.php';</script>");
				}
				?>
</body>

</html>
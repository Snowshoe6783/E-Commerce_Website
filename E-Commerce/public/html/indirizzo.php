<?php
$link_cartella_immagini = "../assets/img/quadri/";
include("../../src/connessione_database.php");

session_start();
if (isset($_SESSION['utente_ID'])) {
	echo "Benvenuto " . $_SESSION['utente_ID'];
  }else{
	  http_response_code(403);
	  die('Non hai accesso a questa pagina.');
  }
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="../assets/css/indirizzo.css" type="text/css">
	<link rel="stylesheet" href="../assets/css/style_generale.css" type="text/css">
</head>
<a href="index.php">Home</a><br>
<a href="indirizzo.php">indirizzo</a><br>

<body>
	<h1>
		Indirizzo
	</h1>

	<div>
		<script src="../assets/js/indirizzo.js"></script>
		<form class="form_indirizzo" action="" method="post" autocomplete="off">
			<p class="title">Seleziona indirizzo</p>
			<p class="note"><em>* = required field</em></p>
			<label class="full-field">
				<!-- Avoid the word "address" in id, name, or label text to avoid browser autofill from conflicting with Place Autocomplete. Star or comment bug https://crbug.com/587466 to request Chromium to honor autocomplete="off" attribute. -->
				<span class="form-label">Spedisci a*</span>
				<input id="ship-address" name="ship-address" required autocomplete="off" />
			</label><br>
			<label class="full-field">
				<span class="form-label">Numero civico*<span>
						<input id="address2" name="address2" required />
			</label><br>
			<label class="full-field">
				<span class="form-label">Città*</span>
				<input id="locality" name="locality" required />
			</label><br>
			<label class="slim-field-left">
				<span class="form-label">Provincia*</span>
				<input id="provincia" name="provincia" required />
			</label><br>
			<label class="slim-field-left">
				<span class="form-label">Comune*</span>
				<input id="comune" name="comune" required />
			</label><br>
			<label class="slim-field-left" for="postal_code">
				<span class="form-label">CAP*</span>
				<input id="postcode" name="postcode" required />
			</label><br>
			<label class="full-field">
				<span class="form-label">Paese*</span>
				<input id="country" name="country" required />
			</label><br>
			<input type="submit" class="my-button" value="Salva Indirizzo" name="submit"></input>

			<!-- Reset button provided for development testing convenience.
		  Not recommended for user-facing forms due to risk of mis-click when aiming for Submit button. -->
			<input type="reset" value="Clear form" />
		</form>

		<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpVkA-8fcFRz6hjwdHDxAR5kgTaxvAhJg&callback=initAutocomplete&libraries=places&v=weekly" async></script>

		<?php
		if (isset($_POST['submit'])) {
			$stringa_indirizzo = $_POST['country'] .
				", " .
				$_POST['provincia'] .
				", " .
				$_POST['comune'] .
				", " .
				$_POST['locality'] .
				", " .
				$_POST['postcode'] .
				", " .
				$_POST['ship-address'] .
				" " .
				$_POST['address2'];

			$_SESSION['indirizzo_inserito'] = $stringa_indirizzo;

			echo $_SESSION['indirizzo_inserito'];

			header("location:spedizione.php");
		}
		?>
	</div>




</body>

</html>
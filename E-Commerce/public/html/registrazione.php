<?php
include("../../src/connessione_database.php");

session_start();
if (isset($_SESSION['utente_ID'])) {
	echo "Utente: " . $_SESSION['username'];
}

$link_cartella_immagini = "../assets/img/quadri/";
?>
<html>

<head>
	<meta charset="utf-8">
	<link rel="icon" type="image/x-icon" href="../assets/ico/registrazione.ico">
	<meta name="viewport" content="width=device-width">
	<title>Registrazione</title>
	<link rel="stylesheet" href="../assets/css/style_generale.css" type="text/css">
	<link rel="stylesheet" href="../assets/css/registrazione.css" type="text/css">
</head>
<a href="index.php">Home</a><br>

<body class="bodyRegistrazione">
	<form method="post" name="form_registrazione">
		<h1 class="titolo_reg">Registrazione</h1>
		<div class="div_registrazione">
			<a class="titolo_registrazione">Dati anagrafici</a><br>
			Nome <input class="input_registrazione" type="text" name="nome" required><br>
			Cognome <input class="input_registrazione" type="text" name="cognome" required><br>
			Codice Fiscale <input class="input_registrazione" type="text" name="codice_fiscale" required><br>
			E-mail <input class="input_registrazione" type="e-mail" name="email" required><br>
			Indirizzo <input class="input_registrazione" type="text" name="indirizzo" required><br>
			Numero di telefono <input class="input_registrazione" type="text" name="numero_telefono" required>
		</div>
		<div class="div_registrazione">
			<a class="titolo_registrazione">Dati utente</a> <br>
			Username <input class="input_registrazione" type="text" name="username" required><br>

			Password<input class="input_registrazione" type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,64}" title="Must contain at least one number and one uppercase and lowercase letter, and between 8 and 64 characters" required><br>
			Conferma Password<input class="input_registrazione" type="password" id="password" name="password_conferma" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,64}" title="Must contain at least one number and one uppercase and lowercase letter, and between 8 and 64 characters" required><br>

			<div id="message">
				<h3>La password deve contenere:</h3>
				<p id="letter" class="invalid">• Una lettera <b>minuscola</b> </p>
				<p id="capital" class="invalid">• Una lettera <b>maiuscola</b> </p>
				<p id="number" class="invalid">• Un <b>numero</b></p>
				<p id="length" class="invalid">• Minimo <b>8 caratteri</b></p>
			</div>

			<input type="submit" class="button_registrazione" name="submit" value="Registrati">


		</div>


	</form>





	<?php

	if (isset(
		$_POST['submit'],
		$_POST['nome'],
		$_POST['cognome'],
		$_POST['codice_fiscale'],
		$_POST['email'],
		$_POST['indirizzo'],
		$_POST['numero_telefono'],
		$_POST['username'],
		$_POST['password'],
		$_POST['password_conferma']
	)) {
		if ($_POST['password'] == $_POST['password_conferma']) {
			$password = $_POST['password'];
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);



			$query = "INSERT INTO dati_utente VALUES( '0', '"
				. $_POST['nome'] . "', '"
				. $_POST['cognome'] . "', 
				'3', '"
				. $_POST['codice_fiscale'] . "', '"
				. $_POST['email'] . "', '"
				. $_POST['indirizzo'] . "', '"
				. $_POST['numero_telefono'] . "', '"
				. $_POST['username'] . "', '"
				. $hashed_password . "');";


			$result = $conn->query($query);
			



			echo 'Utente registrato. Ti porto alla pagina di login...';
			header("Refresh:3; url = login.php", true, 303);
		}else{
			echo "Le password che hai inserito sono diverse. Riprova.";
		}
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
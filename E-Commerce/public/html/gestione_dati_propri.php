<?php
$link_cartella_immagini = "../assets/img/quadri/";
include("../../src/connessione_database.php");

session_start();
if (isset($_SESSION['utente_ID'])) {
	echo "Utente " . $_SESSION['utente_ID'];
  }else{
	  http_response_code(403);
	  die('Non hai accesso a questa pagina.');
  }
?>

<html>

<head>
	<meta charset="utf-8">
	<link rel="icon" type="image/x-icon" href="../assets/ico/registrazione.ico">
	<meta name="viewport" content="width=device-width">
	<title>Gestione Dati Propri</title>
	<link rel="stylesheet" href="../assets/css/style_generale.css" type="text/css">
	<link rel="stylesheet" href="../assets/css/gestione_dati_propri.css" type="text/css">

</head>
<a href="index.php">Home</a><br>

<body>
	<h1>
		Gestione Dati Propri
	</h1>
	<form method="post" name="myform">
		<div class="wrapper">
			<div class="dati">
				<div id="dati_anagrafici">
				Dati anagrafici
					<br>
					<label for="nome_field">Nome <input class="input_registrazione" type="text" name="nome" required><br>
					<label for="nome_field">Cognome <input class="input_registrazione" type="text" name="cognome" required><br>
					<label for="nome_field">E-mail <input class="input_registrazione" type="text" name="email" required><br>
					<label for="nome_field">Indirizzo <input class="input_registrazione" type="text" name="indirizzo" required><br>
					<label for="nome_field">Numero di telefono <input class="input_registrazione" type="text" name="numero_telefono" required>
				</div>
				<div id="dati_utente_registrazione">
					dati utente
					<br>
					Username <input class="input_registrazione" type="text" name="username"><br>
					Password<input class="input_registrazione" type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,64}" title="Must contain at least one number and one uppercase and lowercase letter, and between 8 and 64 characters" required>
					<div id="message">
						<h3>Password must contain the following:</h3>
						<p id="letter" class="invalid">A <b>lowercase</b> letter</p>
						<p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
						<p id="number" class="invalid">A <b>number</b></p>
						<p id="length" class="invalid">Minimum <b>8 characters</b></p>
					</div>
				</div>
				<input type="submit" class="button_registrazione" name="submit" value="Registrati">
		</div>
</div>
		<br>
		<br>
		<br>
		<br>
		<a href="Login.php">Login</a><br>
		<a href="Registrazione.php">Registrazione</a><br>
		<a href="Cancella.php">Cancella</a><br>
		<a href="ModificaDati.php">Modifica Dati </a>
	</form>





	<?php

	if (
		isset($_POST['submit'])
		&& isset($_POST['nome'])
		&& isset($_POST['cognome'])
		&& isset($_POST['email'])
		&& isset($_POST['indirizzo'])
		&& isset($_POST['numero_telefono'])
		&& isset($_POST['username'])
		&& isset($_POST['password'])
	) {
		echo "DENTRO";




		$password = $_POST['password'];
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);



		$query = "UPDATE dati_utente SET
                            nome = '" . $_POST['nome'] . "',
                            cognome = '" . $_POST['cognome'] . "',
                            email = '" . $_POST['email'] . "',
                            indirizzo = '" . $_POST['indirizzo'] . "',
                            numero_telefono = '" . $_POST['numero_telefono'] . "',
                            username = '" . $_POST['username'] . "',
                            password = '$hashed_password'
                        WHERE utente_id = '" . $_SESSION['utente_ID'] . "';";

		

		$result = $conn->query($query);
		$conn->close();



		echo 'Cambiato dati utente';
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
<?php
$link_cartella_immagini = "../assets/img/quadri/";
include("../../src/connessione_database.php");

session_start();
if (isset($_SESSION['utente_ID'])) {
?>
	Benvenuto <?= $_SESSION['utente_ID'] ?>
<?php
}
?>

<html>

<head>
	<meta charset="utf-8">
	<link rel="icon" type="image/x-icon" href="../assets/ico/registrazione.ico">
	<meta name="viewport" content="width=device-width">
	<title>registrazione</title>
	<link rel="stylesheet" href="../assets/css/style_generale.css" type="text/css">
</head>
<a href="index.php">Home</a><br>

<body>
	<h1>
		Pagina di registrazione
	</h1>
	<form method="post" name="myform">
		<div class="wrapper">
			<div id="dati_anagrafici">
				Dati anagrafici
				<br>
				<label for="nome_field">Nome <input class="input_registrazione" type="text" name="nome" required><br>
					<label for="nome_field">Cognome <input class="input_registrazione" type="text" name="cognome" required><br>
						<label for="nome_field">E-mail <input class="input_registrazione" type="text" name="email" required><br>
							<label for="nome_field">Indirizzo <input class="input_registrazione" type="text" name="indirizzo" required><br>
								<label for="nome_field">Numero di telefono <input class="input_registrazione" type="text" name="numero_telefono" required>



									<br>
									<br>
									<br>
			</div>
			<div id="dati_utente_registrazione">
				dati utente
				<br>
				Username <input class="input_registrazione" type="text" name="username"><br>
				Password <input class="input_registrazione" type="password" name="password"><br><br>
			</div>
		</div>
		<br>
		<input type="submit" name="submit" value="Registrati">

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

		echo $query;

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
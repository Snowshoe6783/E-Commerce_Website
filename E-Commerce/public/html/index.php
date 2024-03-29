<?php
include("../../src/connessione_database.php");

session_start();
$link_cartella_immagini = "../assets/img/quadri/";
?>

<!DOCTYPE html>
<html>
<!----- https://preview.colorlib.com/#abcbook sito esempio
		https://www.templatemonsterpreview.com/demo/225791.html?_gl=1*t00fw4*_ga*MzgyNDE1MjcyLjE2NDg1NDI4NDE.*_ga_FTPYEGT5LY*MTY0ODU0Mjg0MS4xLjEuMTY0ODU0Mjg3MC4zMQ..&_ga=2.95366932.984041851.1648542841-382415272.1648542841
  ----->

<head>
	<link rel="icon" type="image/x-icon" href="../assets/ico/carrello.ico">
	<meta charset="utf-8">
	
	<link rel="stylesheet" href="../assets/css/index.css" type="text/css">
	<link rel="stylesheet" href="../assets/css/style_generale.css" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" /> <!-- se restringi la pagina salta fuori le tre linee per il menu -->
	<link rel="stylesheet" href="../assets/css/footer.css" type="text/css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
</head>

<body class="bodyIndex">
	<nav class="navIndex">
		<div class="logo">Baiart.com</div>
		<input type="checkbox" id="click">
		<label for="click" class="menu-btn">
			<i class="fas fa-bars"></i>
		</label>
		<ul>
			<li><a class="active" href="#">Home</a></li>

			<li><a href="galleria.php">Galleria</a></li>
			<?php
			if (!isset($_SESSION['username'])) {
				echo "<li><a href=\"registrazione.php\">Registrazione</a></li>";
				echo "<li><a href=\"login.php\">Login</a></li>";
			} else {
				echo "<li><a href=\"lista_ordini.php\">Ordini</a></li>";
				echo "<li><a href=\"carrello.php\">Carrello</a></li>";

				echo "<li><a href=\"menu_gestione.php\">Gestione</a></li>";

				echo "<li><a href=\"logout.php\">Logout</a></li>";

				
			}
			?>

			<script type="text/javascript">
				window.onload = function() {

					var a = document.getElementById("logout");
					a.onclick = function() {
						sessionStorage.clear();
						return false;
					}
				}
			</script>

		</ul>
	</nav>



	<div id="quadro_centro">
		<p id="demo"></p>
		<?php
			$query = "SELECT link_quadro, quadro_ID, nome_quadro
					  FROM quadro
					  WHERE archiviato = '0'
					  ORDER BY RAND()
					  LIMIT 1;";
		
		$result = $conn->query($query);

		foreach ($result as $row) {
			$link_quadro = $link_cartella_immagini . $row['link_quadro'];			
			$quadro_ID = $row['quadro_ID'];
			$nome_quadro = $row['nome_quadro'];
		}
		
		?>
		<a href = "quadro_specifico.php?quadro_ID=<?=$quadro_ID?>">
			<img id="quadro_centrato" src="<?=$link_quadro?>"></img>
		</a>
		<br><em><?=$nome_quadro?></em>

	</div>
	<div id="Quadri_Cercati">
		<?php
		$query = "SELECT * FROM quadro WHERE archiviato = 0";

		$result = $conn->query($query);

		foreach ($result as $row) {
			$quadro_ID = $row['quadro_ID'];
			$link_quadro = $row['link_quadro'];
			$nome_quadro = $row['nome_quadro'];
			$prezzo = $row['prezzo'];
			$nome_autore = $row['nome_autore'];


			echo
			"<div id=\"card\">  
				<a href = \"quadro_specifico.php?quadro_ID=$quadro_ID\">
					<img id=\"quadro_card\" src=" . $link_cartella_immagini . $link_quadro . " alt = " . $nome_quadro . ">
				</a>
				<br>
					<p class = \"Titolo_card\">$nome_quadro</p>
					<p class = \"Autore_card\">$nome_autore</p>
					<p class = \"Prezzo_card\">$prezzo €</p>
			</div>";
		}

		?>
		<script src="script.js"></script>
	</div>
		<br>
		<footer class="footer">
			<div class = "div_footer">
				<p class = "footer_title">La nostra azienda:</p>
				<p><a href = "about_us.php">About Us</a></p>		
				<p><a href = "privacy_policy.php">Privacy Policy</a></p>		
				
			</div>
			<div class = "div_footer">
				<p class = "footer_title">Contatti:</p>
				<p>Email: mail@mail.com</p>
				<p>Numero di Telefono:<br> +39 359 493 3245</p>
			</div>
		</footer> 
</body>

</html>
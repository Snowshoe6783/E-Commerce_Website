<!DOCTYPE html>
<html>
  <head>
    <title>indirizzo</title>
	<link rel="icon" type="image/x-icon" href="../../Immagini/Icone/indirizzo.ico">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:400,500"
      rel="stylesheet"
    />

    <link rel="stylesheet" type="text/css" href="../../CSS/style.css" />
    <script src="./index.js"></script>
  </head>
  <body>
    <!-- Note: The address components in this sample are based on North American address format. You might need to adjust them for the locations relevant to your app. For more information, see
https://developers.google.com/maps/documentation/javascript/examples/places-autocomplete-addressform
    -->
	<div>
		<form class="form_indirizzo" id="address-form" action="" method="get" autocomplete="off">
		  <p class="title">Seleziona indirizzo</p>
		  <p class="note"><em>* = required field</em></p>
		  <label class="full-field">
			<!-- Avoid the word "address" in id, name, or label text to avoid browser autofill from conflicting with Place Autocomplete. Star or comment bug https://crbug.com/587466 to request Chromium to honor autocomplete="off" attribute. -->
			<span class="form-label">Spedisci a*</span>
			<input
			  id="ship-address"
			  name="ship-address"
			  required
			  autocomplete="off"
			/>
		  </label>
		  <label class="full-field">
			<span class="form-label">Numero civico*<span>
			<input id="address2" name="address2" required/>
		  </label>
		  <label class="full-field">
			<span class="form-label">Città*</span>
			<input id="locality" name="locality" required />
		  </label>
		  <label class="slim-field-left">
			<span class="form-label">Provincia*</span>
			<input id="provincia" name="provincia" required />
		  </label>
		  <label class="slim-field-left">
			<span class="form-label">Comune*</span>
			<input id="comune" name="comune" required />
		  </label>
		  <label class="slim-field-left" for="postal_code">
			<span class="form-label">CAP*</span>
			<input id="postcode" name="postcode" required />
		  </label>
		  <label class="full-field">
			<span class="form-label">Paese*</span>
			<input id="country" name="country" required />
		  </label>
		  <input type="submit" class="my-button" value = "Salva Indirizzo"></input>

		  <!-- Reset button provided for development testing convenience.
	  Not recommended for user-facing forms due to risk of mis-click when aiming for Submit button. -->
		  <input type="reset" value="Clear form" />
		</form>

		<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
		<script
		  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpVkA-8fcFRz6hjwdHDxAR5kgTaxvAhJg&callback=initAutocomplete&libraries=places&v=weekly"
		  async
		></script>
		
		<?php
			
		?>
	</div>
  </body>
</html>
<?php
session_start();
?>
<html>
<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<link href="css/style.css" rel="stylesheet">
<link href="css/custom.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>
$( document ).ready(function() {
	var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
	if(!is_chrome){
		$('#oldbrowser').show();
		$('#formbuttons').hide();
	}
});
</script>
<title>Overhoor mij!</title>
</head>
<body id="home">
<div id="oldbrowser" style="display: none; color: black; text-align: center;" class="alert alert-warning"><strong>Oeps!</strong> Overhoor Mij! werkt alleen met Google Chrome! <a style="color: black;" href="https://www.google.com/intl/nl/chrome/browser/">Chrome downloaden</a></div>
<div class="jumbotron">
  <h1>Overhoor mij!</h1>
  <p>Heeft niemand tijd om je woordjes te overhoren? Overhoor ze op dezelfde manier met overhoor mij!</p>
  <?php
	$email = $_SESSION["email"];
	$wachtwoord = $_SESSION["wachtwoord"];
	if(empty($email) | ($wachtwoord)){
  ?>
  <div id="formbuttons">
  <p><button type="button" class="btn btn-primary btn-lg" onclick="$('#loginform').show();$(this).hide();"><span style="font-size: 2em;" class="icon-wrts"></span> <span style="position: relative; top: -0.5em;">Inloggen met WRTS</span></button></p>
    <form action="login.php" method="post" id="loginform" style="display: none;">
  <fieldset id="homeset">
  <input type="text" name="email" class="form-control" placeholder="WRTS Email">
  <input type="password" name="wachtwoord" class="form-control" placeholder="WRTS Wachtwoord">
  </fieldset>
  <input type="submit" id="submitbtn" class="btn-primary btn-block" value="Inloggen"><br>
  </form>
  <small>Na het inloggen kun je meteen van start!</small>
  </div>
  <?php
  }else{
  ?>
  <div id="formbuttons">
  <p><a type="button" class="btn btn-success btn-lg" href="lijsten.php">Lijsten</a><a type="button" class="btn btn-primary btn-lg" href="logout.php">Uitloggen</a></p>
  </div>
  <?php
  }
  ?>
</div>
<div id="info">
	<h1>Meer informatie:</h1>
	<div class="container-fluid">
		<div class="row">
		  <div class="col-md-4">
		  <h3><span class="icon-microphone"></span> Hoe het werkt:</h3>
		  De website gebruikt <strong>spraak</strong> om woordjes te vragen en <strong>luistert</strong> vervolgens of je antwoord goed is! Net als in het echt!
		  </div>
		  
		  <div class="col-md-4">
		  <h3><span class="icon-puzzle-piece"></span> Overhoor mogelijkheden:</h3>
			<p><strong>Woordjes oefenen</strong>, de website blijft ze herhalen tot alles goed is!</p>
			<p><strong>Snelle overhoring</strong>, alle woordjes worden 1x gevraagd</p>
			<p><strong>Binnenkort meer!</strong></p>
		  </div>
		  
		  <div class="col-md-4">
		  <h3><span class="icon-info"></span> Over ons:</h3>
			<p>Overhoor mij! is een project van <a href="https://github.com/tkon99" target="_blank">tkon99</a></p>
			<p>&copy; <?php echo(date("Y")); ?> - Thomas Konings</p>
		  </div>
		</div>
	</div>
</div>
</body>
</html>
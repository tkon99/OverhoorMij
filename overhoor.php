<?php
session_start();
$email = $_SESSION["email"];
$wachtwoord = $_SESSION["wachtwoord"];
$id = $_GET["list"];
if(empty($email) | ($wachtwoord)){
	header('Location: index.php');
}else if(empty($id)){
	echo('Er is geen lijst opgegeven! <a href="lijsten.php">Probeer het opnieuw!</a>');
	exit();
}
$url = "http://www.wrts.nl/api/lists/";
$url .= $id;
$process = curl_init($url);
curl_setopt($process, CURLOPT_HTTPHEADER, array('Content-Type: application/xml', $additionalHeaders));
//curl_setopt($process, CURLOPT_HEADER, 1);
curl_setopt($process, CURLOPT_USERPWD, $email . ":" . $wachtwoord);
curl_setopt($process, CURLOPT_TIMEOUT, 30);
curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($process, CURLOPT_USERAGENT, 'Overhoor Mij! Woorden overhoren met spraak');
$return = curl_exec($process);
curl_close($process);
$xml = simplexml_load_string($return);
$json = json_encode($xml);
$array = json_decode($json,TRUE);
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
<title>Overhoor mij! - Overhoren</title>
<meta charset="UTF-8">
</head>
<body id="lijsten">
<div class="progress">
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
    <span class="sr-only">50% Complete</span>
  </div>
</div>
 <a href="logout.php" title="Uitloggen" id="logout"><span class="icon-sign-out"><span></a>
 <a href="lijsten.php" id="back" title="Terug" id="back"><span class="icon-chevron-left"><span></a>
<?php
echo('<h1>'.$array["title"].'</h1>');
echo('<b>'.$array["lang-a"].' - '.$array["lang-b"].'</b><br>');
foreach($array["words"] as $list){
	foreach($list as $word){
		echo($word["word-a"].' - '.$word["word-b"]);
		echo "<br>";
	}
}
?>
<br>
<a type="button" class="btn btn-success btn-lg" href="test.php?list=<?php echo $id; ?>"><span style="font-size: 2em;" class="icon-speech"></span> <span style="position: relative; top: -0.5em;">Start met overhoren</span></a>
<script>
$(document).ready(function(){
$(function() {
    $( document ).tooltip({
		track: true
	});
  });

});
</script>
</body>
</html>
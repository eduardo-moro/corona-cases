<?php
$json = 'https://pomber.github.io/covid19/timeseries.json';
$obj = json_decode(file_get_contents($json));
$totalAfetados = 0;
$char = "!";
?>

<head>
  <link rel="stylesheet" href="style.css">
</head>

<header>
  <h1 id ='title'>covid-19 no mundo</h1>

<?php
function dateHandler($date){
  return implode("/",array_reverse(explode("-",$date)));
}
?>

<h2 class="text">Fonte: <a href='<?= $json ?>'><?= $json ?></a></h2><br>

<?php
echo "</p></div></header><div class='container'>";
foreach ($obj as $key => $value) {
    $today = $value[sizeof($value)-1];
    $yesterday = $value[sizeof($value)-2];
    if($char != $key[0]){
        $char = $key[0];
        echo "<br><h2 class = 'index text' id=".$char.">";
        echo $char;
        echo "</h2><br><br>";
    }
    echo "<div class='box tile'><p class='text'>";
    echo $key;
    echo "<br><br> data: ";
    echo (dateHandler($today->date));
    echo "<br> confirmados: ";
    echo($today->confirmed);
    echo "<br> mortos: ";
    echo($today->deaths);
    echo "<br> recuperados: ";
    echo($today->recovered);
    echo "<br> novos casos: ";
    echo($today->confirmed - $yesterday->confirmed);
    echo "<br> novas mortes: ";
    echo($today->deaths - $yesterday->deaths);
    echo "<br> novas recuperações: ";
    echo($today->recovered - $yesterday->recovered);
    echo "<br><br></p></div>";
    $totalAfetados += ($value[sizeof($value)-1]->recovered + $value[sizeof($value)-1]->deaths + $value[sizeof($value)-1]->confirmed);
}

echo "</div><br><p class='text' id='total' >o total de pessoas afetadas pelo covid-19 até ".dateHandler($value[sizeof($value)-1]->date)." é de ".$totalAfetados."</p>";

?>

<a class="backTop" href="#title">voltar ao inicio</a>


<footer>
    <h3 class="footerInfo">Criado por Eduardo Moro.</h3>
</footer>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script language="JavaScript" type="text/javascript" src="script.js"></script>

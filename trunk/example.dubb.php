<?php
//@example
include_once 'DUBB.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	DUBB::registerTags(array('b' , 'i' , 'h1' , 'url' => 2 , 'color' => 1));
	$dubb = new DUBB($_POST['text']);
	echo $dubb->render();
} else {
?>
<form method="post">
<textarea cols="65" rows="20" name="text">
blalbla [hallo jij].{b} daar.{b , i} in [deze.{b} gekke.{h1} 
wereld].{i, color('#f00')} met [de mooie].{url('http://www.google.com' , 'Google zoekmachine') , b} bomen
</textarea>
<div><input type="submit" value="Render it!" /></div>
</form>
<?php
}
?>
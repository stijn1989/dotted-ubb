<?php
//@example
include_once 'DUBB.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $t = microtime(true);
	DUBB::registerTags(array('b' , 'i' , 'url' => 2 , 'color' => 1 , 'list' => array(1 , 2) , 'size' => 1));
	$dubb = new DUBB($_POST['text']);
	echo $dubb->render();
    echo '<hr>';
    echo 'DUBB parse time: ' . round((microtime(true) - $t) , 3) . ' seconds';
} else {
?>
<form method="post" action="">
<textarea cols="65" rows="20" name="text">
blalbla [hallo jij].{b} daar.{b , i} in [deze.{b} gekke.{size(1)} 
wereld].{i, color(#f00)} met [de mooie].{url(http://www.google.com , Google zoekmachine) , b} bomen
[list item 1 | list item 2 | list item 3].{list(ul)}
</textarea>
<div><input type="submit" value="Render it!" /></div>
</form>
<?php
}
?>
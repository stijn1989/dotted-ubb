<?php
include_once 'Tag.php';

/**
 * Deze tag maakt een H1 kop van de tekst
 *
 * @author	Stijn Leenknegt	<stijnleenknegt@gmail.com>
 * @version	1.0
 * @package DUBB
 */
class DUBB_Tag_H1 implements DUBB_Tag
{

	
	public function render($string)
	{
		return '<h1>' . $string . '</h1>';
	}
	

}

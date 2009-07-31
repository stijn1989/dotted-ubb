<?php
include_once 'Tag.php';

/**
 * Make the text bold.
 *
 * @author	Stijn Leenknegt	<stijnleenknegt@gmail.com>
 * @version	1.0
 * @package DUBB
 */
class DUBB_Tag_B implements DUBB_Tag
{

	
	public function render($string)
	{
		return '<strong>' . $string . '</strong>';
	}
	

}

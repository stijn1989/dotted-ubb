<?php
include_once 'Tag.php';

/**
 * Make the text italic.
 *
 * @author	Stijn Leenknegt	<stijnleenknegt@gmail.com>
 * @version	1.0
 * @package DUBB
 */
class DUBB_Tag_I implements DUBB_Tag
{

	
	public function render($string)
	{
		return '<em>' . $string . '</em>';
	}
	

}

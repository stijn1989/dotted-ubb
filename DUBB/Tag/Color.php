<?php
include_once 'Tag' . DIRECTORY_SEPARATOR . 'Function.php';

/**
 * Deze tag kleurt een woord of woorden.
 *
 * @DUBB_Param 	$color
 *
 * @author	Stijn Leenknegt	<stijnleenknegt@gmail.com>
 * @version	1.0
 * @package DUBB
 */
class DUBB_Tag_Color extends DUBB_Tag_Function
{
	
	
	public function render($string)
	{
		return '<span style="color: ' . $this->_params[0] . ';">' . $string . '</span>';
	}


}

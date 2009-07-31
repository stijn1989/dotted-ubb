<?php
include_once 'Tag' . DIRECTORY_SEPARATOR . 'Function.php';

/**
 * Color the text. You can use hex, rgb(...) or colornames
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

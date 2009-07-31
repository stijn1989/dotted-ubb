<?php
include_once 'Tag' . DIRECTORY_SEPARATOR . 'Function.php';

/**
 * Create a link.
 *
 * @DUBB_Param 	$href
 * @DUBB_Param 	$title
 *
 * @author	Stijn Leenknegt	<stijnleenknegt@gmail.com>
 * @version	1.0
 * @package DUBB
 */
class DUBB_Tag_Url extends DUBB_Tag_Function
{
	
	
	public function render($string)
	{
		return '<a href="' . $this->_params[0] . '" title="' . $this->_params[1] . '">' . $string . '</a>';
	}
	

}

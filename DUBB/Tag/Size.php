<?php
include_once 'Tag' . DIRECTORY_SEPARATOR . 'Function.php';

/**
 * Make text large or small.
 *
 * @DUBB_Param 	$size
 *
 * @author	Stijn Leenknegt	<stijnleenknegt@gmail.com>
 * @version	1.0
 * @package DUBB
 */
class DUBB_Tag_Size extends DUBB_Tag_Function
{
	
	
	public function render($string)
	{
        switch($this->_params[0])
        {
            case 1: return '<h1>' . $string . '</h1>';
            case 2: return '<h2>' . $string . '</h2>';
            case 3: return '<h3>' . $string . '</h3>';
            case 4: return '<h4>' . $string . '</h4>';
            case 5: return '<h5>' . $string . '</h5>';
            case 6: return '<h6>' . $string . '</h6>';
        }
	}


}

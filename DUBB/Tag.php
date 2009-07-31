<?php
/**
 * The DUBB_Tag interface to create styletags.
 * 
 * @author	Stijn Leenknegt	<stijnleenknegt@gmail.com>
 * @version	1.0
 * @package DUBB
 */
interface DUBB_Tag
{

	/**
	 * Render de DUBB tag.
	 *
	 * @param 	string 	$string
	 * @return 	string
	 */
	public function render($string);

}

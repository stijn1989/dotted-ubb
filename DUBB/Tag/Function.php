<?php
include_once 'Tag.php';

/**
 * De klasse voor DUBB stijlfuncties.
 *
 * @author	Stijn Leenknegt	<stijnleenknegt@gmail.com>
 * @version	1.0
 * @package DUBB
 */
abstract class DUBB_Tag_Function implements DUBB_Tag
{


	protected $_params = array();

	
	/**
	 * Maak een nieuwe stijlfunctie aan met parameters.
	 *
	 * @param 	array 	$params
	 */
	public function __construct(array $params)
	{
		$this->_params = $this->removeParamQuotes($params);
	}
	
	/**
	 * Verwijder de enkele quotes rondom de parameters.
	 *
	 * @param 	array 	$params
	 * @return 	string
	 */
	protected function removeParamQuotes(array $params)
	{
		return str_replace("'" , "" , $params);
	}
	

}

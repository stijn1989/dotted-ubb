<?php
include_once 'Tag.php';

/**
 * The class to create styletag functions (child of DUBB_Tag).
 *
 * @author	Stijn Leenknegt	<stijnleenknegt@gmail.com>
 * @version	1.0
 * @package DUBB
 */
abstract class DUBB_Tag_Function implements DUBB_Tag
{


	private $_params = array();

	
	/**
     * Create a new styletag function with parameters.
	 *
	 * @param 	array 	$params
	 */
	public function __construct(array $params)
	{
		$this->_params = $this->removeParamQuotes($params);
	}
    
    
    /**
     * Make the parameters write-once, read-many.
     */
    private function __set($name , $value){}
    
    
    /**
     * Make the params readable
     */
    public function __get($name)
    {
        return $this->$name;
    }
    
	
	/**
	 * Remove the single quotes from the parameters.
	 *
	 * @param 	array 	$params
	 * @return 	string
	 */
	protected function removeParamQuotes(array $params)
	{
		return str_replace("'" , "" , $params);
	}
	

}

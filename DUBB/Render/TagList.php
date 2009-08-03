<?php
/**
 * This class helps in the render process.
 * It builds an array of all the styleTags (with parameters).
 * 
 * @author	Stijn Leenknegt	<stijnleenknegt@gmail.com>
 * @version	1.0
 * @package DUBB
 */
class DUBB_Render_TagList
{

    private $_tagList = array();
    
    
	/**
	 * Initialize a new tagList
	 *
	 * @param 	string 	$tags
	 */
    public function __construct($tags)
	{
		$this->_build($tags);
	}
    
    
	/**
	 * Build the tagList array
	 *
	 * @param 	string 	$tags
	 */
    protected function _build($tags)
	{
		$tags = explode(',' , $tags);
		
		for($i = 0 , $count = count($tags) ; $i < $count ; $i++) {
			$tag = trim($tags[$i]);
			$position = strpos($tag, '(');
			$params = array();
			
			//a styletag function is found!
			if($position !== false) {
				list($tag , $param) = explode('(' , $tag);
				//build the parameters array
				while(strpos($param , ')') === false) {
					$params[] = $param;
					$param = trim($tags[++$i]);
				}
				$params[] = substr($param , 0 , strlen($param) - 1);
			}
			
			//check if the tag is registered before adding it!
			if(! DUBB::isRegisteredTag($tag , count($params))) continue;
			
			//create the Tag object
			if(empty($params)) {
				$class = DUBB::DUBB_TAG_CLASS_PREFIX . ucfirst($tag);
				$obj = new $class;
			} else {
				$class = DUBB::DUBB_TAG_CLASS_PREFIX . ucfirst($tag);
				$obj = new $class($params);
			}
				
			$this->_tagList[$tag] = $obj;
		}
	}
    
    
	/**
	 * Give an array iterator back to iterate the tagList
	 *
	 * @return 	ArrayIterator
	 */
    public function getTagListIterator()
    {
        return new ArrayIterator($this->_tagList);
    }

}
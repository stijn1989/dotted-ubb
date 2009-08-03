<?php
/**
 * Load the DUBB tag class(es) when registering them.
 *
 * @author	Stijn Leenknegt	<stijnleenknegt@gmail.com>
 * @version	1.0
 * @package DUBB
 */
function __autoload($class)
{
	include_once '.' . DIRECTORY_SEPARATOR . str_replace('_' , DIRECTORY_SEPARATOR , $class) . '.php';
}


/**
 * Setup the include path to find the tag classes.
 */
set_include_path(get_include_path() . PATH_SEPARATOR . '.' . DIRECTORY_SEPARATOR . 'DUBB' . DIRECTORY_SEPARATOR);


/**
 * <h1>Dotted UBB</h1>
 *
 * Dotted UBB, short DUBB, is a new and fast way to style your text.
 * The usability is unique and has never been used before.
 * An introduction:
 *
 *      [The quick.{i} brown.{color('brown')} fox jumps over the lazy dog].{b, size('3')}
 *
 * The render will give the follow output on your screen.
 *
 *      <h3><strong>The <em>quick</em> <span style="color: brown;">brown</span> fox jumps over the lazy dog</strong></h3>
 *
 * <h2>Features</h2>
 *
 * You can style a (group) word(s) like the follow example:
 *
 * 		word.{b}
 *
 * If you want to style a single word, you put a dot after the word and then write braces.
 * Between the braces you put your style or styles.
 * You can divide multiple styles with a comma.
 *
 * 		word.{b , i}
 *
 * In the example above the word will be printed bold and italic.
 * If you want add a special style, example creating a link of the word.
 * You have to have some parameters like an URL address or more.
 * This is called a styletag function. You write the name of the styletag function and between
 * the parentheses you give the parameter(s).
 * Next is an example of a style function.
 *
 * 		word.{url(http://www.google.com)}
 *
 * If you have to pass more then one parameter, you can divide them by a comma.
 * You can use normal styletags (b, i, ...) and styletag functions on the same word without any order.
 *
 * If you want to style more then one word, you can group the words between square brackets.
 * After the ] bracket you put the dot and the style(s) between the braces.
 *
 * 		[This is my first wordgroup].{b , url(http://www.google.com , Google websearch!) , i}
 *
 * The words "This is my first wordgroup" will be an URL to google.com with a title attribute.
 * The group of words will also be printed bold and italic.
 *
 * Since version 1.1 you can group multiple lines together.
 *
 * 		[foo
 * 		bar
 * 		baz].{b}
 *
 * If you have large text to style, maybe to make your introduction bold, you can group it and style it.
 * You can also nest styletags, like follow example:
 *
 * 		[foo bar.{b} baz]{i}
 *
 * "foo bar baz" is italic and "bar" bold.
 * Je can also nest group in group, see follow example:
 *
 * 		[Blandit crisare, facilisi autem feugiat suscipit illum feugiat eum, ut illum. 
 *      Esse magna [te facilisi erat delenit et. Commodo in vel eros te in.].{b}
 *      Nulla eu nonummy velit vel in, amet vulputate et eros tation nostrud vero, in aliquip amet, in facilisi feugait eu et. 
 *      Qui vero eu blandit delenit facilisi magna consequat illum, ullamcorper tation.].{i}
 *
 * The whole section is printed italic and the second sentence is also printed bold.
 *
 * 
 * <h2>How to use in you PHP script(s)?</h2>
 *
 * Before you can render text, you have to tell the DUBB class which styletags you want to use.
 * You can register the styletags with the function DUBB::registerTag($tag).
 * If you don't register any styletags, you're text will be plain and boring.
 *
 * 		DUBB::registerTag('b')
 *
 * If you want to register a styletag function, you need a second parameter for the registerTag($tag) function.
 * The second parameter tells DUBB how many parameters the function needs.
 *
 * 		DUBB::registerTag('url' , 2);
 *
 * If you want to register more then one styletags, you can use the function registerTags(array $tags).
 * See follow example:
 *
 * 		DUBB::registerTags( array('b' , 'url' => 2) );
 *
 * The function DUBB#render() will render the string you passed to the constructor.
 * It gives the styled string back. You can print it or save it or eat it. 
 * I don't care as long it renders I'm happy.
 *
 *
 * Here you can see a small example, enjoy!
 *
 * 		<code>
 * 		DUBB::registerTags(array('b' , 'i' , 'color' => 1));
 *		$string = "blaat.{b} - [foo bar].{i, color(red)} :)";
 *		$dubb = new DUBB($string);
 * 		echo $dubb->render();
 * 		</code>
 *
 * 
 * @author	Stijn Leenknegt	<stijnleenknegt@gmail.com>
 * @version	1.4
 * @package DUBB
 */
class DUBB
{


	const DUBB_TAG_CLASS_PREFIX = 'DUBB_Tag_';
	
	protected static $_tags = array();
	
	protected $_string;
	

	/**
	 * Create a new DUBB instance.
	 *
	 * @param 	string 	$string
	 */
	public function __construct($string)
	{
		$this->_string = $string;
	}
	
	
	/**
	 * Register a DUBB styletag.
	 *
	 * @static
	 * @param 	string 	$tag
	 * @param 	int 	$params 	optional
     * @throws  DUBB_Exception
	 */
	public static function registerTag($tag , $params = 0)
	{
        if(! class_exists(self::DUBB_TAG_CLASS_PREFIX . ucfirst($tag)))
            throw new DUBB_Exception("The class " . self::DUBB_TAG_CLASS_PREFIX . ucfirst($tag) . " could not be found!");
        
		self::$_tags[$tag] = $params;
	}
	
	
	/**
	 * Register multiple DUBB styletags.
	 *
	 * @static
	 * @param 	array 	$tags
	 */
	public static function registerTags(array $tags)
	{
		foreach($tags as $tag => $params) {
			if(is_int($tag))
				self::registerTag($params);
			else
				self::registerTag($tag , $params);
		}
	}
	
	
	/**
	 * Render the string, DUBB style!
	 *
	 * @return 	string
	 */
	public function render()
	{
        //replace all words.{b} in [words].{b}
        $this->_string = preg_replace("~(\w+)\.\{(.*?)\}~" , "[\\1].{\\2}" , $this->_string);
		
        /**
         * It happens here. Every [...].{...} will be rendert.
         *
         * $results[0] contains the matched part.
         * $results[1] contains the string that has to be styled without the square brackets.
         * $results[2] contains the tags without the braces.
         */
        while(preg_match("~\[([^\[]*?)\]\.\{(.*?)\}~" , $this->_string , $results)) {
            $str = $results[1];
            
            //build the style tag list
			$tagList = new DUBB_Render_TagList($results[2]);
			
			//now render every tag in $tagList on the string
			$iterator = $tagList->getTagListIterator();
			while($iterator->valid()) {
				$str = $iterator->current()->render($str);
				$iterator->next();
			}
            
            //replace the styled $str in $this->_string
            $this->_string = str_replace($results[0] , $str , $this->_string);
        }
		
		return $this->_string;
	}
	
	
	/**
     * Check if the tag is a registered styletag.
	 *
	 * @static
	 * @param 	string 	$tag
	 * @param 	int 	$amountParams
	 * @return 	boolean
	 */
	public static function isRegisteredTag($tag , $amountParams)
	{
		return array_key_exists($tag , self::$_tags) && self::$_tags[$tag] == $amountParams;
	}


}

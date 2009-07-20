<?php
/**
 * Laad de DUBB tag class(es) voor het renderen.
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
 * Stel de included_path in
 */
set_include_path(get_include_path() . PATH_SEPARATOR . '.' . DIRECTORY_SEPARATOR . 'DUBB' . DIRECTORY_SEPARATOR);


/**
 * Dotted UBB, kortweg DUBB, is een nieuwe, snelle en handige manier om teksten te stijlen.
 * De schrijfwijze is uniek en enig in zijn soort in de IT wereld.
 * Een (groep) woord(en) kan je een stijl of meerdere stijlen geven op de volgende manier:
 *
 * 		woord.{b}
 *
 * Na het woord dat je een stijl geeft, staat een punt (dot) en tussen de accolades de stijl
 * dat je wilt geven aan het woord. Hier wordt het woord dus vetjes gedrukt.
 * Als je meerdere stijlen wilt gebruiken, kan je dit doen door ze te scheiden met komma's.
 *
 * 		woord.{b , i}
 *
 * In dit voorbeeld wordt het woord vetjes en cursief gedrukt.
 * Als je een link wilt maken van een woord, moet je een URL opgeven.
 * Dit wordt opgelost door de stijl als een soort van functie te maken.
 * Eigenlijk zijn alle stijlen functies maar sommige hebben geen parameters zoals de bold stijl.
 * Een URL heeft één parameter en ziet er als volgt uit.
 *
 * 		woord.{url('http://www.google.com')}
 *
 * De stijl is url en tussen de haakjes en ENKELE quotes staat de parameter.
 * Meerdere parameters worden gescheiden met komma's.
 * Je kan ook stijlen en stijlfuncties door elkaar gebruiken, er is geen volgorde aan verbonden.
 *
 * Als je meerdere worden wilt stijlen, moet je ze groeperen tot een woordgroep.
 * Aan die woordgroep ken je dan op dezelfde manier, met het puntje en accolades, de stijl(en) toe.
 * Een woordgroep vorm je door rond de woorden vierkante haakjes, [ ], te plaatsen.
 *
 * 		[dit is mijn woordgroep].{b , url('http://www.google.com' , 'Google zoekmachine!') , i}
 *
 * De woorden "dit is mijn woordgroep" krijgt een link naar google.com met title attribuut 'Google zoekmachine!'
 * en wordt vetjes en cursief afgedrukt.
 *
 * Je kan ook meerdere lijnen groeperen en stijlen met DUBB tags.
 *
 * 		[foo
 * 		bar
 * 		baz].{b}
 *
 * Zo kan je makkelijk hele lijnen teksten gaan groeperen.
 * Daarnaast kan je ook DUBB tags gaan nesten in elkaar, bijvoorbeeld:
 *
 * 		[foo bar.{b} baz]{i}
 *
 * "foo bar baz" wordt schuin gedrukt en "bar" wordt daarbij nog eens cursief gedrukt.
 * Je kan ook geneste groeperingen maken, een voorbeeldje
 *
 * 		[Blandit crisare, facilisi autem feugiat suscipit illum feugiat eum, ut illum. 
 *      Esse magna [te facilisi erat delenit et. Commodo in vel eros te in.].{b}
 *      Nulla eu nonummy velit vel in, amet vulputate et eros tation nostrud vero, in aliquip amet, in facilisi feugait eu et. 
 *      Qui vero eu blandit delenit facilisi magna consequat illum, ullamcorper tation.].{i}
 *
 * Zo wordt in de twee zin een stukje vetjes gedrukt, terwijl de hele paragraaf schuingedrukt wordt.
 *
 *
 * Voor je de methode DUBB#render() aanroept, kan je DUBB stijl tags registreren.
 * Als je geen tags registreert, wordt er niets gerendert. Enkel de geregistreerde worden gerendert.
 * Tags registreer je met de statische functie DUBB#registerTag().
 *
 * 		DUBB::registerTag('b')
 *
 * Als je stijl tag een stijlfunctie is, wat dus parameters heeft, kan je een tweede parameter meegeven
 * aan de functie. De tweede parameter is het aantal parameters de stijlfunctie heeft.
 *
 * 		DUBB::registerTag('url' , 2);
 *
 * Je kan ook een array meegeven aan de functie DUBB#registerTags().
 *
 * 		DUBB::registerTags( array('b' , 'url' => 2) );
 *
 *
 * De functie DUBB#render() gaat de string van het DUBB object renderen met alle geregistreerde stijltags.
 * Deze geeft dan de string terug met de stijlen toegepast. Je kan die string dan in je code echoën, 
 * sturen naar je output kanaal of eender wat mee doen.
 *
 *
 * Een voorbeeld van hoe je deze code kan gebruiken.
 *
 * 		<code>
 * 		<?php
 * 		DUBB::registerTags(array('b' , 'i' , 'color' => 1));
 *		$string = "blaat.{b} - [foo bar].{i, color('red')} :)";
 *		$dubb = new DUBB($string);
 * 		echo $dubb->render();
 * 		?>
 * 		</code>
 *
 * 
 * @author	Stijn Leenknegt	<stijnleenknegt@gmail.com>
 * @version	1.2
 * @package DUBB
 */
class DUBB
{


	const DUBB_TAG_CLASS_PREFIX = 'DUBB_Tag_';
	
	protected static $_tags = array();
	
	protected $_string;
	

	/**
	 * Maak een DUBB object aan.
	 *
	 * @param 	string 	$string
	 */
	public function __construct($string)
	{
		$this->_string = $string;
	}
	
	
	/**
	 * Registreer een DUBB tag.
	 *
	 * @param 	string 	$tag
	 * @param 	int 	$params 	optional
	 */
	public static function registerTag($tag , $params = 0)
	{
		self::$_tags[$tag] = $params;
	}
	
	
	/**
	 * Registeer een array van DUBB tags.
	 *
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
	 * Render de string met de DUBB tags.
	 *
	 * @return 	string
	 */
	public function render()
	{
        //vervang alle woorden.{b} in [woorden].{b}
        $this->_string = preg_replace("~(\w+)\.\{(.*?)\}~" , "[\\1].{\\2}" , $this->_string);
        
        /**
         * Hier gebeurt het renderen. Iedere [...].{...} wordt gerendert.
         *
         * $results[0] het gedeelte dat gematched is.
         * $results[1] bevat de string die gestijlt moet worden zonder [].
         * $results[2] de tags zonder accolade.
         */
        while(preg_match("~\[([^\[]*?)\]\.\{(.*?)\}~" , $this->_string , $results)) {
            $str = $results[1];
            $tags = $results[2];
            
            //bewerk de tags voor verdere bewerkingen
            $tags = preg_replace("~\s*,\s*~" , "," , $tags);
            $tags = preg_replace("~\',\'~" , "':;:'" , $tags);
            
            //stijl de string met iedere tag in $tags
            foreach(explode(',' , $tags) as $tag) {
                if(! $this->_isValidTag($tag)) continue;
                if($functionInfo = $this->_isTagFunction($tag)) {
                    $class = self::DUBB_TAG_CLASS_PREFIX . ucfirst($functionInfo['tag']);
                    $obj = new $class($functionInfo['params']);
                    $str = $obj->render($str);
                } else {
                    $class = self::DUBB_TAG_CLASS_PREFIX . ucfirst($tag);
                    $obj = new $class;
                    $str = $obj->render($str);
                }
            }
            
            //replace de gestijlde $str in $this->_string
            $this->_string = str_replace($results[0] , $str , $this->_string);
        }
		
		return $this->_string;
	}
	
	
	/**
	 * Controleert of een tag geldig is. Dus het moet geregistreerd zijn en zijn klasse moet included zijn.
	 *
	 * @param 	string 	$tag
	 * @return 	boolean
	 */
	protected function _isValidTag($tag)
	{
		$valid = false;
		
		$split = preg_split("~\(~" , $tag);
		$tag = $split[0];

		if(array_key_exists($tag , self::$_tags) && class_exists(self::DUBB_TAG_CLASS_PREFIX . ucfirst($tag))) {
			$valid = true;
		}
		
		return $valid;
	}
	
	/**
	 * Kijkt of de tag een stijlfunctie is of niet.
	 *
	 * @param 	string 	$_tag
	 * @return 	boolean
	 */
	protected function _isTagFunction($_tag)
	{
		foreach(self::$_tags as $tag => $amountArguments) {
			if($amountArguments > 0 && preg_match("~$tag\((.*?)\)~" , $_tag , $results)) {
				return array('tag' => $tag , 'params' => explode(':;:' , $results[1]));
			}
		}
		
		return false;
	}


}

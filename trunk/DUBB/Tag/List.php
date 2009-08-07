<?php
include_once 'Tag' . DIRECTORY_SEPARATOR . 'Function.php';

/**
 * Create a (un)ordered list.
 *
 *      [item 1|item 2|item 3].{list}
 *
 * @DUBB_Param              $type   ol|ul
 * @DUBB_Optional_Param     $style  both=none,
 *                                  ol=decimal|decimal-leading-zero|georgian|lower-alpha|lower-greek|lower-latin|upper-alpha|upper-latin|upper-roman,
 *                                  ul=circle|disc|square
 *
 * @author	Stijn Leenknegt	<stijnleenknegt@gmail.com>
 * @version	1.0
 * @package DUBB
 */
class DUBB_Tag_List extends DUBB_Tag_Function
{


    private $_olStyles = array('none','decimal','decimal-leading-zero','georgian','lower-alpha','lower-greek','lower-latin','upper-alpha','upper-latin','upper-roman');

    private $_ulStyles = array('none','circle','disc','squar');


	public function render($string)
	{
		$items = array_map("trim" , explode('|' , $string));

        if($this->_params[0] == 'ol') {
            if(isset($this->_params[1]) && in_array($this->_params[1] , $this->_olStyles)) {
                return $this->_renderOlStyle($items , $this->_params[1]);
            } else {
                return $this->_renderOl($items);
            }
        } elseif($this->_params[0] == 'ul') {
            if(isset($this->_params[1]) && in_array($this->_params[1] , $this->_ulStyles)) {
                return $this->_renderUlStyle($items , $this->_params[1]);
            } else {
                return $this->_renderUl($items);
            }
        }
	}


    private function _renderListItems(array $items)
    {
        $html = '';
        foreach($items as $item) {
            $html .= '<li>' . $item . '</li>';
        }
        return $html;
    }


    private function _renderOlStyle(array $items , $style)
    {
        $html = '<ol style="list-style-type:' . $style . ';">';
        $html .= $this->_renderListItems($items);
        $html .= '</ol>';
        return $html;
    }


    private function _renderOl(array $items)
    {
        $html = '<ol>';
        $html .= $this->_renderListItems($items);
        $html .= '</ol>';
        return $html;
    }


    private function _renderUlStyle(array $items , $style)
    {
        $html = '<ul style="list-style-type:' . $style . ';">';
        $html .= $this->_renderListItems($items);
        $html .= '</ul>';
        return $html;
    }


    private function _renderUl(array $items)
    {
        $html = '<ul>';
        $html .= $this->_renderListItems($items);
        $html .= '</ul>';
        return $html;
    }


}

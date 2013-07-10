<?php
/**
 * XOOPS form element
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         kernel
 * @subpackage      form
 * @since           2.0.0
 * @author          Kazumi Ono (AKA onokazu) http://www.myweb.ne.jp/, http://jp.xoops.org/
 * @version         $Id: formtext.php 8066 2011-11-06 05:09:33Z beckmi $
 */

defined('XOOPS_ROOT_PATH') or die('Restricted access');

/**
 * A simple text field
 */
class XoopsFormColumn extends XoopsFormElement
{
    /**
     * show center checkbox or not
     *	
     * @var bool
     * @access private
     */
    var $_center;
	
    /**
     * Initial value
     *
     * @var array
     * @access private
     */
    var $_value = array(3,6);
	
    /**
     * Constructor
     *
     * @param string $caption Caption
     * @param string $name "name" attribute
     * @param int $size Size
     * @param int $maxlength Maximum length of text
     * @param string $value Initial text
     */
    function XoopsFormColumn($caption, $name, $value = '')
    {
        $this->setCaption($caption);
        $this->setName($name);
        $this->setValue($value);
    }
	
    /**
     * Get initial content
     *
     * @param bool $encode To sanitizer the text? Default value should be "true"; however we have to set "false" for backward compat
     * @return string
     */
    function getValue($encode = false)
    {
        return $encode ? htmlspecialchars($this->_value, ENT_QUOTES) : $this->_value;
    }
    
    /**
     * Set initial text value
     *
     * @param  $value string
     */
    function setValue($value)
    {
      if(!empty($value)){
        $value = explode('|', $value);
        $this->_value[0] = $value[0]<6&&$value[0]>=0?$value[0]:4;
        $this->_value[1] = $value[1]<6&&$value[1]>3?$value[1]:4;
      }
    }
    
    /**
     * Prepare HTML for output
     *
     * @return string HTML
     */
    function render()
    {
		$value = $this->getValue();
		$html = '<script type="text/javascript">';
		$html.= ' $(document).ready(function(){';
		$html.= '$( "#slider-range" ).slider({';
		$html.= '  range: true,';
		$html.= '  min: 0,';
		$html.= '  max: 12,';
		$html.= '  values: [ '.$value[0].', '.(12-$value[1]).' ],';
		$html.= '  slide: function( event, ui ) {';
		$html.= '   $( "#l_struct_0" ).val(ui.values[ 0 ]);';
		$html.= '   $( "#l_struct_1" ).val(ui.values[ 1 ]-ui.values[ 0 ]);';
		$html.= '	  $( "#amount" ).val( "'._RIGHT.': " + ui.values[ 0 ]*70 + " - '._LEFT.': " + (12-ui.values[ 1 ])*70 );';
		$html.= '  }';
		$html.= '});';
		$html.= '$( "#amount" ).val(  "'._RIGHT.': " + $( "#slider-range" ).slider( "values", 0 )*70 +';
		$html.= '  " - '._LEFT.': " + (12-$( "#slider-range" ).slider( "values", 1 ))*70 );';
		$html.= '});';
		$html.= '</script>';
		$html.= '<p>';
		$html.= '<label for="amount">'._AM_TMANAGER_SIDEBARWIDTH.':</label>';
		$html.= '<input type="text" id="amount" style="border: 0; color: #f00; font-weight: bold;" />';
		$html.= '<input type="hidden" id="l_struct_0" name="l_struct_0" value="'.$value[0].'" />';
		$html.= '<input type="hidden" id="l_struct_1" name="l_struct_1" value="'.$value[1].'" />';
		$html.= '</p>';
		$html.= '<div id="slider-range"></div>';
		
		return $html;
    }
}

?>

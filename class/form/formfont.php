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
class XoopsFormFont extends XoopsFormElement
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
    var $_value = array("size" => 14, "font" => "Arial", "color" => "#000000", "b" => 0, "i" => 0, "u" => 0);
	
    /**
     * Constructor
     *
     * @param string $caption Caption
     * @param string $name "name" attribute
     * @param int $size Size
     * @param int $maxlength Maximum length of text
     * @param string $value Initial text
     */
    function XoopsFormFont($caption, $name, $center=false, $value = '')
    {	
		global $xoops;
		$xoops->theme()->addScript('modules/tmanager/js/tmanager.js');

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
		
        return $this->_value;
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
			$this->_value['size'] = $value[0];
			$this->_value['font'] = $value[1];
			$this->_value['color'] = $value[2];
			$this->_value['b'] = $value[3];
			$this->_value['i'] = $value[4];
			$this->_value['u'] = $value[5];
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
		$size = new XoopsFormNumber('', $this->getName().'_size', $value['size']);
		$font = new XoopsFormSelect('', $this->getName().'_font', $value['font']);
		$font->addOptionArray(array("Arial" => "Arial",  "Courier New" => "Courier New",  "Helvetica" => "Helvetica",  "Times New Roman" => "Times New Roman",  "Avant Garde" => "Avant Garde",  "Bookman" => "Bookman",  "Comic Sans MS" => "Comic Sans MS",  "Garamond" => "Garamond",  "Georgia" => "Georgia",  "Impact" => "Impact",  "Palatino" => "Palatino",  "Tahoma" => "Tahoma",  "Trebuchet MS" => "Trebuchet MS",  "Verdana" => "Verdana",  "Sans Serif" => "Sans-serif",  "Serif" => "Serif"));
        $color = new XoopsFormCustomPicker('', $this->getName().'_color', $value['color'], false);
		
		$bold = $value['b'];
		$italique = $value['i'];
		$underline = $value['u'];
		
		return 	'<div>'.
			$size->render().'&nbsp;&nbsp;'.
			$color->render().'&nbsp;&nbsp;'.
			$font->render().'&nbsp;&nbsp;'.
			"<div class='btn-group' data-toggle=\"buttons-checkbox\">" .
			   "<a class='btn bformat ".($bold?'active':'')."' id=\"".$this->getName()."_b\" style=\"font-weight: bold;\">Bold</a>" .
			   "<a class='btn bformat ".($italique?'active':'')."' id=\"".$this->getName()."_i\" style=\"font-style: italic;\">Italic</a>" .
			   "<a class='btn bformat ".($underline?'active':'')."' id=\"".$this->getName()."_u\" style=\"text-decoration: underline;\">Underline</a>".
			"</div>".
			"<input type=\"checkbox\" id=\"".$this->getName()."_bc\" name=\"".$this->getName()."_b\" value=\"1\"  style=\"display:none\" ".($bold?'checked':'').">".
			"<input type=\"checkbox\" id=\"".$this->getName()."_ic\" name=\"".$this->getName()."_i\" value=\"1\"  style=\"display:none\" ".($bold?'checked':'').">".
			"<input type=\"checkbox\" id=\"".$this->getName()."_uc\" name=\"".$this->getName()."_u\" value=\"1\"  style=\"display:none\" ".($bold?'checked':'')."></div>";
    }
}

?>

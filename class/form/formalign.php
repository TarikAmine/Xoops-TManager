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
 * @version         $Id: formradioyn.php 8066 2011-11-06 05:09:33Z beckmi $
 */

defined('XOOPS_ROOT_PATH') or die('Restricted access');

xoops_load('XoopsFormSelect');

/**
 * Yes/No radio buttons.
 *
 * A pair of radio buttons labelled _YES and _NO with values 1 and 0
 */
class XoopsFormAlign extends XoopsFormText
{
    /**
     * show center checkbox or not
     *	
     * @var bool
     * @access private
     */
    var $_center;
	
	
    /**
     * Constructor
     *
     * @param string $caption Caption
     * @param string $name "name" attribute
     * @param int $size Size
     * @param int $maxlength Maximum length of text
     * @param string $value Initial text
     */
    function XoopsFormAlign($caption, $name, $value = 'l', $center = true)
    {
         parent::__construct($caption, $name, 2, 8, $value, '');
		$this->_center = $center;
    }
    
    
    /**
     * Prepare HTML for output
     *
     * @return string HTML
     */
    function render()
    {
		$id = substr($this->getName(), -2)=='[]'?substr($this->getName(), 0, -2):$this->getName();
		$html  = "<div class=\"btn-group\" data-toggle=\"buttons-radio\">";
		$html .= "<button type=\"button\"  id=\"".$id."_l\" class=\"btn balign ".$id."_button ".($this->getValue()=='l'?'active':'')."\"><i class=\"icon-align-left\"></i></button>";
		if($this->_center)
			$html .= "<button type=\"button\"  id=\"".$id."_c\" class=\"btn balign ".$id."_button ".($this->getValue()=='c'?'active':'')."\"><i class=\"icon-align-center\"></i></button>";
		$html .= "<button type=\"button\"  id=\"".$id."_r\" class=\"btn balign ".$id."_button ".($this->getValue()=='r'?'active':'')."\"><i class=\"icon-align-right\"></i></button>";
		$html .= "</div>";
		$html .= "<input type=\"hidden\" id=\"".$id."_input\" name=\"".$id."\" value=\"".$this->getValue()."\">";
		
		return $html;
	
	}
}
?>
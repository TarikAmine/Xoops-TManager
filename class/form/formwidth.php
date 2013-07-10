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
class XoopsFormWidth extends XoopsFormElement
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
     * @var string
     * @access private
     */
    var $_value = array('type' => 0, 'nbr' => 0);
	
    /**
     * Constructor
     *
     * @param string $caption Caption
     * @param string $name "name" attribute
     * @param int $size Size
     * @param int $maxlength Maximum length of text
     * @param string $value Initial text
     */
    function XoopsFormWidth($caption, $name, $value = '')
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
		$value = explode('|', $value);
        $this->_value['type'] = $value[0];
        $this->_value['nbr'] = $value[1];
    }
    
    /**
     * Prepare HTML for output
     *
     * @return string HTML
     */
    function render()
    {
		$value = $this->getValue();
		
		$layoutselec = new XoopsFormSelect('', $this->getName().'_type', $value['type']);
		$layoutselec->setClass("width_toggle");
		$layoutselec->addOption(0, _AM_TMANAGER_LAYOUTFIXED);
		$layoutselec->addOption(1, _AM_TMANAGER_LAYOUTFLUID);
		$width = new XoopsFormNumber('', $this->getName().'_nbr', $value['nbr'], $value['type']==0?'px':'% ', false);
		
		return 	$layoutselec->render()."  ".
				$width->render();
    }
}

?>

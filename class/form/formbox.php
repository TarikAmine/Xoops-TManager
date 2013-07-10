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
class XoopsFormBox extends XoopsFormElement
{
    /**
     * show vertical inputs or not
     *	
     * @var bool
     * @access private
     */
    var $_vertical;
	
    /**
     * Initial value
     *
     * @var string
     * @access private
     */
    var $_value;
	
    /**
     * Constructor
     *
     * @param string $caption Caption
     * @param string $name "name" attribute
     * @param int $size Size
     * @param int $maxlength Maximum length of text
     * @param string $value Initial text
     */
    function XoopsFormBox($caption, $name, $value = '', $vertical=false)
    {
        $this->setCaption($caption);
        $this->setName($name);
		$this->_vertical=$vertical;
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
        $this->_value = $value;
    }
    
    /**
     * Prepare HTML for output
     *
     * @return string HTML
     */
    function render()
    {
		$i=0;
		$value = explode('|', $this->getValue());
		
    $top = new XoopsFormNumber(_AM_TMANAGER_BOX_TOP, $this->getName().'_top', $value[0], 'px', 'auto');
		$right = new XoopsFormNumber(_AM_TMANAGER_BOX_RIGHT, $this->getName().'_right', $value[1], 'px', 'auto');
		$bot = new XoopsFormNumber(_AM_TMANAGER_BOX_BOTTOM, $this->getName().'_bot', $value[2], 'px', 'auto');
		$left = new XoopsFormNumber(_AM_TMANAGER_BOX_LEFT, $this->getName().'_left', $value[3], 'px', 'auto');
		return  '<span>'._AM_TMANAGER_BOX_TOP.':&nbsp;</span>&nbsp;'.$top->render().'&nbsp;&nbsp;'.
				'<span>'._AM_TMANAGER_BOX_RIGHT.':&nbsp;</span>&nbsp;'.$right->render().'&nbsp;&nbsp;'.
				'<span>'._AM_TMANAGER_BOX_BOTTOM.':&nbsp;</span>&nbsp;'.$bot->render().'&nbsp;&nbsp;'.
				'<span>'._AM_TMANAGER_BOX_LEFT.':&nbsp;</span>&nbsp;'.$left->render();
	}
}

?>

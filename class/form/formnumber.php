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
class XoopsFormNumber extends XoopsFormText
{

    /**
     * element number unit
     *
     * @var string
     */
    private $_unit;
	
	/**
     * element number unit
     *
     * @var string
     */
    private $_disabled_value;

	/**
     * Get id
     *
     * @return string
     */
    public function getUnit()
    {
        return $this->_unit;
    }
	
    function XoopsFormNumber($caption, $name, $value = '', $unit='px', $disabled_value='inhert')
    {
        $this->setCaption($caption);
        $this->setName($name);
        $this->setValue($value);
		$this->_unit = $unit;
		$this->_disabled_value = $disabled_value;
    }
	
	/**
     * Prepare HTML for output
     *
     * @return string HTML
     */
    public function render()
    {
        $name = $this->getName();
        if ($this->getSize() > $this->getMaxcols()) {
            $maxcols = 5;
        } else {
            $maxcols = $this->getSize();
        }
		
		$id = substr($this->getName(), -2)=='[]'?substr($this->getName(), 0, -2):$this->getName();
        $class = ($this->getClass() != '' ? " class='span" . $maxcols . " " . $this->getClass() . "'" : " class='span" . $maxcols . "'");
        $list = ($this->isDatalist() != '' ? " list='list_" . $name . "'" : '');
        $pattern = ($this->getPattern() != '' ? " pattern='" . $this->getPattern() . "'" : '');
        $placeholder = ($this->getPlaceholder() != '' ? " placeholder='" . $this->getPlaceholder() . "'" : '');
        $extra = ($this->getExtra() != '' ? " " . $this->getExtra() : '');
        $required = ($this->isRequired() ? ' required' : '');
		
		if($this->_disabled_value != false)
			$disable_check = "<span  id='' class=\"add-on\"><input type=\"checkbox\" name=\"".$id."_disabled\" id=\"".$id."_auto\" class=\"toggle_number ".$this->_disabled_value."number\" value=\"1\" ".($this->_disabled_value==$this->getValue()?'checked="checked"':'')."></span>";
		else
			$disable_check = "";
		return "<div class=\"input-prepend input-append\" style=\"display: inline-block;vertical-align: middle;margin-bottom:0;font-size: 100%;\">".
					$disable_check.
					"<input type='text' id='".$id."_number' name='" . $name . "' title='" . $this->getTitle() . "' " . $class ." maxlength='" . $this->getMaxlength() . "' value='" . $this->getValue() . "'" . $list . $pattern . $placeholder . $extra . $required . " style=\"width: 35px;\"  ".($this->_disabled_value==$this->getValue()?'disabled="disabled"':'').">".
					"<span  id='".$id."_unit' class=\"add-on\">".$this->_unit."</span>".
				"</div>";
    }
}

?>

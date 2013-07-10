<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * XOOPS form element of colorpicker
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         class
 * @subpackage      xoopsform
 * @since           2.0.0
 * @author          Zoullou <webmaster@zoullou.org>
 * @author          John Neill <catzwolf@xoops.org>
 * @version         $Id: formcolorpicker.php 10328 2012-12-07 00:56:07Z trabis $
 */

defined('XOOPS_ROOT_PATH') or die('Restricted access');

class XoopsFormCustomPicker extends XoopsFormText
{
   /**
     * show transparent checkbox or not
     *	
     * @var bool
     * @access private
     */
    var $_transparent;
	
    /**
     * @param mixed $caption
     * @param mixed $name
     * @param string $value
     */
    public function XoopsFormCustomPicker($caption, $name, $value = '#FFFFFF', $transparent=true)
    {
        parent::__construct($caption, $name, 2, 7, $value, '');
		$this->setClass('tmanager_colorpicker');
		$this->setExtra('style="width:50px;margin-bottom:0;"');
		$this->_transparent = $transparent;
    }

    /**
     * @return string
     */
    public function render()
    {
		$transparent = $checked = '';
		$value = explode('|', $this->getValue());
		if(count($value)==1) 
			$value = array(0, $value[0]);
		if($value[0])
			$checked = 'checked="checkd"';
		$this->setValue($value[1]);
        $xoops = Xoops::getInstance();
		$xoops->theme()->addStylesheet('modules\tmanager\js\colorpicker\css\colorpicker.css');
		if($this->_transparent == true)
			$transparent = '<label class="checkbox"><input type="checkbox" name="'.$this->getName().'_t" id="'.$this->getName().'_t" class="bg_transparent" value="'.$this->getName().'_istrans">'._AM_TMANAGER_TRANSPARENT.'</label>';
		return $transparent.parent::render();
    }

}
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
class XoopsFormBorderBox extends XoopsFormElement
{

    /**
     * Initial value
     *
     * @var array
     * @access private
     */
    var $_value = array('same' => 1, 
						'size' => array(0, 0, 0, 0),
						'type' => array('dotted', 'dotted', 'dotted', 'dotted'),
						'color' => array('#000000', '#000000', '#000000', '#000000'));
	
    /**
     * Constructor
     *
     * @param string $caption Caption
     * @param string $name "name" attribute
     * @param int $size Size
     * @param int $maxlength Maximum length of text
     * @param string $value Initial text
     */
    function XoopsFormBorderBox($caption, $name, $value = '')
    {
        $this->setCaption($caption);
        $this->setName($name);
        $this->setValue($value);
    }
	

	function SingleBorder($caption, $vsize, $vtype, $vcolor, $id){
		$value = $this->getValue();
		
		$size = new XoopsFormNumber('', $this->getName().'_'.$id.'_size', $vsize, 'px', 'disabled');
		$type = new XoopsFormSelect('', $this->getName().'_'.$id.'_type', $vtype);
		$type->addOptionArray(array("None" => "None",  "hidden" => "hidden",  "dotted" => "dotted",  "dashed" => "dashed",  "solid" => "solid",  "double" => "double",  "groove" => "groove",  "ridge" => "ridge",  "inset" => "inset",  "outset" => "outset"));
		$color = new XoopsFormCustomPicker('', $this->getName().'_'.$id.'_color', $vcolor, false);
		
		return 	"<div style=\"margin:10px 10px 10px 40px;display:block;\"><span style=\"display:inline-block;width:50px\">".
					$caption."&nbsp;:&nbsp;</span>&nbsp;". $size->render()."&nbsp;&nbsp;".$type->render()."&nbsp;&nbsp;".$color->render().
				"</div>";
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
        if($value[0] == 1){
			$this->_value['same'] = 1; 
			$this->_value['size'] = array_fill(0, 4, $value[1]);
			$this->_value['type'] = array_fill(0, 4, $value[2]);
			$this->_value['color'] = array_fill(0, 4, $value[3]);
		}else{
			$this->_value['same'] = 0; 
			for($i=1,$j=0;$j<4;$i+=3,$j++){
				$this->_value['size'][$j] = $value[$i];
				if($value[$i]>0 && preg_match('/^#[a-f0-9]{6}$/i', $value[$i+1]))
					$this->_value['type'][$j] = $value[$i+1];
				if($value[$i]>0 && preg_match('/^#[a-f0-9]{6}$/i', $value[$i+2]))
					$this->_value['color'][$j] = $value[$i+2];
				
			}
		}
    }
    
    /**
     * Prepare HTML for output
     *
     * @return string HTML
     */
    function render()
    {
		$value = $this->_value;
		$i = 0;
		return 	"<div>".
					"<label class=\"inline\">"._AM_TMANAGER_BORDERBOX." :</label>&nbsp;&nbsp;&nbsp;".
					"<input type=\"radio\" name=\"".$this->getName()."_yn\"  class='borders_r_same'style=\"vertical-align: baseline;margin:0\" value=\"1\" ".($value['same']?'checked=\"checked\"':'').">&nbsp;"._YES."&nbsp;&nbsp;".
					"<input type=\"radio\" name=\"".$this->getName()."_yn\"  class='borders_r_same'style=\"vertical-align: baseline;margin:0\" value=\"0\" ".($value['same']?'':'checked=\"checked\"').">&nbsp;"._NO.
					"<div id='".$this->getName()."_sameborders' style='display:".($value['same']?'block':'none')."'>".
						$this->SingleBorder(_ALL, $value['size'][0], $value['type'][0], $value['color'][0], 'all').
					"</div>".
					"<div id='".$this->getName()."_diffborders' style='display:".($value['same']?'none':'block')."'>".				
						$this->SingleBorder(_AM_TMANAGER_BOX_TOP, $value['size'][$i], $value['type'][$i], $value['color'][$i++], 'top').
						$this->SingleBorder(_AM_TMANAGER_BOX_LEFT, $value['size'][$i], $value['type'][$i], $value['color'][$i++], 'left').
						$this->SingleBorder(_AM_TMANAGER_BOX_RIGHT, $value['size'][$i], $value['type'][$i], $value['color'][$i++], 'right').
						$this->SingleBorder(_AM_TMANAGER_BOX_BOTTOM, $value['size'][$i], $value['type'][$i], $value['color'][$i++], 'bot').
					"</div>".
				"</div>";
    }
}

?>

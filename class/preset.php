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
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @package         Menus
 * @since           1.0
 * @author          trabis <lusopoemas@gmail.com>
 * @version         $Id: menu.php 10582 2012-12-28 00:34:42Z trabis $
 */

defined("XOOPS_ROOT_PATH") or die("XOOPS root path not defined");

define('TMANAGER_NOCSS', '');
define('TMANAGER_CSS_WIDTH', 'width');
define('TMANAGER_CSS_HEIGHT', 'height');
define('TMANAGER_CSS_BG', 'bg');
define('TMANAGER_CSS_ALIGN', 'align');
define('TMANAGER_CSS_TXT', 'txt');
define('TMANAGER_CSS_PADDING', 'padding');
define('TMANAGER_CSS_MARGIN', 'margin');
define('TMANAGER_CSS_BORDER', 'border');

class TManagerPreset extends XoopsObject
{
    /**
     * constructor
     */
    public function __construct()
    {
        $this->initVar('id', XOBJ_DTYPE_INT);
        $this->initVar('title', XOBJ_DTYPE_TXTBOX, '');
        $this->initVar("status", XOBJ_DTYPE_INT, 0);
        $this->initVar('g_bg', XOBJ_DTYPE_TXTBOX, '0|#ffffff');
        $this->initVar('g_txt', XOBJ_DTYPE_TXTBOX, '14|#333333|Helvetica|0|0|0');
        $this->initVar('h1_txt', XOBJ_DTYPE_TXTBOX, '38.5|#333333|Helvetica|1|0|0');
        $this->initVar('h2_txt', XOBJ_DTYPE_TXTBOX, '31.5|#333333|Helvetica|1|0|0');
        $this->initVar('h3_txt', XOBJ_DTYPE_TXTBOX, '24.5|#333333|Helvetica|1|0|0');
        $this->initVar('link_txt', XOBJ_DTYPE_TXTBOX, '14|#0088CC|Helvetica|0|0|0');
        $this->initVar('hlink_txt', XOBJ_DTYPE_TXTBOX, '14|#005580|Helvetica|0|0|1');
        $this->initVar('vlink_txt', XOBJ_DTYPE_TXTBOX, '14|#333333|Helvetica|0|0|0');
        $this->initVar('l_bg', XOBJ_DTYPE_TXTBOX, '1|#ffffff');
        $this->initVar('l_width', XOBJ_DTYPE_TXTBOX, '0|940');
        $this->initVar('l_struct', XOBJ_DTYPE_TXTBOX, '3|6');
        $this->initVar('h_width', XOBJ_DTYPE_TXTBOX, '0|940');
        $this->initVar('h_height', XOBJ_DTYPE_INT, 50);
        $this->initVar('h_margin', XOBJ_DTYPE_TXTBOX, '5|auto|5|40');
        $this->initVar('h_padding', XOBJ_DTYPE_TXTBOX, '0|0|0|0');
        $this->initVar('h_bg', XOBJ_DTYPE_TXTBOX, '1|#F0F0F0');
        $this->initVar('h_border', XOBJ_DTYPE_TXTBOX, '1|1|solid|#E1E1E1');
        $this->initVar('n_pos', XOBJ_DTYPE_INT, 1);
        $this->initVar('n_width', XOBJ_DTYPE_TXTBOX, '1|50');
        $this->initVar('n_align', XOBJ_DTYPE_TXTBOX, 'l');
        $this->initVar('n_margin', XOBJ_DTYPE_TXTBOX, '10|0|0|auto');
        $this->initVar('n_padding', XOBJ_DTYPE_TXTBOX, '0|0|0|0');
        $this->initVar('n_type', XOBJ_DTYPE_INT, 1);
        $this->initVar('s_bg', XOBJ_DTYPE_TXTBOX, '1|#ffffff');
        $this->initVar('s_padding', XOBJ_DTYPE_TXTBOX, '0|0|0|0');
        $this->initVar('s_margin', XOBJ_DTYPE_TXTBOX, '0|0|0|20');
        $this->initVar('s_border', XOBJ_DTYPE_TXTBOX, '1|0|solid|#ffffff');
        $this->initVar('m_bg', XOBJ_DTYPE_TXTBOX, '1|#ffffff');
        $this->initVar('m_padding', XOBJ_DTYPE_TXTBOX, '0|0|0|0');
        $this->initVar('m_margin', XOBJ_DTYPE_TXTBOX, '0|0|0|20');
        $this->initVar('m_border', XOBJ_DTYPE_TXTBOX, '1|0|solid|#ffffff');
        $this->initVar('f_width', XOBJ_DTYPE_TXTBOX, '1|100');
        $this->initVar('f_height', XOBJ_DTYPE_INT, 52);
        $this->initVar('f_align', XOBJ_DTYPE_TXTBOX, 'c');
        $this->initVar('f_margin', XOBJ_DTYPE_TXTBOX, '19|0|0|0');
        $this->initVar('f_padding', XOBJ_DTYPE_TXTBOX, '19|0|0|0');
        $this->initVar('f_bg', XOBJ_DTYPE_TXTBOX, '0|F5F5F5');
        $this->initVar('f_border', XOBJ_DTYPE_TXTBOX, '0|1|solid|#E1E1E1|0|||0|||0||');
        $this->initVar('f_txt', XOBJ_DTYPE_TXTBOX, '14|#999999|Helvetica|0|0|0');
    }
    
    public function initVar($key, $data_type, $value = null, $required = false, $maxlength = null, $options = '')
    {
        $this->vars[$key] = array('value' => $value, 'required' => $required, 'data_type' => $data_type, 'maxlength' => $maxlength, 'changed' => false, 'options' => $options);
    }
}

class TManagerPresetHandler extends XoopsPersistableObjectHandler
{
    /**
     * @param XoopsDatabase $db
     */
    public function __construct(XoopsDatabase $db = null)
    {
        parent::__construct($db, 'tmanager_preset', 'TManagerPreset', 'id', 'title');
    }
	
	public function update_status(TManagerPreset $obj)
    {
        $sql = "UPDATE " . $this->table
        . " SET status = 0"
        . " WHERE status = 1"
        . " AND id <> " . $obj->getVar('id');
        $this->db->queryF($sql);
    }

	public function getDefault()
    {
        $criteria = new CriteriaCompo(new Criteria('status', 1));
        $ret = $this->getObjects($criteria, false);
        return $ret[0];
    }
}
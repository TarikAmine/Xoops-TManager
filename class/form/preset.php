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
 * page module
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         Menus
 * @since           2.6.0
 * @author          Mage Gregory (AKA Mage)
 * @version         $Id: menus_menu.php 10798 2013-01-13 20:26:34Z mageg $
 */

defined('XOOPS_ROOT_PATH') or die('Restricted access');

include_once dirname(__FILE__) . '/formnumber.php';
include_once dirname(__FILE__) . '/formcustompicker.php';
include_once dirname(__FILE__) . '/formalign.php';
include_once dirname(__FILE__) . '/formbox.php';
include_once dirname(__FILE__) . '/formfont.php';
include_once dirname(__FILE__) . '/formborderbox.php';
include_once dirname(__FILE__) . '/formcolumn.php';
include_once dirname(__FILE__) . '/formwidth.php';

class TmanagerPresetForm extends XoopsThemeForm //XoopsSimpleForm
{
    /**
     * @param MenusMenus_menu|XoopsObject $obj
     */
    public function __construct(TManagerPreset &$obj)
    {
        $xoops = Xoops::getInstance();
        $xoops->theme()->addScript('modules/tmanager/js/colorpicker/js/bootstrap-colorpicker.js');
        $xoops->theme()->addScript('modules/tmanager/js/tmanager.js');
        $xoops->theme()->addStylesheet('modules/tmanager/css/admin.css');

        $title = $obj->isNew() ? sprintf( _AM_TMANAGER_ADD_PRESETS ) : sprintf( _AM_TMANAGER_EDIT_PRESETS );

        parent::__construct($title, 'form_preset', 'presets.php', 'post', true); 
        
        $this->addElement(new XoopsFormLabel('', '<h3 id="tm_presetset">'._AM_TMANAGER_PRESET, '</h3>'));
        $this->addElement(new XoopsFormText(_AM_TMANAGER_TITLE, 'title', 50, 255, $obj->getVar('title'), ''), true);
        $this->addElement(new XoopsFormRadioYN(_AM_TMANAGER_DEFAULT_PRESET, 'status', $obj->getVar('status')));
        $this->addElement(new XoopsFormLabel('', '<h3 id="tm_generalset">'._AM_TMANAGER_GENERALSET, '</h3>'));
        $this->addElement(new XoopsFormCustomPicker(_AM_TMANAGER_BACKGROUND, 'g_bg', $obj->getVar('g_bg'), false));
        $this->addElement(new XoopsFormFont(_AM_TMANAGER_TEXT, 'g_txt', $obj->getVar('g_txt')));
        $this->addElement(new XoopsFormFont(_AM_TMANAGER_HEADING1, 'g_h1', $obj->getVar('g_h1')));
        $this->addElement(new XoopsFormFont(_AM_TMANAGER_HEADING2, 'g_h2', $obj->getVar('g_h2')));
        $this->addElement(new XoopsFormFont(_AM_TMANAGER_HEADING3, 'g_h3', $obj->getVar('g_h3')));
        $this->addElement(new XoopsFormFont(_AM_TMANAGER_LINK, 'g_link', $obj->getVar('g_link')));
        $this->addElement(new XoopsFormFont(_AM_TMANAGER_LINKV, 'g_hlink', $obj->getVar('g_hlink')));
        $this->addElement(new XoopsFormFont(_AM_TMANAGER_LINKH, 'g_vlink', $obj->getVar('g_vlink')));
        $this->addElement(new XoopsFormLabel('', '<h3 id="tm_layoutset">'._AM_TMANAGER_LAYOUTSET, '</h3>'));
        $this->addElement(new XoopsFormCustomPicker(_AM_TMANAGER_BACKGROUND, 'l_bg', $obj->getVar('l_bg')));
        $this->addElement(new XoopsFormWidth(_AM_TMANAGER_LAYOUTWIDTH, 'l_width', $obj->getVar('l_width')));
        $this->addElement(new XoopsFormColumn(_AM_TMANAGER_LAYOUTSTRUCT, 'l_struct', $obj->getVar('l_struct')));
        $this->addElement(new XoopsFormLabel('', '<h3 id="tm_headerset">'._AM_TMANAGER_HEADERSET, '</h3>'));
        $this->addElement(new XoopsFormWidth(_AM_TMANAGER_LAYOUTWIDTH, 'h_width', $obj->getVar('h_width')));
        $this->addElement(new XoopsFormNumber(_AM_TMANAGER_HEIGHT, 'h_height', $obj->getVar('h_height'), 'px', false));
        $this->addElement(new XoopsFormBox(_AM_TMANAGER_MARGIN, 'h_margin', $obj->getVar('h_margin')));
        $this->addElement(new XoopsFormBox(_AM_TMANAGER_PADDING, 'h_padding', $obj->getVar('h_padding')));
        $this->addElement(new XoopsFormCustomPicker(_AM_TMANAGER_BACKGROUND, 'h_bg', $obj->getVar('h_bg')));
        $this->addElement(new XoopsFormBorderBox(_AM_TMANAGER_BORDERS, 'h_border', $obj->getVar('h_border'))); 
        $this->addElement(new XoopsFormLabel('', '<h3 id="tm_navbarset">'._AM_TMANAGER_NAVBARSET, '</h3>'));
          $n_type = new XoopsFormSelect(_AM_TMANAGER_BACKGROUND, 'n_type', $obj->getVar('n_type'));
          $n_type->addOptionArray(array(0 => _AM_TMANAGER_NAV_HIDE,  1 => _AM_TMANAGER_NAV_TOP,  2 => _AM_TMANAGER_NAV_BOT));
        $this->addElement($n_type);
        $this->addElement(new XoopsFormWidth(_AM_TMANAGER_LAYOUTWIDTH, 'n_width', $obj->getVar('n_width')));
        $this->addElement(new XoopsFormAlign(_AM_TMANAGER_TEXTALIGN, 'n_align', $obj->getVar('n_align') , false));
        $this->addElement(new XoopsFormBox(_AM_TMANAGER_MARGIN, 'n_margin', $obj->getVar('n_margin')));
        $this->addElement(new XoopsFormBox(_AM_TMANAGER_PADDING, 'n_padding', $obj->getVar('n_padding')));
          $n_type = new XoopsFormSelect(_AM_TMANAGER_BACKGROUND, 'n_type', $obj->getVar('n_type'));
          $n_type->addOptionArray(array(0 => _AM_TMANAGER_NAV_W,  1 => _AM_TMANAGER_NAV_B));
        $this->addElement($n_type);
        $this->addElement(new XoopsFormLabel('', '<h3 id="tm_sidebarset">'._AM_TMANAGER_SIDEBARSET, '</h3>'));
        $this->addElement(new XoopsFormCustomPicker(_AM_TMANAGER_BACKGROUND, 's_bg', $obj->getVar('s_bg')));
        $this->addElement(new XoopsFormBox(_AM_TMANAGER_PADDING, 's_padding', $obj->getVar('s_padding')));
        $this->addElement(new XoopsFormBox(_AM_TMANAGER_MARGIN, 's_margin', $obj->getVar('s_margin')));
        $this->addElement(new XoopsFormBorderBox(_AM_TMANAGER_BORDERS, 's_border', $obj->getVar('s_border')));
        $this->addElement(new XoopsFormLabel('', '<h3 id="tm_mainset">'._AM_TMANAGER_MAINSET, '</h3>'));
        $this->addElement(new XoopsFormCustomPicker(_AM_TMANAGER_BACKGROUND, 'm_bg', $obj->getVar('m_bg')));
        $this->addElement(new XoopsFormBox(_AM_TMANAGER_PADDING, 'm_padding', $obj->getVar('m_padding')));
        $this->addElement(new XoopsFormBox(_AM_TMANAGER_MARGIN, 'm_margin', $obj->getVar('m_margin')));
        $this->addElement(new XoopsFormBorderBox(_AM_TMANAGER_BORDERS, 'm_border', $obj->getVar('m_border')));
        $this->addElement(new XoopsFormLabel('', '<h3 id="tm_footerset">'._AM_TMANAGER_FOOTERSET, '</h3>'));
        $this->addElement(new XoopsFormWidth(_AM_TMANAGER_LAYOUTWIDTH, 'f_width', $obj->getVar('f_width')));
        $this->addElement(new XoopsFormNumber(_AM_TMANAGER_HEIGHT, 'f_height', $obj->getVar('f_height'), 'px', false));
        $this->addElement(new XoopsFormAlign(_AM_TMANAGER_TEXTALIGN, 'f_align', $obj->getVar('f_align')));
        $this->addElement(new XoopsFormBox(_AM_TMANAGER_MARGIN, 'f_margin', $obj->getVar('f_margin')));
        $this->addElement(new XoopsFormBox(_AM_TMANAGER_PADDING, 'f_padding', $obj->getVar('f_padding')));
        $this->addElement(new XoopsFormCustomPicker(_AM_TMANAGER_BACKGROUND, 'f_bg', $obj->getVar('f_bg')));
        $this->addElement(new XoopsFormBorderBox(_AM_TMANAGER_BORDERS, 'f_border', $obj->getVar('f_border')));
        $this->addElement(new XoopsFormFont(_AM_TMANAGER_TEXT, 'f_txt', $obj->getVar('f_txt')));
        $this->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit' ));
        $this->addElement(new XoopsFormHidden('id', $obj->getVar('id')));
        $this->addElement(new XoopsFormHidden('mid', $obj->getVar('mid')));
        $this->addElement(new XoopsFormHidden( 'op', 'save' ) );
    }
    
    public function render()
    {
        return '<div class="container-fluid">
                  <!-- Docs nav
                  ================================================== -->
                  <div class="row-fluid">
                      <div class="span2 bs-docs-sidebar">
                          <ul id="tm_nav" class="nav nav-list bs-docs-sidenav">
                              <li class="active"><a href="#tm_presetset"><i class="icon-chevron-right"></i>'._AM_TMANAGER_PRESET.'</a></li>
                              <li><a href="#tm_generalset"><i class="icon-chevron-right"></i>'._AM_TMANAGER_GENERALSET.'</a></li>
                              <li><a href="#tm_layoutset"><i class="icon-chevron-right"></i>'._AM_TMANAGER_LAYOUTSET.'</a></li>
                              <li><a href="#tm_headerset"><i class="icon-chevron-right"></i>'._AM_TMANAGER_HEADERSET.'</a></li>
                              <li><a href="#tm_navbarset"><i class="icon-chevron-right"></i>'._AM_TMANAGER_NAVBARSET.'</a></li>
                              <li><a href="#tm_sidebarset"><i class="icon-chevron-right"></i>'._AM_TMANAGER_SIDEBARSET.'</a></li>
                              <li><a href="#tm_mainset"><i class="icon-chevron-right"></i>'._AM_TMANAGER_MAINSET.'</a></li>
                              <li><a href="#tm_footerset"><i class="icon-chevron-right"></i>'._AM_TMANAGER_FOOTERSET.'</a></li>
                          </ul>
                      </div>
                      <div class="span10 tm_preset_form">'.
                          parent::render().
                      '</div>
                  </div>
               </div>';
    }
}
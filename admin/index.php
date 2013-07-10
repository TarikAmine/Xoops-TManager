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
 * Private Message
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         pm
 * @since           2.5.0
 * @author          Mage
 * @author          Mamba
 * @version         $Id: index.php 10321 2012-12-05 19:25:07Z trabis $
 */

include dirname(__FILE__) . '/header.php';
$xoops = Xoops::getInstance();

$xoops->header();

// folder path
$folder_path = XOOPS_ROOT_PATH . '/uploads/banners';

$admin_page = new XoopsModuleAdmin();
$admin_page->addInfoBox(_AM_TMANAGER_PRESETS, 'on');
$quick_nav = 	'<div class="well" style="min-width: 400px; margin: 0 auto 10px;">
				  <a href="presets.php?op=edit_default" class="btn btn-large btn-block btn-inverse"><i class="icon-pencil icon-white"></i> '._AM_TMANAGER_EDIT_CURRENT_PRESET.'</a>
				  <a class="btn btn-large btn-block"><i class="icon-plus"></i> '._AM_TMANAGER_ADD_PRESETS.'</a>
				 </div>';
$admin_page->addInfoBoxLine($quick_nav, 'on');
$admin_page->displayNavigation('index.php');
$admin_page->displayIndex();
$xoops->footer();
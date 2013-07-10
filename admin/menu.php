<?php
/**
 * Private message
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
 * @package         pm
 * @since           2.3.0
 * @author          Taiwen Jiang <phppp@users.sourceforge.net>
 * @version         $Id: menu.php 8066 2011-11-06 05:09:33Z beckmi $
 */


$adminmenu = array();

$i = 1;
$adminmenu[$i]['title'] = _MI_TMANAGER_INDEX;
$adminmenu[$i]['link'] = "admin/index.php";
$adminmenu[$i]['icon']  = 'home.png' ;
$i++;
$adminmenu[$i]['title'] = _MI_TMANAGER_PRESETS;
$adminmenu[$i]['link'] = "admin/presets.php";
$adminmenu[$i]['icon']  = 'layout.png' ;
$i++;
$adminmenu[$i]['title'] = _MI_TMANAGER_MENUS;
$adminmenu[$i]['link']  = 'admin/extra.php';
$adminmenu[$i]['icon']  = 'menu.png';
$i++;
$adminmenu[$i]['title'] = _MI_TMANAGER_IMAGES;
$adminmenu[$i]['link']  = 'admin/extra.php';
$adminmenu[$i]['icon']  = 'images.png';
$i++;
$adminmenu[$i]['title'] = _MI_TMANAGER_EXTRA;
$adminmenu[$i]['link']  = 'admin/extra.php';
$adminmenu[$i]['icon']  = 'extention.png';
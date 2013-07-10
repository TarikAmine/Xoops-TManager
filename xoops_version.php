<?php
/**
 * TMANAGER extension module
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
 * @package         TMANAGER
 * @since           2.6.0
 * @author          Tarik AMINE (Aka Tarik)
 * @version         
 */

$modversion['name'] = _MI_TMANAGER_NAME;
$modversion['description'] = _MI_TMANAGER_DESC;
$modversion['version'] = 1.00;
$modversion['author'] = 'Tarik AMINE';
$modversion['nickname'] = 'Tarik';
$modversion['credits'] = 'The XOOPS Project';
$modversion['license'] = 'GNU GPL 2.0';
$modversion['license_url'] = 'www.gnu.org/licenses/gpl-2.0.html/';
$modversion['official'] = 0;
//$modversion['help'] = 'page=help';
$modversion['image'] = 'images/tmanager.png';
$modversion['dirname'] = 'tmanager';

//about
//$modversion['release_date'] = '2013/00/00';
$modversion['module_website_url'] = 'www.xo-aminoss.info';
$modversion['module_website_name'] = 'Xo-Aminoss';
$modversion['module_status'] = 'alpha';
$modversion['min_php'] = '5.2';
$modversion['min_xoops'] = '2.6.0';
$modversion['min_db'] = array('mysql'=>'5.0.7', 'mysqli'=>'5.0.7');

// paypal
$modversion['paypal'] = array();
$modversion['paypal']['business'] = 'tarik.d.amine@gmail.com';
$modversion['paypal']['item_name'] = _MI_TMANAGER_DESC;
$modversion['paypal']['amount'] = 0;
$modversion['paypal']['currency_code'] = 'EUR';

// Admin menu
$modversion['system_menu'] = 1;

// Manage extension
$modversion['extension'] = 1;
$modversion['extension_module'][] = 'system';

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu'] = 'admin/menu.php';

// Scripts to run upon installation or update
$modversion['onInstall'] = '';
?>
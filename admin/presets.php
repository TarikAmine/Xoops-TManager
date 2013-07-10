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

include_once dirname(__FILE__) . '/header.php';
include_once dirname(dirname(__FILE__)) . '/class/Request.php';

$tm_request = TManager_Request::getInstance();

$xoops->header();
$admin_page = new XoopsModuleAdmin();
$admin_page->displayNavigation('presets.php');
$xoops->theme()->addStylesheet('modules/system/css/admin.css');

$op = $request->asStr('op', 'list');
$id = $request->asInt('id', 0);
$media_url = '../../../media/xoops/images/icons/16';

switch ($op) {
    case 'add':
        $admin_page->addItemButton(_AM_TMANAGER_LIST_PRESETS, 'presets.php', 'application-view-detail');
        $admin_page->displayButton();
        // Create form
        $obj = $helper->getHandlerPresets()->create();
        $form = $helper->getForm($obj, 'preset');
        $form->display();
        break;

    case 'edit':
        $admin_page->addItemButton(_AM_TMANAGER_LIST_PRESETS, 'presets.php', 'application-view-detail');
        $admin_page->displayButton();
        // Create form
        $id = $request->asInt('id', 0);
        $obj = $helper->getHandlerPresets()->get($id);
		$form = $helper->getForm($obj, 'preset');
		$form->display();
        break;

    case 'edit_default':
        $admin_page->addItemButton(_AM_TMANAGER_LIST_PRESETS, 'presets.php', 'application-view-detail');
        $admin_page->displayButton();
        // Create form
        $obj = $helper->getHandlerPresets()->getDefault();
		$form = $helper->getForm($obj, 'preset');
		$form->display();
        break;

    case 'save':
        if (!$xoops->security()->check()) {
            $xoops->redirect('presets.php', 3, implode('<br />', $xoops->security()->getErrors()));
        }

        $msg[] = _AM_TMANAGER_PRESET_SAVED;

        $id = $tm_request->asInt('id', 0);
		$status = $tm_request->asInt('status', 0);
        if (isset($id) && $id !=0) {
            $obj = $helper->getHandlerPresets()->get($id);
        } else {
            $obj = $helper->getHandlerPresets()->create();
        }
        $obj->setVar('title', $tm_request->asStr('title', ''));
        $obj->setVar('status', $status);
        $obj->setVar('g_bg', $tm_request->asStr('g_bg', '0|#ffffff'));
        $obj->setVar('g_txt', $tm_request->asFont('g_txt', '14|#000000|Helvetica|0|0|0'));
        $obj->setVar('h1_txt', $tm_request->asFont('h1_txt', '38.5|#333333|Helvetica|1|0|0'));
        $obj->setVar('h2_txt', $tm_request->asFont('h2_txt', '31.5|#333333|Helvetica|1|0|0'));
        $obj->setVar('h3_txt', $tm_request->asFont('h3_txt', '24.5|#333333|Helvetica|1|0|0'));
        $obj->setVar('link_txt', $tm_request->asFont('link_txt', '14|#0088CC|Helvetica|0|0|0'));
        $obj->setVar('hlink_txt', $tm_request->asFont('hlink_txt', '14|#005580|Helvetica|0|0|1'));
        $obj->setVar('vlink_txt', $tm_request->asFont('vlink_txt', '14|#333333|Helvetica|0|0|0'));
        $obj->setVar('l_bg', $tm_request->asColor('l_bg', '0|#ffffff'));
        $obj->setVar('l_width', $tm_request->asWidth('l_width', '0|940'));
        $obj->setVar('l_struct', $tm_request->asColumns('l_struct', '3|6'));
        $obj->setVar('h_width', $tm_request->asWidth('h_width', '0|940'));
        $obj->setVar('h_height', $tm_request->asInt('h_height', 144));
        $obj->setVar('h_margin', $tm_request->asBox('h_margin', '10|10|10|10'));
        $obj->setVar('h_padding', $tm_request->asBox('h_padding', '10|10|10|10'));
        $obj->setVar('h_bg', $tm_request->asColor('h_bg', '0|#F0F0F0'));
        $obj->setVar('h_border', $tm_request->asBorder('h_border', '1|1|solid|#E1E1E1'));
        $obj->setVar('n_width', $tm_request->asWidth('n_width', '1|100'));
        $obj->setVar('n_align', $tm_request->asAlign('n_align', 'l'));
        $obj->setVar('n_margin', $tm_request->asBox('n_margin', '0|0|0|0'));
        $obj->setVar('n_padding', $tm_request->asBox('n_padding', '0|0|0|0'));
        $obj->setVar('n_type', $tm_request->asInt('n_type', 0, array(0,1)));
        $obj->setVar('n_pos', $tm_request->asInt('n_pos', 0, array(0,1,2)));
        $obj->setVar('s_bg', $tm_request->asColor('s_bg', '1|#ffffff'));
        $obj->setVar('s_padding', $tm_request->asBox('s_padding', '0|0|0|0'));
        $obj->setVar('s_margin', $tm_request->asBox('s_margin', '0|0|0|20'));
        $obj->setVar('s_border', $tm_request->asBorder('s_border', '1|0|solid|#ffffff'));
        $obj->setVar('m_bg', $tm_request->asColor('m_bg', '1|#ffffff'));
        $obj->setVar('m_padding', $tm_request->asBox('m_padding', '0|0|0|0'));
        $obj->setVar('m_margin', $tm_request->asBox('m_margin', '0|0|0|20'));
        $obj->setVar('m_border', $tm_request->asBorder('m_border', '1|0|solid|#ffffff'));
        $obj->setVar('f_width', $tm_request->asWidth('f_width', '1|100'));
        $obj->setVar('f_height', $tm_request->asInt('f_height', 52));
        $obj->setVar('f_align', $tm_request->asAlign('f_align', 'c'));
        $obj->setVar('f_margin', $tm_request->asBox('f_margin', '19|0|0|0'));
        $obj->setVar('f_padding', $tm_request->asBox('f_padding', '19|0|0|0'));
        $obj->setVar('f_bg', $tm_request->asColor('f_bg', '0|#F5F5F5'));
        $obj->setVar('f_border', $tm_request->asBorder('f_border', '1|1|solid|#E1E1E1'));
        $obj->setVar('f_txt', $tm_request->asFont('f_txt', '14|#999999|Helvetica|0|0|0'));

        if ($helper->getHandlerPresets()->insert($obj)) {
            if($status==1)
                $helper->getHandlerPresets()->update_status($obj);
            $xoops->redirect('presets.php', 2, implode('<br />', $msg));
        }
        $xoops->error($obj->getHtmlErrors());
        $form = $helper->getForm($obj, 'preset');
        $form->display();
        break;

    case 'del':

        break;

    case 'list':
    default:
        $myts = MyTextSanitizer::getInstance();
        $admin_page->addItemButton(_AM_TMANAGER_ADD_PRESETS, 'presets.php?op=add', 'add');
        $admin_page->displayButton();

        $presets_handler = $helper->getHandlerPresets();

        $count = $presets_handler->getCount();
		
        if ($count > 0) {
			echo "<table width='100%' cellspacing=1 cellpadding=3 border=0 class = outer>";
			echo "<tr>";
			echo "<td width='40' class='bg3' align='center'><strong>" . _AM_TMANAGER_ID . "</strong></td>";
			echo "<td  width='100%' class='bg3' align='left'><strong>" . _AM_TMANAGER_TITLE . "</strong></td>";
			echo "<td class='bg3'></td>";
			echo "<td width='80' class='bg3' align='center'><strong>" . _AM_TMANAGER_ACTION . "</strong></td>";
			echo "</tr>";
            $objs = $presets_handler->getObjects();
            foreach ($objs as $obj) {
				$modify = "<a href='presets.php?op=edit&id=" . $obj->getVar('id') . "'><img src='" . $media_url . "/edit.png' title='" . _AD_EDIT . "' alt='" . _AD_EDIT . "' /></a>&nbsp;";
				$clone = '';
				$delete = "<a href='presets.php?op=del&id=" . $obj->getVar('id') . "'><img src='" . $media_url . "/delete.png' title='" . _AD_DELETE . "' alt='" . _AD_DELETE . "' /></a>";
				$status = $obj->getVar('status')?'<span class="label label-info"><i class="icon-ok icon-white"></i>  '._AM_TMANAGER_DEFAULT_PRESET.'</span>':'';
				echo "<tr>";
				echo "<td class='head' align='center'>" . $obj->getVar('id') . "</td>";
				echo "<td class='head'>". $obj->getVar('title')."</td>";
				echo "<td class='head' align='center'>".$status."</td>";
				echo "<td class='even' align='center'> $modify $clone $delete </td>";
				echo "</tr>";
			}
			echo "</table>\n";
			echo "<br />\n";
        } else {
            echo '<div class="alert alert-error"><strong>'._AM_TMANAGER_NO_PRESETS.'</strong></div>';
        }
        break;
}

$xoops->footer();
<?php

include_once dirname(dirname(__FILE__)) . '/class/tmanagertheme.php';
defined('XOOPS_ROOT_PATH') or die('Restricted access');

class TmanagerCorePreload extends XoopsPreloadItem
{
    static function eventCoreThemeRenderStart($args) 
    { 
       if($args[0]->renderBanner == true){
         $xoops = Xoops::getInstance();
         $tmanager_theme = TManagerTheme::getInstance();;
         $args[0]->path = $xoops->path('modules/tmanager/theme');
         $args[0]->url = $xoops->url('modules/tmanager/theme');
         $args[0]->template->assign('tmanager_preheader', $tmanager_theme->getPreHeader());
         $args[0]->template->assign('tmanager_postheader', $tmanager_theme->getPastHeader());
         $args[0]->template->assign('tmanager_sheet', $tmanager_theme->getSheet());
         $span = $tmanager_theme->getStruct();
         $args[0]->template->assign('tmanager_spanr', $span[0]);
         $args[0]->template->assign('tmanager_spanc', $span[0]);
         $args[0]->template->assign('tmanager_spanl', $span[0]);
       }
    }
}
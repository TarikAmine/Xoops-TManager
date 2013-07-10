<?php
include_once dirname(__FILE__) . '/class/tmanagertheme.php';

TManagerTheme::setInstance();
$tm_sheet = TManagerTheme::getSheet();
$tm_preheader = TManagerTheme::getPreHeader();
$tm_pastheader = TManagerTheme::getPastHeader(); 
?>

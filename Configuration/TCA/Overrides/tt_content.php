<?php
defined('TYPO3') || die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

$pluginSignature = ExtensionUtility::registerPlugin(
    'SicFortune',
    'Fortune',
    'LLL:EXT:sic_fortune/Resources/Private/Language/locallang_db.xlf:plugin.fortune.title',
    'sic_fortune-fortune'
);

// Keep 'pages' (Datensatzsammlung) visible – primary way to set the storage PID
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature]
    = 'select_key,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature]
    = 'pi_flexform,--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.images,image';

ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature,
    'FILE:EXT:sic_fortune/Configuration/FlexForms/fortune.xml'
);

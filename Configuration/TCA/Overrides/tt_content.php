<?php
defined('TYPO3') || die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

$pluginSignature = ExtensionUtility::registerPlugin(
    'SicFortune',
    'Fortune',
    'LLL:EXT:sic_fortune/Resources/Private/Language/locallang_db.xlf:plugin.fortune.title',
    'sic_fortune-fortune',
    'plugins',
    '',
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

// Keep 'pages' (Datensatzsammlung) visible – primary way to set the storage PID
$GLOBALS['TCA']['tt_content']['types'][$pluginSignature]['showitem'] = '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        --palette--;;general,
        --palette--;;headers,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.plugin,
        pi_flexform,
        pages,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.images,
        image,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
        --palette--;;language,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
        --palette--;;hidden,
        --palette--;;access,
';

ExtensionManagementUtility::addPiFlexFormValue(
    '*',
    'FILE:EXT:sic_fortune/Configuration/FlexForms/fortune.xml',
    $pluginSignature
);

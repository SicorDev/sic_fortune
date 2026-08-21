<?php
defined('TYPO3') || die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'sic_fortune',
    'Configuration/TypoScript/',
    'Fortune Cookie'
);

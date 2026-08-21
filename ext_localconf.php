<?php
defined('TYPO3') || die();

(function () {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'SicFortune',
        'Fortune',
        [
            \SICOR\SicFortune\Controller\FortuneController::class => 'show',
        ],
        // non-cacheable: random changes per request; daily mode writes to DB on first access
        [
            \SICOR\SicFortune\Controller\FortuneController::class => 'show',
        ]
    );
})();

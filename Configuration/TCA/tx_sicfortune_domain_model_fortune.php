<?php
defined('TYPO3') || die();

return [
    'ctrl' => [
        'title' => 'LLL:EXT:sic_fortune/Resources/Private/Language/locallang_db.xlf:tx_sicfortune_domain_model_fortune',
        'label' => 'text',
        'label_alt' => 'author',
        'label_alt_force' => true,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'text,author',
        'iconfile' => 'EXT:sic_fortune/Resources/Public/Icons/fortune.svg',
        'default_sortby' => 'uid ASC',
    ],
    'types' => [
        '1' => [
            'showitem' => '
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                    hidden,text,author,lang,
                --div--;LLL:EXT:sic_fortune/Resources/Private/Language/locallang_db.xlf:tab.daily,
                    showon,
            ',
        ],
    ],
    'columns' => [
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
            ],
        ],
        'text' => [
            'label' => 'LLL:EXT:sic_fortune/Resources/Private/Language/locallang_db.xlf:tx_sicfortune_domain_model_fortune.text',
            'config' => [
                'type' => 'text',
                'cols' => 60,
                'rows' => 5,
                'required' => true,
            ],
        ],
        'author' => [
            'label' => 'LLL:EXT:sic_fortune/Resources/Private/Language/locallang_db.xlf:tx_sicfortune_domain_model_fortune.author',
            'config' => [
                'type' => 'input',
                'size' => 50,
                'max' => 255,
            ],
        ],
        'lang' => [
            'label' => 'LLL:EXT:sic_fortune/Resources/Private/Language/locallang_db.xlf:tx_sicfortune_domain_model_fortune.lang',
            'config' => [
                'type' => 'input',
                'size' => 5,
                'max' => 2,
                'placeholder' => 'de',
                'eval' => 'trim,lowercase',
            ],
        ],
        'showon' => [
            'label' => 'LLL:EXT:sic_fortune/Resources/Private/Language/locallang_db.xlf:tx_sicfortune_domain_model_fortune.showon',
            'description' => 'LLL:EXT:sic_fortune/Resources/Private/Language/locallang_db.xlf:tx_sicfortune_domain_model_fortune.showon.description',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'max' => 10,
                'placeholder' => 'YYYY-MM-DD',
                'eval' => 'trim',
            ],
        ],
    ],
];

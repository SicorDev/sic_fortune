<?php
$EM_CONF[$_EXTKEY] = [
    'title' => 'Fortune Cookie',
    'description' => 'Displays a random quote or citation of the day from the database or a Unix fortune file.',
    'category' => 'plugin',
    'version' => '1.0.0',
    'state' => 'stable',
    'author' => 'SICOR Dev Team',
    'author_email' => 'dev@sicor.de',
    'author_company' => 'SICOR GmbH',
    'license' => 'GPL-2.0-or-later',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0-14.4.99',
            'php' => '8.2.0-8.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];

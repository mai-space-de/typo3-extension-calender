<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Mai Events',
    'description' => 'Event management extension with list and detail views and iCal export. Supports event registration with waiting list. Categories use TYPO3 `sys_category`.',
    'category' => 'module',
    'author' => 'Maispace',
    'author_email' => '',
    'state' => 'stable',
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0-14.99.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];

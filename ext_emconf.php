<?php

$EM_CONF[$_EXTKEY] = [
    'title'            => 'Microsoft Graph User',
    'description'      => 'This extension allows you to retrieve information about a user in Azure AD.',
    'category'         => 'misc',
    'author'           => 'Cyril Janody',
    'author_email'     => 'cyril.janody@fsg.ulaval.ca',
    'state'            => 'alpha',
    'clearCacheOnLoad' => 0,
    'version'          => '1.0.0-dev',
    'constraints'      => [
        'depends'   => [
            'typo3' => '10.4.0-10.4.99',
        ],
        'conflicts' => [],
        'suggests'  => [],
    ],
    'autoload'         => [
        'psr-4' => [
            'FSG\\MsGraphUser\\' => 'Classes',
        ],
    ],
];

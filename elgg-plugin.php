<?php
/**
 * Elgg Entity Lists plugin
 * @package entity_lists
 */

use EntityLists\Elgg\Bootstrap;

return [
    'plugin' => [
        'name' => 'Entity Lists',
		'version' => '4.71',
		'dependencies' => [
			'datatables_api' => [
				'must_be_active' => true,
                'version' => '>4'
			]
		],
	],
    'bootstrap' => Bootstrap::class,
    'actions' => [],
    'routes' => [
        'entity_lists:users' => [
            'path' => '/entity_lists/users',
            'resource' => 'entity_lists/users',
        ],
        'entity_lists:groups' => [
            'path' => '/entity_lists/groups',
            'resource' => 'entity_lists/groups',
        ],
        'entity_lists:objects' => [
            'path' => '/entity_lists/objects/{subtype}',
            'resource' => 'entity_lists/objects',
        ],
    ],
    'widgets' => [],
    'views' => [
        'default' => [],
    ],
	'view_extensions' => [
		'css/admin' => [
			'entity_lists/entity_lists_admin.css' => [],
		],
	],
    'upgrades' => [],
];

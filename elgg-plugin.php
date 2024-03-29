<?php
/**
 * Elgg Entity Lists plugin
 * @package entity_lists
 */

use EntityLists\Elgg\Bootstrap;

require_once(dirname(__FILE__) . '/lib/events.php');

return [
    'plugin' => [
        'name' => 'Entity Lists',
		'version' => '5.8.1',
		'dependencies' => [
			'datatables_api' => [
				'must_be_active' => true,
                'version' => '>5'
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
    'events' => [
		'register' => [
			'menu:admin_header' => [
				'entity_lists_admin_menu' => ['priority' => 510],
			],
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

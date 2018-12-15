<?php
/**
 * Elgg Entity Lists plugin
 * @package entity_lists
 */

// restrict pages only to admins
elgg_admin_gatekeeper();

if (!elgg_is_active_plugin('datatables_api')) {
    echo elgg_echo('admin:entity_lists:datatable_api:missing');
    return;
}

$title = elgg_echo("item:user");

$dt_options = [
    'action' => 'entity_lists/users',
];

$dt_options['headers'] = [ 
    ['name' => 'id', 'label' => elgg_echo('entity_lists:admin:elgg_objects:table:header:id')],
    ['name' => 'name', 'label' => elgg_echo('entity_lists:admin:elgg_objects:table:header:name')],
    ['name' => 'username', 'label' => elgg_echo('entity_lists:admin:elgg_objects:table:header:username')],
    ['name' => 'email', 'label' => elgg_echo('entity_lists:admin:elgg_objects:table:header:email')],
    ['name' => 'created', 'label' => elgg_echo('entity_lists:admin:elgg_objects:table:header:created')],
    ['name' => 'updated', 'label' => elgg_echo('entity_lists:admin:elgg_objects:table:header:updated')],
    ['name' => 'actions', 'label' => elgg_echo('entity_lists:admin:elgg_objects:table:header:actions')],
];    

$content = elgg_view('datatables_api/dtapi_ajax', $dt_options);

echo elgg_format_element('div', ['style' => 'margin: 0 0 10px;'], elgg_view_title($title));
echo elgg_format_element('div', [], $content);

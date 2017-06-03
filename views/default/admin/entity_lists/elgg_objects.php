<?php
/**
 * Elgg Entity Lists plugin
 * @package entity_lists
 */

// restrict pages only to admins
admin_gatekeeper();

if (!elgg_is_active_plugin('datatables_api')) {
    echo elgg_echo('admin:entity_lists:datatable_api:missing');
    return;
}

$etype = get_input('e');
if (!$etype) {
    echo elgg_echo('admin:entity_lists:etype:missing');
    return;
}

// set title
$title = elgg_echo("item:object:{$etype}");

$options = array(
    'type' => 'object',
    'subtype' => $etype,
    'limit' => 0,
    'full_view' => false,
    'view_toggle_type' => false,
);
$entities = elgg_get_entities($options);

if ($entities) {
    $dt_options = [];
    $dt_options['dt_titles'] = array(
        elgg_echo('entity_lists:admin:elgg_objects:table:header:id'),
        elgg_echo('entity_lists:admin:elgg_objects:table:header:title'),
        elgg_echo('entity_lists:admin:elgg_objects:table:header:type'),
        elgg_echo('entity_lists:admin:elgg_objects:table:header:owner'),
        elgg_echo('entity_lists:admin:elgg_objects:table:header:container'),
        elgg_echo('entity_lists:admin:elgg_objects:table:header:access'),
        elgg_echo('entity_lists:admin:elgg_objects:table:header:created'),
        elgg_echo('entity_lists:admin:elgg_objects:table:header:updated'),
        elgg_echo('entity_lists:admin:elgg_objects:table:header:actions'),
    );

    $dt_data = [];
    foreach ($entities as $e) {
        $dt_data_tmp = [];

        $owner = get_entity($e->owner_guid);
        $container = get_entity($e->container_guid);
        
        // datatable 
        $dt_data_tmp['guid'] = $e->getGUID();
        $dt_data_tmp['title'] = elgg_view('output/url', array(
            'href' => $e->getURL(),
            'text' => $e->title,
            'title' => elgg_echo('entity_lists:admin:elgg_objects:view_entity'),
            'is_trusted' => true,
        ));
        $dt_data_tmp['type'] = $e->getSubtype();
        $dt_data_tmp['owner'] = elgg_view('output/url', array(
            'href' => $owner->getURL(),
            'text' => ($owner instanceof \ElggUser?$owner->name:$owner->title),
            'title' => elgg_echo('entity_lists:admin:elgg_objects:view_owner'),
            'is_trusted' => true,
        ));
        $dt_data_tmp['container'] = elgg_view('output/url', array(
            'href' => $container->getURL(),
            'text' => (($container instanceof \ElggUser) || ($container instanceof \ElggGroup)?$container->name:$container->title),
            'title' => elgg_echo('entity_lists:admin:elgg_objects:view_container'),
            'is_trusted' => true,
        ));
        $dt_data_tmp['access'] = $e->access_id;
        $dt_data_tmp['created'] = date("r", $e->time_created);
        $dt_data_tmp['updated'] = date("r", $e->time_updated);
        $dt_data_tmp['delete'] = elgg_view('output/url', array(
            'href' => "action/entity/delete?guid={$e->getGUID()}",
            'text' => elgg_view_icon('remove'),
            'title' => elgg_echo('delete:this'),
            'is_action' => true,
            'data-confirm' => elgg_echo('deleteconfirm'),
        ));

        array_push($dt_data, $dt_data_tmp);        
    }

    $dt_options['dt_data'] = $dt_data;

    $content = elgg_view('datatables_api/datatables_api', $dt_options);
}  
else {
    $content = elgg_format_element('div', [], elgg_echo('admin:entity_lists:no_results'));
}

echo elgg_format_element('div', ['style' => 'margin: 0 0 10px;'], elgg_view_title($title));
echo elgg_format_element('div', [], $content);

// unset variables
unset($entities);
unset($dt_data);

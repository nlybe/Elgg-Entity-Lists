<?php
/**
 * Elgg Entity Lists plugin
 * @package entity_lists
 */

$search = get_input('search');

$options = array(
    'type' => 'user',
    'limit' => 0,
    'count' => true,
);

if ($search && !empty($search['value'])) {
    $query = sanitise_string($search['value']);
    
    $options["wheres"] = [
         function(\Elgg\Database\QueryBuilder $qb, $alias) use($query) {
            $joined_alias = $qb->joinMetadataTable($alias, 'guid');
            return $qb->compare("$joined_alias.value", 'like', "%$query%", ELGG_VALUE_STRING);
         }
    ];
}

$totalEntries = elgg_get_entities($options);

$options['count'] = false;
$options['limit'] = max((int) get_input("length", elgg_get_config('default_limit')), 0);
$options['offset'] = sanitise_int(get_input ("start", 0), false);
$entities = elgg_get_entities($options);

$dt_data = [];
if ($entities) {    
    foreach ($entities as $e) {
        $dt_data_tmp = [];
        
        // datatable 
        $dt_data_tmp['id'] = $e->getGUID();
        $dt_data_tmp['name'] = elgg_view('output/url', array(
            'href' => $e->getURL(),
            'text' => $e->name,
            'title' => elgg_echo('entity_lists:admin:elgg_objects:view_entity'),
            'is_trusted' => true,
        )); 
        $dt_data_tmp['username'] = elgg_view('output/url', array(
            'href' => $e->getURL(),
            'text' => $e->username,
            'title' => elgg_echo('entity_lists:admin:elgg_objects:view_entity'),
            'is_trusted' => true,
        )); 
        
        $dt_data_tmp['email'] = $e->email;
        $dt_data_tmp['created'] = date("r", $e->time_created);
        $dt_data_tmp['updated'] = date("r", $e->time_updated);
        $dt_data_tmp['actions'] = elgg_view('output/url', array(
            'href' => "action/entity/delete?guid={$e->getGUID()}",
            'text' => elgg_view_icon('remove'),
            'title' => elgg_echo('delete:this'),
            'is_action' => true,
            'data-confirm' => elgg_echo('deleteconfirm'),
        ));

        array_push($dt_data, $dt_data_tmp);       
    }
} 

$total_rows = count($entities);
$draw = get_input('draw');
$result = [
    'draw' => isset($draw)?intval($draw):1,
    'recordsTotal' => $totalEntries,
    'recordsFiltered' => $totalEntries,
    'data' => $dt_data,
];

// release variables
unset($entities);

echo json_encode($result);
exit;

<?php
/**
 * Elgg Entity Lists plugin
 * @package entity_lists
 */

$lang = array(

    'entity_lists' => "Lists of entities",
    
    // admin
    'menu:page:header:entity_lists_section' => 'List Entities',
    'admin:entity_lists:menu:elgg_objects' => 'Elgg Objects',
    'admin:entity_lists' => 'Lists of entities',
    'admin:entity_lists:elgg_objects' => 'List of Elgg Object Entities',
    'admin:entity_lists:datatable_api:missing' => 'The DataTables API plugin is not enabled',
    'admin:entity_lists:etype:missing' => 'Any Elgg entity type is specified',
    'admin:entity_lists:no_results' => 'No results',
    
    'entity_lists:admin:elgg_objects:table:header:id' => 'ID',
    'entity_lists:admin:elgg_objects:table:header:title' => 'Title',
    'entity_lists:admin:elgg_objects:table:header:type' => 'Type',
    'entity_lists:admin:elgg_objects:table:header:container' => 'Container',
    'entity_lists:admin:elgg_objects:table:header:access' => 'Access Level',
    'entity_lists:admin:elgg_objects:table:header:owner' => 'Owner',
    'entity_lists:admin:elgg_objects:table:header:created' => 'Created',
    'entity_lists:admin:elgg_objects:table:header:updated' => 'Updated',
    'entity_lists:admin:elgg_objects:table:header:actions' => 'Actions',
    'entity_lists:admin:elgg_objects:view_entity' => 'View entity details',
    'entity_lists:admin:elgg_objects:view_owner' => 'View owner entity',
    'entity_lists:admin:elgg_objects:view_container' => 'View container entity',
    
    // settings
    'entity_lists:settings:basic_settings:intro' => 'Select entities to be included in admin menu',
    'entity_lists:settings:no' => "No",
    'entity_lists:settings:yes' => "Yes",    

);

add_translation("en", $lang);

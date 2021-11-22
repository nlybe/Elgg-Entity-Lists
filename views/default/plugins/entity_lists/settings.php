<?php
/**
 * Elgg Entity Lists plugin
 * @package entity_lists
 */

use EntityLists\EntityListsOptions;

$plugin = elgg_get_plugin_from_id(EntityListsOptions::PLUGIN_ID);

$types = get_registered_entity_types();
$output = elgg_format_element(
    'div', 
    ['style' => 'margin: 0 0 15px;'], 
    elgg_echo('entity_lists:settings:basic_settings:intro')
);

foreach ($types as $key => $t) {
    if ($key == 'user' || $key == 'group') {
      
        $param_name_entity = 'entity_lists_' . $key;
        $param_name = 'params[' . $param_name_entity . ']';
        $line = elgg_format_element('div', ['class' => 'input_box'], elgg_view_field([
            '#type' => 'checkbox',
            'name' => $param_name,
            'default' => 'no',
            'switch' => true,
            'value' => 'yes',
            'checked' => ($plugin->$param_name_entity === EntityListsOptions::ELYES), 
            '#label' => elgg_echo('item:'.$key),
        ]));
        $output .= elgg_view_module("inline", '', $line);
    } 
    else if ($key == 'object') {
        $sub_arr = $t;
        foreach ($sub_arr as $sub) {
        
            $param_name_entity = 'entity_lists_' . $sub;
            $param_name = 'params[' . $param_name_entity . ']';
            $line = elgg_format_element('div', ['class' => 'input_box'], elgg_view_field([
                '#type' => 'checkbox',
                'name' => $param_name,
                'default' => 'no',
                'switch' => true,
                'value' => 'yes',
                'checked' => ($plugin->$param_name_entity === EntityListsOptions::ELYES),  
                '#label' => elgg_echo('item:object:'.$sub),
            ]));
            $output .= elgg_view_module("inline", '', $line);
        }
    }
}

$title = elgg_format_element('h3', [], elgg_echo('menu:page:header:entity_lists_section'));
echo elgg_view_module('inline', '', $output, ['header' => $title]);
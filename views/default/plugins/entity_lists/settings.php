<?php
/**
 * Elgg Entity Lists plugin
 * @package entity_lists
 */

$plugin = elgg_get_plugin_from_id(EntityListsOptions::PLUGIN_ID);

$potential_yes_no = array(
    elgg_echo('entity_lists:settings:yes') => EntityListsOptions::ELYES,
    elgg_echo('entity_lists:settings:no') => EntityListsOptions::ELNO,
);

$types = get_registered_entity_types();

$output = elgg_format_element(
    'div', 
    ['style' => 'margin: 0 0 15px;'], 
    elgg_echo('entity_lists:settings:basic_settings:intro'
));

foreach ($types as $key => $t) {
    if ($key == 'user' || $key == 'group') {
      
        $tmp = elgg_format_element('div', [], elgg_format_element('strong', [], $key));
        
        $param_name_entity = 'entity_lists_' . $key;
        $param_name = 'params[' . $param_name_entity . ']';
        $tmp .= elgg_view_field([
            '#type' => 'radio',
            'name' => $param_name,
            'value' => ($plugin->$param_name_entity?$plugin->$param_name_entity:EntityListsOptions::ELNO), 
            'options' => $potential_yes_no, 
            'align' => 'horizontal',
        ]);
        
        $line = elgg_format_element('div', ['class' => 'input_box'], $tmp);
        $output .= elgg_view_module("inline", '', $line);
    } 
    else if ($key == 'object') {
        $sub_arr = $t;

        foreach ($sub_arr as $sub) {
            $tmp = elgg_format_element('div', [], elgg_format_element('strong', [], $sub));

            $param_name_entity = 'entity_lists_' . $sub;
            $param_name = 'params[' . $param_name_entity . ']';
            $tmp .= elgg_view_field([
                '#type' => 'radio',
                'name' => $param_name,
                'value' => ($plugin->$param_name_entity?$plugin->$param_name_entity:EntityListsOptions::ELNO), 
                'options' => $potential_yes_no, 
                'align' => 'horizontal',
            ]);            

            $line = elgg_format_element('div', ['class' => 'input_box'], $tmp);
            $output .= elgg_view_module("inline", '', $line);
        }
    }
}

$title = elgg_format_element('h3', [], elgg_echo('menu:page:header:entity_lists_section'));
echo elgg_view_module('inline', '', $output, ['header' => $title]);
<?php
/**
 * Elgg Entity Lists plugin
 * @package entity_lists
 */
 
elgg_register_event_handler('init', 'system', 'entity_lists_init');

/**
 * entity_lists plugin initialization functions.
 */
function entity_lists_init() {
 	
    if (elgg_get_context() == 'admin') {
        $enables_types = EntityListsOptions::getEnabledEntitiesOnBrowser();

        if ($enables_types) {
            foreach ($enables_types as $key => $e) {
                elgg_register_menu_item('page', array(
                    'name' => "entity_lists_{$e}",
                    'href' => elgg_normalize_url("admin/entity_lists/elgg_objects?e={$e}"),
                    'text' => elgg_echo("item:object:{$e}"),
                    'context' => 'admin',
                    'section' => 'entity_lists_section',
                ));
            }
        }
    }  
    
}


?>

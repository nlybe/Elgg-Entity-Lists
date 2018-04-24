<?php
/**
 * Elgg Entity Lists plugin
 * @package entity_lists
 */
 
elgg_register_event_handler('init', 'system', 'entity_lists_init');

/**
 * entity_lists plugin initialization functions
 */
function entity_lists_init() {
    // page handler for privacy_notification
    elgg_register_page_handler('entity_lists', 'entity_lists_river_page_handler'); 
    
    if (elgg_get_context() == 'admin' && elgg_is_admin_logged_in()) {
        
        if (EntityListsOptions::isUserEnabled()) {
            elgg_register_menu_item('page', array(
                'name' => "entity_lists_user",
                'href' => elgg_normalize_url("admin/entity_lists/user"),
                'text' => elgg_echo("item:user"),
                'context' => 'admin',
                'section' => 'entity_lists_section',
            ));            
        }
        
        if (EntityListsOptions::isGroupEnabled()) {
            elgg_register_menu_item('page', array(
                'name' => "entity_lists_group",
                'href' => elgg_normalize_url("admin/entity_lists/group"),
                'text' => elgg_echo("item:group"),
                'context' => 'admin',
                'section' => 'entity_lists_section',
            ));            
        }
        
        if ($enables_types = EntityListsOptions::getEnabledEntities()) {
            foreach ($enables_types as $key => $e) {
                elgg_register_menu_item('page', array(
                    'name' => "entity_lists_{$e}",
                    'href' => elgg_normalize_url("admin/entity_lists/object?e={$e}"),
                    'text' => elgg_echo("item:object:{$e}"),
                    'context' => 'admin',
                    'section' => 'entity_lists_section',
                ));
            }
        }
        
    }  
}

/**
 * entity_lists page handler
 * 
 * @param type $page
 * @return boolean
 */
function entity_lists_river_page_handler($page) {
    
    // make a URL segment available in page handler script
    $page_type = elgg_extract(0, $page, '/admin');
    $vars['page_type'] = $page_type;

    if ($page_type == 'users' || $page_type == 'groups') {
        echo elgg_view_resource("entity_lists/{$page_type}", $vars);
    }
    else {
        $vars['subtype'] = elgg_extract(1, $page);
        echo elgg_view_resource("entity_lists/objects", $vars);
    }
    
    
    return true;
}

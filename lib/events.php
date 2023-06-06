<?php
/**
 * Elgg Entity Lists plugin
 * @package entity_lists
 */

use EntityLists\EntityListsOptions;

 /**
 * Register gallery item to user menu
 * 
 * @param \Elgg\Event $event
 */ 
function entity_lists_admin_menu(\Elgg\Event $event) {
    if (!elgg_in_context('admin')) {
        return null;
    }
    
    /* @var $return MenuItems */
    $result = $event->getValue();
    
    $result[] = \ElggMenuItem::factory([
        'name' => 'entity_lists',
        'text' => elgg_echo('admin:entity_lists'),
        'href' => false,
    ]);

    if (EntityListsOptions::isUserEnabled()) {       
        $result[] = \ElggMenuItem::factory([
            'name' => 'entity_lists:user',
            'href' => elgg_normalize_url("admin/entity_lists/user"),
            'text' => elgg_echo("item:user"),
            'parent_name' => 'entity_lists',
        ]);            
    }
    
    if (EntityListsOptions::isGroupEnabled()) {     
        $result[] = \ElggMenuItem::factory([
            'name' => "entity_lists:group",
            'href' => elgg_normalize_url("admin/entity_lists/group"),
            'text' => elgg_echo("item:group"),
            'parent_name' => 'entity_lists',
        ]);
    }
    
    if ($enables_types = EntityListsOptions::getEnabledEntities()) {
        foreach ($enables_types as $key => $e) {    
            $result[] = \ElggMenuItem::factory([
                'name' => "entity_lists:{$e}",
                'href' => elgg_normalize_url("admin/entity_lists/object?e={$e}"),
                'text' => elgg_echo("item:object:{$e}"),
                'parent_name' => 'entity_lists',
            ]);
        }
    } 
    
    return $result;
}

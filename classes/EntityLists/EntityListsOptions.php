<?php
/**
 * Elgg Entity Lists plugin
 * @package entity_lists
 */

namespace EntityLists;

class EntityListsOptions {

    const PLUGIN_ID = 'entity_lists';                   // current plugin ID
    const ELYES = 'yes';                         // general purpose value for yes
    const ELNO = 'no';                           // general purpose value for no
 
    /**
     * Get param value from settings
     * 
     * @return type
     */
    Public Static function getParams($setting_param = ''){
        if (!$setting_param) {
            return false;
        }
        
        return trim(elgg_get_plugin_setting($setting_param, self::PLUGIN_ID)); 
    }    
    
    /**
     * Get the entity types which are enabled in settings
     *  
     * @return type
     */
    Public Static function getEnabledEntities() {
        $enables_types = [];
        
        $types = get_registered_entity_types();
        foreach ($types as $key => $t) {
            if ($key == 'object') {
                foreach ($t as $sub) {
                    $setting = self::getParams('entity_lists_'.$sub);
                    if ($setting == self::ELYES) {
                        array_push($enables_types, $sub);
                    }                    
                }                
            }
        }
        
        return $enables_types;        
    }
    
    /**
     * Check if user list is enabled
     * 
     * @return boolean
     */
    Public Static function isUserEnabled() {
        $setting = self::getParams('entity_lists_user');
        if ($setting == self::ELYES) {
            return true;       
        }                 
        
        return false;        
    } 
    
    /**
     * Check if group list is enabled
     * 
     * @return boolean
     */
    Public Static function isGroupEnabled() {
        $setting = self::getParams('entity_lists_group');
        if ($setting == self::ELYES) {
            return true;       
        }                 
        
        return false;        
    } 
          
}

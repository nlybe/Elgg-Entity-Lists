<?php
/**
 * Elgg Entity Lists plugin
 * @package entity_lists
 */

class EntityListsOptions {

    const PLUGIN_ID = 'entity_lists';                   // current plugin ID
    //const PAPI_SUBTYPE = 'paypal_transaction';      // objects subtype for successful paypal transactions
    const EntityLists_YES = 'yes';                         // general purpose value for yes
    const EntityLists_NO = 'no';                           // general purpose value for no
    
    
    /**
     * Get the entity types which are enabled in settings
     *  
     * @return type
     */
    Public Static function getEnabledEntitiesOnBrowser() {
        $enables_types = [];
        
        $types = get_registered_entity_types();
        foreach ($types as $key => $t) {
            if ($key == 'object') {
                $sub_arr = $t;
                
                foreach ($sub_arr as $sub) {
                    $setting = elgg_get_plugin_setting('entity_lists_' . $sub, self::PLUGIN_ID);

                    if ($setting == self::EntityLists_YES) {
                        array_push($enables_types, $sub);
                    }                    
                }                
            }
        }
        
        return $enables_types;        
    }
          
}

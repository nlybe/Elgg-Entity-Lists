<?php
/**
 * Elgg Entity Lists plugin
 * @package entity_lists
 */

namespace EntityLists\Elgg;

use Elgg\DefaultPluginBootstrap;
use EntityLists\EntityListsOptions;

class Bootstrap extends DefaultPluginBootstrap {
	
	const HANDLERS = [];
	
	/**
	 * {@inheritdoc}
	 */
	public function init() {
		$this->initViews();
	}

	/**
	 * Init views
	 *
	 * @return void
	 */
	protected function initViews() {
		
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
}

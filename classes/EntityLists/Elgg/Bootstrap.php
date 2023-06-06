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
		
		 
	}
}

<?php
namespace Smichaelsen\CfSugar\Example\Cache;

use Smichaelsen\CfSugar\AbstractCache;

class ButterflyCache extends AbstractCache {

	protected $cacheIdentifier = 'tx_myext_butterflies';

}

/**
 * Usage:
 *
 * $butterflyCache = $objectManager->get(ButterflyCache::class);
 * $butterflies = $butterflyCache->get('butterflies', function() {
 *   // this callback function is called when no butterflies were caught from the cache
 *   return $butterflyNet->catchSomeNewButterflies();
 * });
 */

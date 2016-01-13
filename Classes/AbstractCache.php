<?php
namespace Smichaelsen\CfSugar;

use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Cache\Frontend\FrontendInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

abstract class AbstractCache {

	/**
	 * @var FrontendInterface
	 */
	protected $cache;

	/**
	 * @var string
	 */
	protected $cacheIdentifier = 'overwrite_this';

	/**
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManager
	 * @inject
	 */
	protected $objectManager;

	/**
	 *
	 */
	public function __construct() {
		$cacheManager = isset($GLOBALS['typo3CacheManager']) ? $GLOBALS['typo3CacheManager'] : GeneralUtility::makeInstance(CacheManager::class);
		$this->cache = $cacheManager->getCache($this->cacheIdentifier);
	}

	/**
	 * @param string $identifier
	 * @param \Callable $callback
	 * @return mixed
	 */
	public function get($identifier, $callback) {
		if ($this->cache->has($identifier)) {
			return $this->cache->get($identifier);
		}
		$value = $callback();
		$this->cache->set($identifier, $value);
		return $value;
	}

	/**
	 *
	 */
	public function flush() {
		$this->cache->flush();
	}

}

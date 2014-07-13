<?php

namespace AopKit;

/**
 * Test cases for AdviceCache.
 * @author gbeine
 */
class AdviceCacheTest extends \PHPUnit_Framework_TestCase {

	function testCachedAdvice() {
		$cache = AdviceCache::instance();

		$advice = new CacheTestAdvice();
		$cache->addAdvice($advice);

		$result = $cache->lookUpAdvice('AopKit\CacheTestAdvice');

		$this->assertInstanceOf('AopKit\CacheTestAdvice', $result);
	}

	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage Advice NonExistingAdvice not found in cache
	 */
	function testNotCachedAdvice() {
		$cache = AdviceCache::instance();
		$result = $cache->lookUpAdvice('NonExistingAdvice');

		$this->fail('Should throw Exception');
	}
}

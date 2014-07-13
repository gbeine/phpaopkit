<?php

namespace AopKit;

/**
 * Test advice for validating AdviceCache.
 * @author gbeine
 */
class CacheTestAdvice implements Advice {

	function invoke($args = array()) {
		echo "CachedAdvice";
	}
}

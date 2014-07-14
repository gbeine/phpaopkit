<?php

namespace AopKit;

/**
 * Abstract class for around advices, delegating invocation.
 * @author gbeine
 */
abstract class AbstractAroundAdvice implements AroundAdvice {

	function invoke($args = array()) {
		$orig = array_pop($args);
		if (! is_a($orig, 'Reflector')) {
			throw new Exception('No original function or method given.');
		}
		return $this->invokeAround($args, $orig);
	}
}
<?php

namespace AopKit;

/**
 * Test advice that can be used as around advice.
 * @author gbeine
 */
class AroundTestAdvice extends AbstractAroundAdvice {

	function invokeAround($args, \ReflectionFunctionAbstract $orig) {
		echo "AroundTestAdvice invoked";
		if (0 < count($args)) {
			echo ": ".join(", ", $args);
		}
		if (is_a($orig, 'ReflectionFunction')) {
			$result = $orig->invokeArgs($args);
		}
		echo "\nAroundTestAdvice invoked successfully";
		return $result;
	}
}

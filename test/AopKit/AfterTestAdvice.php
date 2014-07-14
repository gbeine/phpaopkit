<?php

namespace AopKit;

/**
 * Test advice that can be used as after advice.
 * @author gbeine
 */
class AfterTestAdvice implements AfterAdvice {

	function invoke($args = array()) {
		echo "AfterTestAdvice invoked";
		if (0 < count($args)) {
			echo ": ".join(", ", $args);
		}
	}
}

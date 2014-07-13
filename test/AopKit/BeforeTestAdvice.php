<?php

namespace AopKit;

/**
 * Test advice that can be used as before advice.
 * @author gbeine
 */
class BeforeTestAdvice implements BeforeAdvice {

	function invoke($args = array()) {
		echo "BeforeTestAdvice invoked";
		if (0 < count($args)) {
			echo ": ".join(", ", $args);
		}
	}
}
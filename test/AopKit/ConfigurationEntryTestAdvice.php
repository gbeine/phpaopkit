<?php

namespace AopKit;

/**
 * Test advice that can be used as after advice.
 * @author gbeine
 */
class ConfigurationEntryTestAdvice implements AfterAdvice {

	function invoke($args = array()) {
		return true;
	}
}

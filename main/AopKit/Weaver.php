<?php

namespace AopKit;

/**
 * Weaves advices on joinpoints.
 * @author gbeine
 */
class Weaver {

	function addAdvice(Advice $advice, $joinpoint, $function) {
		switch ($joinpoint) {
			case AOPKIT_AFTER:
				$weaver = new AfterWeaver();
				break;
			case AOPKIT_AROUND:
				$weaver = new AroundWeaver();
				break;
			case AOPKIT_BEFORE:
				$weaver = new BeforeWeaver();
				break;
			default:
				throw new \Exception('No valid joinpoint given');
		}
		$weaver->addAdvice($advice, $function);
	}

	function addAdviceOnFunctions(Advice $advice, $joinpoint, $pattern) {
		$functions = get_defined_functions();
		$pattern = "/$pattern/i";

		foreach ($functions['internal'] as $function) {
			if (preg_match($pattern, $function)) {
				$this->addAdvice($advice, $joinpoint, $function);
			}
		}

		foreach ($functions['user'] as $function) {
			if (preg_match($pattern, $function)) {
				$this->addAdvice($advice, $joinpoint, $function);
			}
		}
	}
}

<?php

namespace AopKit;

/**
 * Weaves advices on joinpoints.
 * @author gbeine
 */
class Weaver {

	private $weavers = array();

	function __construct() {
		$this->weavers[AOPKIT_AFTER] = new AfterWeaver();
		$this->weavers[AOPKIT_AROUND] = new AroundWeaver();
		$this->weavers[AOPKIT_BEFORE] = new BeforeWeaver();
	}

	function addAdviceOnFunction(Advice $advice, $joinpoint, $function) {
		$weaver = $this->getWeaver($joinpoint);
		$weaver->addAdviceOnFunction($advice, $function);
	}

	function addAdviceOnFunctions(Advice $advice, $joinpoint, $pattern) {
		$functions = get_defined_functions();
		$pattern = "/$pattern/i";

		foreach ($functions['internal'] as $function) {
			if (preg_match($pattern, $function)) {
				$this->addAdviceOnFunction($advice, $joinpoint, $function);
			}
		}

		foreach ($functions['user'] as $function) {
			if (preg_match($pattern, $function)) {
				$this->addAdviceOnFunction($advice, $joinpoint, $function);
			}
		}
	}

	function addAdviceOnClass(Advice $advice, $joinpoint, $class) {
		$methods = get_class_methods($class);
		foreach ($methods as $method) {
			$this->addAdviceOnMethod($advice, $joinpoint, $class, $method);
		}
	}

	function addAdviceOnMethod(Advice $advice, $joinpoint, $class, $method) {
		$weaver = $this->getWeaver($joinpoint);
		$weaver->addAdviceOnMethod($advice, $class, $method);
	}

	private function getWeaver($joinpoint) {
		if (!array_key_exists($joinpoint, $this->weavers)) {
			throw new \Exception('No valid joinpoint given');
		}
		return $this->weavers[$joinpoint];
	}
}

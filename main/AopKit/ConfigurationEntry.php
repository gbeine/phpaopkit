<?php

namespace AopKit;

/**
 * An entry of an aspect weaver configuration
 * @author gbeine
 */
class ConfigurationEntry {

	private $target;
	private $advice;
	private $joinpoint;

	function __construct(Advice $advice, $target) {
		$this->advice = $advice;
		$this->joinpoint = self::getJoinPointFor($advice);
		$this->target = $target;
	}

	function advice() {
		return $this->advice;
	}

	function joinpoint() {
		return $this->joinpoint;
	}

	function target() {
		return $this->target;
	}


	private static function getJoinPointFor(Advice $advice) {
		$joinpoint = '';
		if ($advice instanceof AfterAdvice) {
			$joinpojnt = AOPKIT_AFTER;
		} elseif ($advice instanceof AroundAdvice) {
			$joinpojnt = AOPKIT_AROUND;
		} elseif ($advice instanceof BeforeAdvice) {
			$joinpojnt = AOPKIT_BEFORE;
		} else {
			throw new Exception('Unknown adivce type: ' + $adviceClass);
		}
		return $joinpojnt;
	}
}

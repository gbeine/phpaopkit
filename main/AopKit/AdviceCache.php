<?php

namespace AopKit;

class AdviceCache {

	private static $instance;

	private $advices = array();

	public static function instance() {
		if (null === self::$instance) {
			self::$instance = new AdviceCache();
		}
		return self::$instance;
	}

	public function addAdvice(Advice $advice) {
		$key = get_class($advice);
		if (!array_key_exists($key, $this->advices)) {
			$this->advices[$key] = $advice;
		}
	}

	public function lookUpAdvice($advice) {
		if (array_key_exists($advice, $this->advices)) {
			return $this->advices[$advice];
		}
		throw new \Exception('Advice '.$advice.' not found in cache');
	}
}
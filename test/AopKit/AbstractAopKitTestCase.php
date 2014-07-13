<?php

namespace AopKit;

abstract class AbstractAopKitTestCase extends \PHPUnit_Framework_TestCase {

	static function assertFunctionExists($function, $message = '') {
		if ('' === $message) {
			$message = "function $function does not exist";
		}
		return self::assertTrue(function_exists($function), $message);
	}

	static function assertFunctionNotExists($function, $message = '') {
		if ('' === $message) {
			$message = "function $function does exist";
		}
		return self::assertFalse(function_exists($function), $message);
	}
}
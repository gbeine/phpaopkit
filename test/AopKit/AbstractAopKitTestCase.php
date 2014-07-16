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

	static function assertMethodExists($class, $method, $message = '') {
		if ('' === $message) {
			$message = "method $method does not exist in class $class";
		}
		return self::assertTrue(method_exists($class, $method), $message);
	}

	static function assertMethodNotExists($class, $method, $message = '') {
		if ('' === $message) {
			$message = "method $method does exist in class $class ";
		}
		return self::assertFalse(method_exists($class, $method), $message);
	}
}

<?php

namespace AopKit;

/**
 * Removes weaved advices from functions and methods.
 * @author gbeine
 */
class UnWeaver {

	function removeAdviceFromFunction($function) {
		$origFunction = AOPKIT_ORIGINAL_PREFIX.$function;
		if (function_exists($origFunction)) {
			runkit_function_remove($function);
			runkit_function_rename($origFunction, $function);
		}
	}

	function removeAdviceFromMethod($class, $method) {
		$origMethod = AOPKIT_ORIGINAL_PREFIX.$method;
		if (method_exists($class, $origMethod)) {
			runkit_method_remove($class, $method);
			runkit_method_rename($class, $origMethod, $method);
		}
	}
}
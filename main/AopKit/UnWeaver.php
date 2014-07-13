<?php

namespace AopKit;

/**
 * Removes weaved advices from functions and methods.
 * @author gbeine
 */
class UnWeaver {

	function removeAdvice($function) {
		$origFunction = AOPKIT_ORIGINAL_PREFIX.$function;
		if (function_exists($origFunction)) {
			runkit_function_remove($function);
			runkit_function_rename($origFunction, $function);
		}
	}
}
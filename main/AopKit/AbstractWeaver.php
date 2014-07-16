<?php

namespace AopKit;

/**
 * Abstract weaver class implementing common weaver functionality.
 * @author gbeine
 */
abstract class AbstractWeaver {

	function addAdviceOnFunction(Advice $advice, $aspect, $function, $origFunction) {

		$paLi = new FunctionParameterLister($function);
		$origParameters = $paLi->getParametersAsArgumentString();

		runkit_function_rename($function, $origFunction);
		runkit_function_add($function, $origParameters, $aspect);

		AdviceCache::instance()->addAdvice($advice);
	}

	function addAdviceOnMethod(Advice $advice, $aspect, $class, $method, $origMethod) {

		$paLi = new MethodParameterLister($class, $method);
		$origParameters = $paLi->getParametersAsArgumentString();

		runkit_method_rename($class, $method, $origMethod);
		runkit_method_add($class, $method, $origParameters, $aspect);

		AdviceCache::instance()->addAdvice($advice);
	}
}

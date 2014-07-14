<?php

namespace AopKit;

/**
 * Abstract weaver class implementing common weaver functionality.
 * @author gbeine
 */
abstract class AbstractWeaver {

	function addAdviceOnFunction(Advice $advice, $aspect, $function, $origFunction) {

		$paLi = new ParameterLister($function);
		$origParameters = $paLi->getParametersAsArgumentString();

		runkit_function_rename($function, $origFunction);
		runkit_function_add($function, $origParameters, $aspect);

		AdviceCache::instance()->addAdvice($advice);
	}
}

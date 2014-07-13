<?php

namespace AopKit;

/**
 * A weaver taking before advices onto functions and methods.
 * @author gbeine
 */
class BeforeWeaver {

	function addAdvice(BeforeAdvice $advice, $function) {

		$paLi = new ParameterLister($function);
		$origParameters = $paLi->getParametersAsArgumentString();
		$origFunction = AOPKIT_ORIGINAL_PREFIX.$function;

		AdviceCache::instance()->addAdvice($advice);
		$adviceClass = get_class($advice);

		$aspect = '$orig = new ReflectionFunction("'.$origFunction.'");'
				. '$args = func_get_args();'
				. 'AopKit\AdviceCache::instance()->lookUpAdvice("'.$adviceClass.'")->invoke($args);'
				. 'return $orig->invokeArgs($args);';

		runkit_function_rename($function, $origFunction);
		runkit_function_add($function, $origParameters, $aspect);
	}
}

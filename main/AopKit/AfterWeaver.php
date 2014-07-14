<?php

namespace AopKit;

/**
 * A weaver taking after advices onto functions and methods.
 * @author gbeine
 */
class AfterWeaver {

	function addAdvice(AfterAdvice $advice, $function) {

		$paLi = new ParameterLister($function);
		$origParameters = $paLi->getParametersAsArgumentString();
		$origFunction = AOPKIT_ORIGINAL_PREFIX.$function;

		AdviceCache::instance()->addAdvice($advice);
		$adviceClass = get_class($advice);

		$aspect = '$orig = new ReflectionFunction("'.$origFunction.'");'
				. '$args = func_get_args();'
				. '$result = $orig->invokeArgs($args);'
				. 'array_push($args, $result);'
				. 'AopKit\AdviceCache::instance()->lookUpAdvice("'.$adviceClass.'")->invoke($args);'
				. 'return $result;';

		runkit_function_rename($function, $origFunction);
		runkit_function_add($function, $origParameters, $aspect);
	}
}

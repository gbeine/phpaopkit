<?php

namespace AopKit;

/**
 * A weaver taking after advices onto functions and methods.
 * @author gbeine
 */
class AfterWeaver extends AbstractWeaver {

	function addAdviceOnFunction(AfterAdvice $advice, $function) {

		$origFunction = AOPKIT_ORIGINAL_PREFIX.$function;
		$adviceClass = get_class($advice);

		$aspect = '$orig = new ReflectionFunction("'.$origFunction.'");'
				. '$args = func_get_args();'
				. '$result = $orig->invokeArgs($args);'
				. 'array_push($args, $result);'
				. 'AopKit\AdviceCache::instance()->lookUpAdvice("'.$adviceClass.'")->invoke($args);'
				. 'return $result;';

		parent::addAdviceOnFunction($advice, $aspect, $function, $origFunction);
	}

	function addAdviceOnMethod(AfterAdvice $advice, $class, $method) {

		$origMethod = AOPKIT_ORIGINAL_PREFIX.$method;
		$adviceClass = get_class($advice);

		$aspect = '$orig = new ReflectionMethod("'.$class.'","'.$origMethod.'");'
				. '$args = func_get_args();'
				. '$result = $orig->invokeArgs($this, $args);'
				. 'array_push($args, $result);'
				. 'AopKit\AdviceCache::instance()->lookUpAdvice("'.$adviceClass.'")->invoke($args);'
				. 'return $result;';

		parent::addAdviceOnMethod($advice, $aspect, $class, $method, $origMethod);
	}
}

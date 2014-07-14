<?php

namespace AopKit;

/**
 * A weaver taking after advices onto functions and methods.
 * @author gbeine
 */
class AfterWeaver extends AbstractWeaver {

	function addAdvice(AfterAdvice $advice, $function) {

		$origFunction = AOPKIT_ORIGINAL_PREFIX.$function;
		$adviceClass = get_class($advice);

		$aspect = '$orig = new ReflectionFunction("'.$origFunction.'");'
				. '$args = func_get_args();'
				. '$result = $orig->invokeArgs($args);'
				. 'array_push($args, $result);'
				. 'AopKit\AdviceCache::instance()->lookUpAdvice("'.$adviceClass.'")->invoke($args);'
				. 'return $result;';

		parent::addAdvice($advice, $aspect, $function, $origFunction);
	}
}

<?php

namespace AopKit;

/**
 * A weaver taking before advices onto functions and methods.
 * @author gbeine
 */
class BeforeWeaver extends AbstractWeaver {

	function addAdviceOnFunction(BeforeAdvice $advice, $function) {

		$origFunction = AOPKIT_ORIGINAL_PREFIX.$function;
		$adviceClass = get_class($advice);

		$aspect = '$orig = new ReflectionFunction("'.$origFunction.'");'
				. '$args = func_get_args();'
				. 'AopKit\AdviceCache::instance()->lookUpAdvice("'.$adviceClass.'")->invoke($args);'
				. 'return $orig->invokeArgs($args);';

		parent::addAdviceOnFunction($advice, $aspect, $function, $origFunction);
	}
}

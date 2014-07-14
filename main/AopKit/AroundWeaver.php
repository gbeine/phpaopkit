<?php

namespace AopKit;

/**
 * A weaver taking around advices onto functions and methods.
 * @author gbeine
 */
class AroundWeaver extends AbstractWeaver {

	function addAdviceOnFunction(AroundAdvice $advice, $function) {

		$origFunction = AOPKIT_ORIGINAL_PREFIX.$function;
		$adviceClass = get_class($advice);

		$aspect = '$orig = new ReflectionFunction("'.$origFunction.'");'
				. '$args = func_get_args();'
				. 'array_push($args, $orig);'
				. 'return AopKit\AdviceCache::instance()->lookUpAdvice("'.$adviceClass.'")->invoke($args);';

		parent::addAdviceOnFunction($advice, $aspect, $function, $origFunction);
	}
}

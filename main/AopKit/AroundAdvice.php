<?php

namespace AopKit;

/**
 * An interface for advices executed around calls.
 *
 * Do not implement this interface directly, extend AbstractAroundAdvice instead.
 * @author gbeine
 */
interface AroundAdvice extends Advice {

	function invokeAround($args, \Reflector $orig);
}

<?php

namespace AopKit;

/**
 * A helper class for dealing with parameter lists.
 * @author gbeine
 */
class FunctionParameterLister extends AbstractParameterLister {

	private $function;

	function __construct($function) {
		$this->function = $function;
	}

	function getParameters() {
		if (null === $this->parameters) {
			$function = new \ReflectionFunction($this->function);
			$this->parameters = $function->getParameters();
		}
		return $this->parameters;
	}
}
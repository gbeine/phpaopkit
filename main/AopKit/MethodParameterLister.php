<?php

namespace AopKit;

/**
 * A helper class for dealing with parameter lists.
 * @author gbeine
 */
class MethodParameterLister extends AbstractParameterLister {

	private $class;
	private $method;

	function __construct($class, $method) {
		$this->method = $method;
		$this->class = $class;
	}

	function getParameters() {
		if (null === $this->parameters) {
			$method = new \ReflectionMethod($this->class, $this->method);
			$this->parameters = $method->getParameters();
		}
		return $this->parameters;
	}
}
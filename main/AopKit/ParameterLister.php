<?php

namespace AopKit;

/**
 * A helper class for dealing with parameter lists.
 * @author gbeine
 */
class ParameterLister {

	private $function;
	private $parameters;

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

	function getParametersAsArgumentString() {
		$parameters = $this->getParameters();
		$count = count($parameters);
		$string = '';
		for ($i = 0; $i < $count; $i++) {
			$p = $parameters[$i];
			$class = $p->getClass();
			if (null !== $class) {
				$string .= $class->getShortName().' ';
			}
			$string .= '$'.$p->getName();
			if ($i+1 < $count) {
				$string .= ', ';
			}
		}
		return $string;
	}

	function getParametersAsString() {
		$parameters = $this->getParameters();
		$string = '';
		foreach ($parameters as $p) {
			$string .= $p->getName();
		}
		return $string;
	}
}
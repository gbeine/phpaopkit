<?php

namespace AopKit;

/**
 * A helper class for dealing with parameter lists.
 * @author gbeine
 */
abstract class AbstractParameterLister {

	protected $parameters;

	abstract function getParameters();

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
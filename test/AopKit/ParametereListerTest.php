<?php

namespace AopKit;

include_once __DIR__.'/../_files/functions.php';

/**
 * Test cases for ParameterLister.
 * @author gbeine
 */
class ParameterListerTest extends \PHPUnit_Framework_TestCase {

	function testListParameters() {
		$p = new ParameterLister('parameterListerTestFunction');
		$list = $p->getParametersAsString();
		$this->assertEquals('onetwothree', $list);
	}

	function testListArguments() {
		$p = new ParameterLister('parameterListerTestFunction');
		$list = $p->getParametersAsArgumentString();
		$this->assertEquals('$one, $two, $three', $list);
	}

	function testListArgumentsWithClasses() {
		$p = new ParameterLister('parameterListerTestWithClassFunction');
		$list = $p->getParametersAsArgumentString();
		$this->assertEquals('BeforeAdvice $one, AroundAdvice $two, AfterAdvice $three', $list);
	}
}

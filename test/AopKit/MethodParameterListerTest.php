<?php

namespace AopKit;

include_once __DIR__.'/../_files/classes.php';

/**
 * Test cases for ParameterLister.
 * @author gbeine
 */
class MethodParameterListerTest extends \PHPUnit_Framework_TestCase {

	function testListParameters() {
		$p = new MethodParameterLister('ParameterListerTestClass', 'testParameterList');
		$list = $p->getParametersAsString();
		$this->assertEquals('onetwothree', $list);
	}
}

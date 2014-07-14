<?php

namespace AopKit;

include_once __DIR__.'/../_files/functions.php';

/**
 * Test cases for AroundWeaver.
 * @author gbeine
 */
class AroundWeaverTest extends \PHPUnit_Framework_TestCase {

	private $function;

	function tearDown() {
		if (null !== $this->function) {
			$unWeaver = new UnWeaver();
			$unWeaver->removeAdvice($this->function);
		}
	}

	function testFunctionAroundWeaving() {
		$advice = new AroundTestAdvice();

		$this->function = 'aroundWeaverTestFunction';

		$weaver = new AroundWeaver();
		$weaver->addAdvice($advice, $this->function);

		$result = aroundWeaverTestFunction();

		$this->assertTrue($result);
		$this->expectOutputString("AroundTestAdvice invoked\nAroundTestAdvice invoked successfully");
	}

	function testFunctionAroundWeavingWithParameters() {
		$advice = new AroundTestAdvice();

		$this->function = 'aroundWeaverTestWithParametersFunction';

		$weaver = new AroundWeaver();
		$weaver->addAdvice($advice, $this->function);

		$result = aroundWeaverTestWithParametersFunction("one", "two", "three");

		$this->assertTrue($result);
		$this->expectOutputString("AroundTestAdvice invoked: one, two, three\nAroundTestAdvice invoked successfully");
	}
}

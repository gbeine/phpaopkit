<?php

namespace AopKit;

include_once __DIR__.'/../_files/functions.php';

/**
 * Test cases for BeforeWeaver.
 * @author gbeine
 */
class AfterWeaverTest extends \PHPUnit_Framework_TestCase {

	private $function;

	function tearDown() {
		if (null !== $this->function) {
			$unWeaver = new UnWeaver();
			$unWeaver->removeAdvice($this->function);
		}
	}

	function testFunctionAfterWeaving() {
		$advice = new AfterTestAdvice();

		$this->function = 'afterWeaverTestFunction';

		$weaver = new AfterWeaver();
		$weaver->addAdviceOnFunction($advice, $this->function);

		$result = afterWeaverTestFunction();

		$this->assertTrue($result);
		// After advices take at least one argument which is the return value of the invoked function
		$this->expectOutputString("AfterTestAdvice invoked: 1");
	}

	function testFunctionAfterWeavingWithParameters() {
		$advice = new AfterTestAdvice();

		$this->function = 'afterWeaverTestWithParametersFunction';

		$weaver = new AfterWeaver();
		$weaver->addAdviceOnFunction($advice, $this->function);

		$result = afterWeaverTestWithParametersFunction("one", "two", "three");

		$this->assertTrue($result);
		$this->expectOutputString("AfterTestAdvice invoked: one, two, three, 1");
	}
}

<?php

namespace AopKit;

include_once __DIR__.'/../_files/functions.php';

/**
 * Test cases for BeforeWeaver.
 * @author gbeine
 */
class BeforeWeaverTest extends \PHPUnit_Framework_TestCase {

	private $function;

	function tearDown() {
		if (null !== $this->function) {
			$unWeaver = new UnWeaver();
			$unWeaver->removeAdvice($this->function);
		}
	}

	function testFunctionBeforeWeaving() {
		$advice = new BeforeTestAdvice();

		$this->function = 'beforeWeaverTestFunction';

		$weaver = new BeforeWeaver();
		$weaver->addAdvice($advice, $this->function);

		$result = beforeWeaverTestFunction();

		$this->assertTrue($result);
		$this->expectOutputString("BeforeTestAdvice invoked");
	}

	function testFunctionBeforeWeavingWithParameters() {
		$advice = new BeforeTestAdvice();

		$this->function = 'beforeWeaverTestWithParametersFunction';

		$weaver = new BeforeWeaver();
		$weaver->addAdvice($advice, $this->function);

		$result = beforeWeaverTestWithParametersFunction("one", "two", "three");

		$this->assertTrue($result);
		$this->expectOutputString("BeforeTestAdvice invoked: one, two, three");
	}
}

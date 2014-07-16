<?php

namespace AopKit;

include_once __DIR__.'/../_files/classes.php';
include_once __DIR__.'/../_files/functions.php';

/**
 * Test cases for Weaver.
 * @author gbeine
 */
class WeaverTest extends AbstractAopKitTestCase {

	private $functions = array();

	function tearDown() {
		if (0 < array_count_values($this->functions)) {
			$unWeaver = new UnWeaver();
			foreach ($this->functions as $function) {
				$unWeaver->removeAdviceFromFunction($function);
			}
		}
	}

	function testWeaving() {
		$function = 'weaverTestFunctionOne';
		$origFunction = AOPKIT_ORIGINAL_PREFIX.$function;

		$advice = new WeaverTestAdvice();
		$weaver = new Weaver();
		$weaver->addAdviceOnFunction($advice, AOPKIT_BEFORE, $function);

		array_push($this->functions, $function);

		$this->assertFunctionExists($function);
		$this->assertFunctionExists($origFunction);
	}

	function testWeavingPattern() {
		$pattern = 'weaverTest.*';

		$advice = new WeaverTestAdvice();
		$weaver = new Weaver();
		$weaver->addAdviceOnFunctions($advice, AOPKIT_BEFORE, $pattern);

		array_push($this->functions, 'weaverTestFunctionOne');
		array_push($this->functions, 'weaverTestFunctionTwo');
		array_push($this->functions, 'weaverTestFunctionThree');

		foreach ($this->functions as $function) {
			$origFunction = AOPKIT_ORIGINAL_PREFIX.$function;
			$this->assertFunctionExists($function);
			$this->assertFunctionExists($origFunction);
		}
	}

	function testWeavingOnClass() {
		$class = 'WeaverTestClass';

		$advice = new WeaverTestAdvice();
		$weaver = new Weaver();
		$weaver->addAdviceOnClass($advice, AOPKIT_BEFORE, $class);

		$this->assertMethodExists($class, 'testone');
		$this->assertMethodExists($class, AOPKIT_ORIGINAL_PREFIX.'testone');
		$this->assertMethodExists($class, 'testtwo');
		$this->assertMethodExists($class, AOPKIT_ORIGINAL_PREFIX.'testtwo');
	}
}

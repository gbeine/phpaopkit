<?php

namespace AopKit;

include_once __DIR__.'/../_files/classes.php';
include_once __DIR__.'/../_files/functions.php';

/**
 * Test cases for UnWeaver.
 * @author gbeine
 */
class UnWeaverTest extends AbstractAopKitTestCase {

	function testUnWeaving() {
		$function = 'unWeaverTestFunction';
		$origFunction = AOPKIT_ORIGINAL_PREFIX.$function;

		runkit_function_rename($function, $origFunction);
		runkit_function_add($function, '', '');

		$this->assertFunctionExists($origFunction);
		$this->assertFunctionExists($function);

		$unWeaver = new UnWeaver();
		$unWeaver->removeAdviceFromFunction($function);

		$this->assertFunctionNotExists($origFunction);
		$this->assertFunctionExists($function);
	}

	function testUnWeavingNonWeaved() {
		$function = 'unWeaverTestFunction';
		$origFunction = AOPKIT_ORIGINAL_PREFIX.$function;

		$this->assertFunctionNotExists($origFunction);
		$this->assertFunctionExists($function);

		$unWeaver = new UnWeaver();
		$unWeaver->removeAdviceFromFunction($function);

		$this->assertFunctionNotExists($origFunction);
		$this->assertFunctionExists($function);
	}

	function testUnWeavingOnMethod() {
		$class = 'unWeaverTestClass';
		$method = 'unWeaverTestMethod';
		$origMethod = AOPKIT_ORIGINAL_PREFIX.$method;

		runkit_method_rename($class, $method, $origMethod);
		runkit_method_add($class, $method, '', '');

		$this->assertMethodExists($class, $origMethod);
		$this->assertMethodExists($class, $method);

		$unWeaver = new UnWeaver();
		$unWeaver->removeAdviceFromMethod($class, $method);

		$this->assertMethodNotExists($class, $origMethod);
		$this->assertMethodExists($class, $method);
	}
}
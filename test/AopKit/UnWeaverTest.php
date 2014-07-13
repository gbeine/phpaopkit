<?php

namespace AopKit;

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
		$unWeaver->removeAdvice($function);

		$this->assertFunctionNotExists($origFunction);
		$this->assertFunctionExists($function);
	}

	function testUnWeavingNonWeaved() {
		$function = 'unWeaverTestFunction';
		$origFunction = AOPKIT_ORIGINAL_PREFIX.$function;

		$this->assertFunctionNotExists($origFunction);
		$this->assertFunctionExists($function);

		$unWeaver = new UnWeaver();
		$unWeaver->removeAdvice($function);

		$this->assertFunctionNotExists($origFunction);
		$this->assertFunctionExists($function);
	}
}
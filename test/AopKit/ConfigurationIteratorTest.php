<?php

namespace AopKit;

/**
 * Test cases for ConfiguraionIterator.
 * @author gbeine
 */
class ConfigurationIteratorTest extends AbstractAopKitTestCase {

	function testIterate() {
		$adviceStubOne = $this->getMock('AopKit\BeforeAdvice');
		$adviceStubTwo = $this->getMock('AopKit\AfterAdvice');
		$config = array(
			$adviceStubOne,
			$adviceStubTwo
		);

		$iterator = new ConfigurationIterator($config);
		$this->assertTrue($iterator->valid());
		$this->assertSame($adviceStubOne, $iterator->current());
		$iterator->next();
		$this->assertTrue($iterator->valid());
		$this->assertSame($adviceStubTwo, $iterator->current());
		$iterator->next();
		$this->assertFalse($iterator->valid());
	}
}

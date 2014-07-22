<?php

namespace AopKit;

/**
 * Test cases for Configuraion.
 * @author gbeine
 */
class ConfigurationTest extends AbstractAopKitTestCase {

	function testConfiguration() {
		$entryStubOne = $this->getMockBuilder('AopKit\ConfigurationEntry')
    		->disableOriginalConstructor()
			->getMock();
		$entryStubOne->expects($this->once())
			->method('joinpoint')
			->will($this->returnValue(AOPKIT_BEFORE));
		$entryStubOne->expects($this->once())
			->method('target')
			->will($this->returnValue('targetOne'));
		$entryStubTwo = $this->getMockBuilder('AopKit\ConfigurationEntry')
    		->disableOriginalConstructor()
			->getMock();
		$entryStubTwo->expects($this->once())
			->method('joinpoint')
			->will($this->returnValue(AOPKIT_BEFORE));
		$entryStubTwo->expects($this->once())
			->method('target')
			->will($this->returnValue('targetTwo'));

		$config = new Configuration();
		$config->addEntry($entryStubOne);
		$config->addEntry($entryStubTwo);

		$iterator = $config->getIterator();
		$this->assertTrue($iterator->valid());
		$this->assertSame($entryStubOne, $iterator->current());
		$iterator->next();
		$this->assertTrue($iterator->valid());
		$this->assertSame($entryStubTwo, $iterator->current());
		$iterator->next();
		$this->assertFalse($iterator->valid());
	}

	function testConfigurationSameTargetDifferentJoinpoints() {
		$entryStubOne = $this->getMockBuilder('AopKit\ConfigurationEntry')
			->disableOriginalConstructor()
			->getMock();
		$entryStubOne->expects($this->once())
			->method('joinpoint')
			->will($this->returnValue(AOPKIT_BEFORE));
		$entryStubOne->expects($this->once())
			->method('target')
			->will($this->returnValue('targetOne'));
		$entryStubTwo = $this->getMockBuilder('AopKit\ConfigurationEntry')
			->disableOriginalConstructor()
			->getMock();
		$entryStubTwo->expects($this->once())
			->method('joinpoint')
			->will($this->returnValue(AOPKIT_AFTER));
		$entryStubTwo->expects($this->once())
			->method('target')
			->will($this->returnValue('targetOne'));

		$config = new Configuration();
		$config->addEntry($entryStubOne);
		$config->addEntry($entryStubTwo);

		$iterator = $config->getIterator();
		$this->assertTrue($iterator->valid());
	}

	/**
	 * @expectedException \Exception
	 * @expectedExceptionMessage Invalid configuration: advice exists for joinpoint BEFORE on target target
	 */
	function testConfigurationSameTargetSameJoinpoints() {
		$entryStubOne = $this->getMockBuilder('AopKit\ConfigurationEntry')
			->disableOriginalConstructor()
			->getMock();
		$entryStubOne->expects($this->once())
			->method('joinpoint')
			->will($this->returnValue(AOPKIT_BEFORE));
		$entryStubOne->expects($this->once())
			->method('target')
			->will($this->returnValue('target'));
		$entryStubTwo = $this->getMockBuilder('AopKit\ConfigurationEntry')
			->disableOriginalConstructor()
			->getMock();
		$entryStubTwo->expects($this->exactly(2))
			->method('joinpoint')
			->will($this->returnValue(AOPKIT_BEFORE));
		$entryStubTwo->expects($this->exactly(2))
			->method('target')
			->will($this->returnValue('target'));

		$config = new Configuration();
		$config->addEntry($entryStubOne);
		$config->addEntry($entryStubTwo);
	}
}

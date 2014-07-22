<?php

namespace AopKit;

/**
 * Test cases for ConfiguraionEntry.
 * @author gbeine
 */
class ConfigurationEntryTest extends AbstractAopKitTestCase {

	function testCreateConfiguratonEntry() {
		$advice = new ConfigurationEntryTestAdvice();
		$target = 'phpinfo';
		$entry = new ConfigurationEntry($advice, $target);
		$this->assertSame($advice, $entry->advice());
		$this->assertEquals($target, $entry->target());
		$this->assertEquals(AOPKIT_AFTER, $entry->joinpoint());
	}
}

<?php

namespace AopKit;

/**
 * Iterator for Configuration
 * @author gbeine
 */
class ConfigurationIterator implements \Iterator {

	private $configuration = array();

	function __construct(array $configuration) {
		$this->configuration = new \ArrayIterator($configuration);
	}

	function current() {
		return $this->configuration->current();
	}

	function key() {
		return $this->configuration->key();
	}

	function next() {
		$this->configuration->next();
	}

	function rewind() {
		$this->configuration->rewind();
	}

	function valid() {
		return $this->configuration->valid();
	}
}

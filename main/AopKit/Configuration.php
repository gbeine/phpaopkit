<?php

namespace AopKit;

/**
 * Represent a configuration of aspects for an aspect weaver.
 * @author gbeine
 */
class Configuration implements \IteratorAggregate {

	private $configuration = array();
	private $keys = array();

	function addEntry(ConfigurationEntry $entry) {
		$key = $entry->target().$entry->joinpoint();
		if (in_array($key, $this->keys)) {
			throw new \Exception('Invalid configuration: advice exists for joinpoint '.$entry->joinpoint().' on target '.$entry->target());
		}
		array_push($this->keys, $key);
		array_push($this->configuration, $entry);
	}

	function getIterator() {
		return new ConfigurationIterator($this->configuration);
	}
}

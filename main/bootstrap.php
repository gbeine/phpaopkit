<?php

/**
 * Bootstrap file to register autoloading functions.
 *
 * The autoloading is required to support including files in case of 'use' statements.
 */

require_once __DIR__.'/autoload.php';

const AOPKIT_ORIGINAL_PREFIX = "aopkit_original_";
const AOPKIT_BOOTSTRAPPED = true;
const AOPKIT_BEFORE = 'BEFORE';
const AOPKIT_AFTER = 'AFTER';
const AOPKIT_AROUND = 'AROUND';

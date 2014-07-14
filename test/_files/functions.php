<?php

use AopKit\AfterAdvice;
use AopKit\AroundAdvice;
use AopKit\BeforeAdvice;

function beforeWeaverTestFunction() {
	return true;
}

function beforeWeaverTestWithParametersFunction($one, $two, $three) {
	return true;
}

function afterWeaverTestFunction() {
	return true;
}

function afterWeaverTestWithParametersFunction($one, $two, $three) {
	return true;
}

function aroundWeaverTestFunction() {
	return true;
}

function aroundWeaverTestWithParametersFunction($one, $two, $three) {
	return true;
}

function parameterListerTestFunction($one, $two, $three) {
	return true;
}

function parameterListerTestWithClassFunction(BeforeAdvice $one, AroundAdvice $two, AfterAdvice $three) {
	return true;
}

function unWeaverTestFunction() {
	return true;
}

<?php

/**
 * Test: Nette\Callback tests.
 */

use Nette\Callback;
use Tester\Assert;


require __DIR__ . '/../bootstrap.php';


class Test
{
	static function add($a, $b)
	{
		return $a + $b;
	}
}


test(function () {
	$cb = new Callback(array(new Test, 'add'));

	Assert::same(8, $cb(3, 5));
	Assert::same(8, $cb->invoke(3, 5));
	Assert::same(8, $cb->invokeArgs(array(3, 5)));
	Assert::true($cb->isCallable());
});


test(function () {
	Assert::exception(function () {
		Callback::create('undefined')->invoke();
	}, 'Nette\InvalidStateException', "Callback 'undefined' is not callable.");

	Assert::exception(function () {
		Callback::create(null)->invoke();
	}, 'InvalidArgumentException', 'Invalid callback.');
});

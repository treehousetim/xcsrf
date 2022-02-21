<?php namespace treehousetim\xcsrf\test;

use treehousetim\xcsrf\xcsrf;

use PHPUnit\Framework\TestCase;

final class singletonTest extends TestCase
{
	public function testSingleton()
	{
		$instance = xcsrf::getInstance();

		$this->assertInstanceOf( \treehousetim\xcsrf\xcsrf::class, $instance );
	}
}
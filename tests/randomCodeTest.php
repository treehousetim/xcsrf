<?php namespace treehousetim\xcsrf\test;

use treehousetim\xcsrf\xcsrf;
use treehousetim\xcsrf\Exception as xcsrfException;

use PHPUnit\Framework\TestCase;

final class randomCodeTest extends TestCase
{
	public function testCode()
	{
		$instance = xcsrf::getInstance();

		$this->assertNotEmpty( $instance->getCode() );
	}
	//------------------------------------------------------------------------
	public function testCodeStaysTheSame()
	{
		$instance = xcsrf::getInstance();

		$code = $instance->getCode();
		$this->assertEquals( $instance->getCode(), $code, 'Code does not change during one invocation' );
	}
}
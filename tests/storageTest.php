<?php namespace treehousetim\xcsrf\test;

use treehousetim\xcsrf\xcsrf;
use treehousetim\xcsrf\Exception as xcsrfException;

use PHPUnit\Framework\TestCase;

final class storageTest extends TestCase
{
	public function testDisabledStorage()
	{
		$this->expectException( xcsrfException::class );
		$this->expectExceptionCode( xcsrfException::StorageProblem );

		$property = new \ReflectionProperty( xcsrf::class, "store");
		$property->setAccessible( true );

		// stand up different storage engine that is disabled
		$storage = new testStorage();
		$storage->enabled = false;

		$instance = xcsrf::getInstance();
		$property->setValue( $instance, $storage );

		// the unit under test - should throw exception
		$instance->enforceStorageEnabled();
	}
	//------------------------------------------------------------------------
	public function testInactiveStorage()
	{
		$this->expectException( xcsrfException::class );
		$this->expectExceptionCode( xcsrfException::StorageProblem );

		$property = new \ReflectionProperty( xcsrf::class, "store");
		$property->setAccessible( true );

		// stand up different storage engine that is disabled
		$storage = new testStorage();
		$storage->enabled = true;
		$storage->active = false;

		$instance = xcsrf::getInstance();
		$property->setValue( $instance, $storage );

		// the unit under test - should throw exception
		$instance->enforceStorageEnabled();
	}
}
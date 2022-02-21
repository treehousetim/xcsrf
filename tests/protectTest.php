<?php namespace treehousetim\xcsrf\test;

use treehousetim\xcsrf\xcsrf;
use treehousetim\xcsrf\Exception as xcsrfException;

use PHPUnit\Framework\TestCase;

final class protectTest extends TestCase
{
	public function testProtectHalt()
	{
		$this->expectException( Exception::class );
		$this->expectExceptionCode( Exception::Halt );

		$requestProp = new \ReflectionProperty( xcsrf::class, "request" );
		$requestProp->setAccessible( true );

		$storageProp = new \ReflectionProperty( xcsrf::class, "store" );
		$storageProp->setAccessible( true );

		$protectProp = new \ReflectionProperty( xcsrf::class, "protect" );
		$protectProp->setAccessible( true );

		$request = new testRequest();
			$request->value = 'ABC123';
		$storage = new testStorage();
			$storage->setValue( 'key', 'ZBC123' );

		$instance = xcsrf::getInstance();
		$requestProp->setValue( $instance, $request );
		$storageProp->setValue( $instance, $storage );

		$this->assertFalse( $instance->protect() );
	}
	//------------------------------------------------------------------------
	public function testProtectPasses()
	{
		$requestProp = new \ReflectionProperty( xcsrf::class, "request" );
		$requestProp->setAccessible( true );

		$storageProp = new \ReflectionProperty( xcsrf::class, "store" );
		$storageProp->setAccessible( true );

		$protectProp = new \ReflectionProperty( xcsrf::class, "protect" );
		$protectProp->setAccessible( true );

		$request = new testRequest();
			$request->value = 'ABC123';
		$storage = new testStorage();
			$storage->setValue( 'key', 'ABC123' );

		$instance = xcsrf::getInstance();
		$requestProp->setValue( $instance, $request );
		$storageProp->setValue( $instance, $storage );


		$this->assertTrue( $instance->protect(), 'Protection not needed.' );
	}
}

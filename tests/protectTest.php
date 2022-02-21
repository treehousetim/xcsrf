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

		// the request and storage engines so we can test
		$request = new testRequest();
			$request->value = 'ABC123';
		$storage = new testStorage();
		$protect = new testProtect();

		$instance = xcsrf::getInstance();
		$requestProp->setValue( $instance, $request );
		$storageProp->setValue( $instance, $storage );
		$protectProp->setValue( $instance, $protect );

		$instance->protect();
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

		// the request and storage engines so we can test
		$request = new testRequest();
			$request->value = 'ABC123';
		$storage = new testStorage();
			$storage->setValue( 'key', 'ABC123' );
		$protect = new testProtect();

		$instance = xcsrf::getInstance();
		$requestProp->setValue( $instance, $request );
		$storageProp->setValue( $instance, $storage );
		$protectProp->setValue( $instance, $protect );

		$this->assertTrue( $instance->protect(), 'Protection not needed.' );
	}

}

// if( $_POST )
// {
// 	xcsrf::getInstance( new xcsrfSession(), new xcsrfHttp() )->protect();
// 	// process POST request here.
// }

// echo '<form>';
// echo '<input type="hidden" value="' . xcsrf::getInstance()->getCode() . '"></input>';
// echo '<input type="submit" value="Submit"></input>';
// echo '</form>';
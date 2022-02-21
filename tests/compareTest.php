<?php namespace treehousetim\xcsrf\test;

use treehousetim\xcsrf\xcsrf;


use PHPUnit\Framework\TestCase;

final class compareTest extends TestCase
{
	public function testCompare()
	{
		$requestProp = new \ReflectionProperty( xcsrf::class, "request");
		$requestProp->setAccessible( true );

		$storageProp = new \ReflectionProperty( xcsrf::class, "store" );
		$storageProp->setAccessible( true );

		// the request and storage engines so we can test
		$request = new testRequest();
		$storage = new testStorage();

		$instance = xcsrf::getInstance();
		$requestProp->setValue( $instance, $request );
		$storageProp->setValue( $instance, $storage );

		$this->assertTrue( $instance->requestMatchesStored() );
	}
	//------------------------------------------------------------------------
	public function testCompareFail()
	{
		$requestProp = new \ReflectionProperty( xcsrf::class, "request" );
		$requestProp->setAccessible( true );

		$storageProp = new \ReflectionProperty( xcsrf::class, "store" );
		$storageProp->setAccessible( true );

		// the request and storage engines so we can test
		$request = new testRequest();
			$request->value = 'ABC123';
		$storage = new testStorage();

		$instance = xcsrf::getInstance();
		$requestProp->setValue( $instance, $request );
		$storageProp->setValue( $instance, $storage );

		$this->assertFalse( $instance->requestMatchesStored(), 'Request matches Stored' );
	}
	//------------------------------------------------------------------------
	public function testCompareWithCode()
	{
		$requestProp = new \ReflectionProperty( xcsrf::class, "request" );
		$requestProp->setAccessible( true );

		$storageProp = new \ReflectionProperty( xcsrf::class, "store" );
		$storageProp->setAccessible( true );

		$instance = xcsrf::getInstance();
		$code = $instance->getCode();

		// the request and storage engines so we can test
		$request = new testRequest();
			$request->value = $code;

		$storage = new testStorage();
			$storage->setValue( xcsrf::StoreKey, $code );

		$requestProp->setValue( $instance, $request );
		$storageProp->setValue( $instance, $storage );

		$this->assertTrue( $instance->requestMatchesStored(), 'Request matches Stored' );
	}
	//------------------------------------------------------------------------
	public function testCodeDoeNotMatch()
	{
		$requestProp = new \ReflectionProperty( xcsrf::class, "request" );
		$requestProp->setAccessible( true );

		$storageProp = new \ReflectionProperty( xcsrf::class, "store" );
		$storageProp->setAccessible( true );

		$instance = xcsrf::getInstance();
		$code = $instance->getCode();

		// the request and storage engines so we can test
		$request = new testRequest();
			$request->value = $code;

		$code = 'abcdefg';
		$storage = new testStorage();
			$storage->setValue( xcsrf::StoreKey, $code );

		$requestProp->setValue( $instance, $request );
		$storageProp->setValue( $instance, $storage );

		$this->assertFalse( $instance->requestMatchesStored(), 'Request Does not match Stored' );
	}
}

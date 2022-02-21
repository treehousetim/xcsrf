<?php namespace treehousetim\xcsrf\test;

use \treehousetim\xcsrf\Exception;

class testStorage implements \treehousetim\xcsrf\storageInterface
{
	public $enabled = true;
	public $active = true;
	protected $value = '';

	public function enabled() : bool
	{
		return $this->enabled;
	}
	//------------------------------------------------------------------------
	public function notEnabledException() : Exception
	{
		return new Exception( 'Test storage is disabled', Exception::StorageProblem );
	}
	//------------------------------------------------------------------------
	public function active() : bool
	{
		return $this->active;
	}
	//------------------------------------------------------------------------
	public function notActiveException() : Exception
	{
		return new Exception( 'Test storage is not active', Exception::StorageProblem );
	}
	//------------------------------------------------------------------------
	public function getValue( string $key ) : string
	{
		return $this->value;
	}
	//------------------------------------------------------------------------
	public function setValue( string $key, string $value )
	{
		$this->value = $value;
	}
	
	
	
	
	
}

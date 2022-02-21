<?php namespace treehousetim\xcsrf;

class sessionStorage implements storageInterface
{
	public function enabled() : bool
	{
		return session_status() != PHP_SESSION_DISABLED;
	}
	//------------------------------------------------------------------------
	public function notEnabledException() : Exception
	{
		return new Exception( 'Session storage is required. Right now it is disabled in the PHP configuration', Exception::StorageProblem );
	}
	//------------------------------------------------------------------------
	public function active() : bool
	{
		return session_status() == PHP_SESSION_ACTIVE;
	}
	//------------------------------------------------------------------------
	public function notActiveException() : Exception
	{
		return new Exception( 'Sessions must be started before using xcsrf', Exception::StorageProblem );
	}
	//------------------------------------------------------------------------
	public function getValue( string $key ) : string
	{
		return $_SESSION[$key]??'';
	}
	//------------------------------------------------------------------------
	public function setValue( string $key, string $value )
	{
		$_SESSION[$key] = $value;
	}
}

<?php namespace treehousetim\xcsrf;

interface storageInterface
{
	public function enabled() : bool;
	public function notEnabledException() : Exception;
	public function active() : bool;
	public function notActiveException() : Exception;
	public function getValue( string $key ) : string;
	public function setValue( string $key, string $value );
}
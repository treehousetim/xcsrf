<?php namespace treehousetim\xcsrf\test;

class testRequest implements \treehousetim\xcsrf\requestInterface
{
	public $value = '';

	public function getValue( string $key ) : string
	{
		return $this->value;
	}
}
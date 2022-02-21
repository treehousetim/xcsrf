<?php namespace treehousetim\xcsrf\test;

use \treehousetim\xcsrf\protectInterface;

class testProtect implements protectInterface
{
	public function halt()
	{
        throw new Exception( 'Halt', Exception::Halt );
	}
}

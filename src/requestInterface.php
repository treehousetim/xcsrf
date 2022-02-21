<?php namespace treehousetim\xcsrf;

interface requestInterface
{
	public function getValue( string $key ) : string;
}
<?php namespace treehousetim\xcsrf;

class httpRequest implements requestInterface
{
	public function getValue( string $key ) : string
	{
		if( array_key_exists( $key, $_POST ) )
		{
			return $_POST[$key];
		}

		if( array_key_exists( $key, $_GET ) )
		{
			return $_GET[$key];
		}

		return '';
	}
}
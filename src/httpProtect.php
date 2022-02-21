<?php namespace treehousetim\xcsrf;

class httpProtect implements protectInterface
{
	public function halt()
	{
		header('HTTP/1.0 403 Forbidden');

?><!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forbidden</title>
  </head>
  <body>
  <h1>403 Forbidden</h1>
  </body>
</html><?php

		die();
	}
}
